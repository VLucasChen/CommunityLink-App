<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
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
 * 
 * @property \App\Model\Table\VolunteersTable $Volunteers
 * @property \App\Model\Table\OrganisationsTable $Organisations
 * @property \App\Model\Table\EventsTable $Events
 * @property \App\Model\Table\VolunteerEventsTable $VolunteerEvents
 */
class PagesController extends AppController
{
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
    /**
     * Dashboard action for authenticated users
     *
     * @return \Cake\Http\Response|null
     */
    public function dashboard(): ?Response
    {
        // Only admin and assistant can access dashboard
        $this->requireRole(['admin', 'assistant']);

        // Get current user
        $user = $this->Authentication->getIdentity();
        
        // Load tables
        $this->Volunteers = $this->fetchTable('Volunteers');
        $this->Organisations = $this->fetchTable('Organisations');
        $this->Events = $this->fetchTable('Events');
        $this->VolunteerEvents = $this->fetchTable('VolunteerEvents');
        
        // 1. Top 10 Volunteers (based on number of events participated)
        $topVolunteersQuery = $this->VolunteerEvents->find()
            ->select([
                'volunteer_id',
                'event_count' => 'COUNT(VolunteerEvents.id)'
            ])
            ->group(['VolunteerEvents.volunteer_id'])
            ->order(['event_count' => 'DESC'])
            ->limit(10);
        
        // Format top volunteers data
        $topVolunteersList = [];
        foreach ($topVolunteersQuery as $item) {
            if ($item->volunteer_id) {
                try {
                    $volunteer = $this->Volunteers->get($item->volunteer_id);
                    $topVolunteersList[] = [
                        'volunteer' => $volunteer,
                        'event_count' => $item->event_count
                    ];
                } catch (\Exception $e) {
                    // Skip if volunteer not found
                    continue;
                }
            }
        }
        
        // 2. Top 10 Partners (based on number of events organized)
        $topPartnersQuery = $this->Events->find()
            ->select([
                'organisation_id',
                'event_count' => 'COUNT(Events.id)'
            ])
            ->where(['Events.organisation_id IS NOT' => null])
            ->group(['Events.organisation_id'])
            ->order(['event_count' => 'DESC'])
            ->limit(10);
        
        // Format top partners data
        $topPartnersList = [];
        foreach ($topPartnersQuery as $item) {
            if ($item->organisation_id) {
                try {
                    $organisation = $this->Organisations->get($item->organisation_id);
                    $topPartnersList[] = [
                        'organisation' => $organisation,
                        'event_count' => $item->event_count
                    ];
                } catch (\Exception $e) {
                    // Skip if organisation not found
                    continue;
                }
            }
        }
        
        // 3. Volunteers categorized by skills
        $allVolunteers = $this->Volunteers->find()->all();
        $skillsDistribution = [];
        foreach ($allVolunteers as $volunteer) {
            if (!empty($volunteer->skills)) {
                // Split skills by comma or newline
                $skills = preg_split('/[,\n\r]+/', $volunteer->skills);
                foreach ($skills as $skill) {
                    $skill = trim($skill);
                    if (!empty($skill)) {
                        if (!isset($skillsDistribution[$skill])) {
                            $skillsDistribution[$skill] = 0;
                        }
                        $skillsDistribution[$skill]++;
                    }
                }
            }
        }
        arsort($skillsDistribution);
        $skillsDistribution = array_slice($skillsDistribution, 0, 10, true); // Top 10 skills
        
        // 4. Events scheduled for next month (counted by status)
        $nextMonthStart = new \DateTime('first day of next month');
        $nextMonthEnd = new \DateTime('last day of next month');
        
        $nextMonthEvents = $this->Events->find()
            ->where([
                'Events.event_date >=' => $nextMonthStart->format('Y-m-d'),
                'Events.event_date <=' => $nextMonthEnd->format('Y-m-d')
            ])
            ->all();
        
        $eventsByStatus = [
            'Preparing' => 0,
            'Ready to go' => 0,
            'Archive' => 0,
            'Failed' => 0
        ];
        
        foreach ($nextMonthEvents as $event) {
            if (isset($eventsByStatus[$event->status])) {
                $eventsByStatus[$event->status]++;
            }
        }
        
        $this->set(compact('user', 'topVolunteersList', 'topPartnersList', 'skillsDistribution', 'eventsByStatus'));
        return null;
    }

    public function display(string ...$path): ?Response
    {
        if (!$path) {
            return $this->redirect('/');
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

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}
