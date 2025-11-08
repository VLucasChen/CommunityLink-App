<?php
declare(strict_types=1);

/**
 * Pages Controller
 * CommunityLink - Community Event Management System
 * Handles static pages and dashboard
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/5/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * Home page - public landing page (A3 equivalent to index.php)
     * Uses standalone template with no layout (no sidebar, no default layout)
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function home()
    {
        $user = $this->request->getAttribute('identity');
        if ($user) {
            return $this->redirect(['action' => 'dashboard']);
        }
        // Disable layout for public home page - it has its own full HTML template (no sidebar, no default layout)
        $this->viewBuilder()->setLayout(null);
        // No need to explicitly render - CakePHP will render automatically
    }

    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function display(string ...$path): ?Response
    {
        // Handle root path - redirect or show home
        if (empty($path) || (count($path) === 1 && $path[0] === 'home')) {
            $user = $this->request->getAttribute('identity');
            if ($user) {
                return $this->redirect(['action' => 'dashboard']);
            }
            // Disable layout for public home page - it has its own full HTML template (no sidebar, no default layout)
            $this->viewBuilder()->setLayout(null);
            $path = ['home']; // Ensure path is set for rendering
        }
        
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        
        $page = $subpage = null;
        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        // For home page, ensure layout is disabled (has full HTML like A3 - no sidebar, no default layout)
        if (!empty($path[0]) && $path[0] === 'home') {
            $this->viewBuilder()->setLayout(null); // Disable default layout completely - public pages don't use it
        }

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    /**
     * Dashboard method - A5 requirement matching A3 dashboard.php
     * Preserves A3 logic: same statistics, same layout
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function dashboard()
    {
        $this->requireLogin();
        $this->requireAdmin();
        
        // Disable layout for dashboard (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);
        
        // In CakePHP 5, prefer fetchTable() to access tables directly
        $eventsTable = $this->fetchTable('Events');
        $volunteersTable = $this->fetchTable('Volunteers');
        $organisationsTable = $this->fetchTable('Organisations');
        $contactMessagesTable = $this->fetchTable('ContactMessages');
        $volunteerSignupsTable = $this->fetchTable('VolunteerSignups');
        $volunteerEventsTable = $this->fetchTable('VolunteerEvents');

        // A5 Requirement: Top 10 most active volunteers (events participated in current year)
        // Get all volunteers with their event counts for current year
        $allVolunteers = $volunteersTable->find()->contain(['VolunteerEvents.Events'])->toArray();
        $volunteerActivity = [];
        foreach ($allVolunteers as $volunteer) {
            $eventCount = 0;
            if (!empty($volunteer->volunteer_events)) {
                foreach ($volunteer->volunteer_events as $ve) {
                    if ($ve->has('event') && $ve->event && $ve->event->event_date) {
                        $eventYear = $ve->event->event_date->format('Y');
                        if ($eventYear == date('Y')) {
                            $eventCount++;
                        }
                    }
                }
            }
            if ($eventCount > 0) {
                $volunteerActivity[] = [
                    'volunteer' => $volunteer,
                    'event_count' => $eventCount
                ];
            }
        }
        // Sort by event count descending and take top 10
        usort($volunteerActivity, function($a, $b) {
            return $b['event_count'] - $a['event_count'];
        });
        $topVolunteers = array_slice($volunteerActivity, 0, 10);

        // A5 Requirement: Top 10 most active partner organisations (events hosted in current year)
        // Get all organisations with their event counts for current year
        $allOrganisations = $organisationsTable->find()->contain(['Events'])->toArray();
        $orgActivity = [];
        foreach ($allOrganisations as $org) {
            $eventCount = 0;
            if (!empty($org->events)) {
                foreach ($org->events as $event) {
                    if ($event->event_date) {
                        $eventYear = $event->event_date->format('Y');
                        if ($eventYear == date('Y')) {
                            $eventCount++;
                        }
                    }
                }
            }
            if ($eventCount > 0) {
                $orgActivity[] = [
                    'organisation' => $org,
                    'event_count' => $eventCount
                ];
            }
        }
        // Sort by event count descending and take top 10
        usort($orgActivity, function($a, $b) {
            return $b['event_count'] - $a['event_count'];
        });
        $topOrganisations = array_slice($orgActivity, 0, 10);

        // A5 Requirement: Number of volunteers with certain skills
        // Get unique skills and count volunteers for each
        $allVolunteers = $volunteersTable->find()->select(['skills'])->toArray();
        $skillsStats = [];
        foreach ($allVolunteers as $volunteer) {
            if ($volunteer->skills) {
                $skills = explode(',', $volunteer->skills);
                foreach ($skills as $skill) {
                    $skill = trim($skill);
                    if ($skill) {
                        $skillsStats[$skill] = ($skillsStats[$skill] ?? 0) + 1;
                    }
                }
            }
        }
        arsort($skillsStats);
        $skillsStats = array_slice($skillsStats, 0, 10, true); // Top 10 skills

        // A5 Requirement: Auto-update event status when date passes (also run on dashboard)
        // Ready to go → Archive, Preparing → Failed
        $today = date('Y-m-d');
        $pastEvents = $eventsTable->find()
            ->where([
                'Events.event_date <' => $today,
                'OR' => [
                    ['Events.status' => 'Ready to go'],
                    ['Events.status' => 'Preparing']
                ]
            ])
            ->toArray();
        
        foreach ($pastEvents as $event) {
            if ($event->status === 'Ready to go') {
                $event->status = 'Archive';
            } elseif ($event->status === 'Preparing') {
                $event->status = 'Failed';
            }
            $eventsTable->save($event);
        }
        
        // A5 Requirement: Events in coming month by status (dynamic next month)
        $startOfNextMonth = (new \DateTime('first day of next month'));
        $endOfNextMonth = (new \DateTime('last day of next month'));
        $allEventsNextMonth = $eventsTable->find()
            ->select(['Events.id', 'Events.status'])
            ->where([
                'Events.event_date >=' => $startOfNextMonth->format('Y-m-d'),
                'Events.event_date <=' => $endOfNextMonth->format('Y-m-d')
            ])
            ->toArray();
        
        // Count events by status
        $eventsNextMonthCounts = [
            'Preparing' => 0,
            'Ready to go' => 0,
            'Archive' => 0,
            'Failed' => 0
        ];
        
        foreach ($allEventsNextMonth as $event) {
            $status = $event->status ?? 'Preparing';
            if (isset($eventsNextMonthCounts[$status])) {
                $eventsNextMonthCounts[$status]++;
            }
        }
        
        // Convert to array of objects for template compatibility
        $eventsNextMonth = [];
        foreach ($eventsNextMonthCounts as $status => $count) {
            $stat = new \stdClass();
            $stat->status = $status;
            $stat->count = $count;
            $eventsNextMonth[] = $stat;
        }

        // Additional stats for dashboard (keeping A3 stats for compatibility)
        $eventCount = $eventsTable->find()->count();
        $volunteerCount = $volunteersTable->find()->count();
        $orgCount = $organisationsTable->find()->count();
        $messageCount = $contactMessagesTable->find()
            ->where(['ContactMessages.is_replied' => false])
            ->count();
        $signupCount = $volunteerSignupsTable->find()
            ->where(['VolunteerSignups.status' => 'pending'])
            ->count();
        $totalSignupCount = $volunteerSignupsTable->find()->count();
        $hiredSignupCount = $volunteerSignupsTable->find()
            ->where(['VolunteerSignups.status' => 'hired'])
            ->count();
        $declinedSignupCount = $volunteerSignupsTable->find()
            ->where(['VolunteerSignups.status' => 'declined'])
            ->count();

        $this->set(compact(
            'topVolunteers',
            'topOrganisations',
            'skillsStats',
            'eventsNextMonth',
            'eventCount',
            'volunteerCount',
            'orgCount',
            'messageCount',
            'signupCount',
            'totalSignupCount',
            'hiredSignupCount',
            'declinedSignupCount'
        ));
    }
}
