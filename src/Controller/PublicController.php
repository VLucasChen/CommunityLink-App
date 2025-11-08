<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;

/**
 * PublicController
 *
 * @property \App\Model\Table\EventsTable $Events
 * @property \App\Model\Table\OrganisationsTable $Organisations
 * @property \App\Model\Table\VolunteerSignupsTable $VolunteerSignups
 * @property \App\Model\Table\ContactMessagesTable $ContactMessages
 */
class PublicController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('public');
        
        // Load tables manually since PublicController doesn't have a corresponding table
        $this->Events = $this->fetchTable('Events');
        $this->Organisations = $this->fetchTable('Organisations');
        $this->VolunteerSignups = $this->fetchTable('VolunteerSignups');
        $this->ContactMessages = $this->fetchTable('ContactMessages');
        
        // Load Users table for profile
        $this->Users = $this->fetchTable('Users');
        
        // Allow all public actions to be accessed without authentication
        $this->Authentication->allowUnauthenticated([
            'home',
            'volunteerRegister',
            'organisationRegister',
            'contact',
            'publicEvents',
            'viewEvent'
        ]);
    }

    // 🏠 Trang chủ
    public function home()
    {
        $events = $this->Events->find()
            ->contain(['Organisations'])
            ->order(['event_date' => 'ASC'])
            ->limit(3)
            ->all();
        $this->set(compact('events'));
    }

    // 🧍 Volunteer đăng ký
    public function volunteerRegister()
    {
        $signup = $this->VolunteerSignups->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Upload ảnh & CV
            if (!empty($data['profile_picture']->getClientFilename())) {
                $file = time() . '_' . $data['profile_picture']->getClientFilename();
                $data['profile_picture']->moveTo(WWW_ROOT . 'uploads/profiles/' . $file);
                $data['profile_picture'] = 'uploads/profiles/' . $file;
            }
            if (!empty($data['documents']->getClientFilename())) {
                $cv = time() . '_' . $data['documents']->getClientFilename();
                $data['documents']->moveTo(WWW_ROOT . 'uploads/documents/' . $cv);
                $data['documents'] = 'uploads/documents/' . $cv;
            }

            $signup = $this->VolunteerSignups->patchEntity($signup, $data);
            if ($this->VolunteerSignups->save($signup)) {
                $this->Flash->success('✅ Registration successful! Thank you for joining CommunityLink.');
                return $this->redirect(['action' => 'volunteerRegister']);
            }
            $this->Flash->error('❌ Registration failed. Please check your input.');
        }
        $this->set(compact('signup'));
    }

    // 🏢 Đăng ký tổ chức
    public function organisationRegister()
    {
        $organisation = $this->Organisations->newEmptyEntity();
        if ($this->request->is('post')) {
            $organisation = $this->Organisations->patchEntity($organisation, $this->request->getData());
            if ($this->Organisations->save($organisation)) {
                $this->Flash->success('✅ Organisation registered successfully!');
                return $this->redirect(['action' => 'organisationRegister']);
            }
            $this->Flash->error('❌ Failed to register organisation.');
        }
        $this->set(compact('organisation'));
    }

    // 📬 Liên hệ
    public function contact()
    {
        $contact = $this->ContactMessages->newEmptyEntity();
        if ($this->request->is('post')) {
            $contact = $this->ContactMessages->patchEntity($contact, $this->request->getData());
            if ($this->ContactMessages->save($contact)) {
                // gửi mail tới Amy (tùy chọn)
                try {
                    $mailer = new Mailer('default');
                    $mailer->setFrom(['noreply@communitylink.com' => 'CommunityLink'])
                        ->setTo('admin@communitylink.com')
                        ->setSubject('New Contact Message from ' . $contact->first_name)
                        ->deliver($contact->message);
                } catch (\Exception $e) {}
                $this->Flash->success('📩 Message sent successfully!');
                return $this->redirect(['action' => 'contact']);
            }
            $this->Flash->error('❌ Unable to send your message.');
        }
        $this->set(compact('contact'));
    }

    // 📅 Danh sách sự kiện công khai
    public function publicEvents()
    {
        $events = $this->Events->find()
            ->contain(['Organisations'])
            ->order(['event_date' => 'ASC'])
            ->all();
        $this->set(compact('events'));
    }

    // 👁️ Xem chi tiết sự kiện (cho public/volunteer)
    public function viewEvent($id = null)
    {
        // Update expired events before loading the event
        $this->Events->updateExpiredEvents();
        
        if (!$id) {
            $this->Flash->error(__('Invalid event ID.'));
            return $this->redirect(['action' => 'publicEvents']);
        }

        $event = $this->Events->find()
            ->contain(['Organisations'])
            ->where(['Events.id' => $id])
            ->first();

        if (!$event) {
            $this->Flash->error(__('Event not found.'));
            return $this->redirect(['action' => 'publicEvents']);
        }

        $this->set(compact('event'));
    }

    // 👤 Xem profile (cho public/volunteer)
    public function profile($id = null)
    {
        // Get current user
        $identity = $this->Authentication->getIdentity();
        $currentUserId = null;
        
        if ($identity) {
            if (is_object($identity)) {
                $currentUserId = $identity->id ?? null;
            } elseif (is_array($identity)) {
                $currentUserId = $identity['id'] ?? $identity['data']['id'] ?? null;
            }
        }
        
        // If no ID provided, use current user's ID
        if (!$id && $currentUserId) {
            $id = $currentUserId;
        }
        
        // If still no ID, redirect to home
        if (!$id) {
            $this->Flash->error(__('Please login to view your profile.'));
            return $this->redirect(['action' => 'home']);
        }
        
        // Users can only view their own profile (unless admin/assistant, but they use Users::profile)
        if ($currentUserId && $currentUserId !== $id) {
            $this->Flash->error(__('You can only view your own profile.'));
            return $this->redirect(['action' => 'profile', $currentUserId]);
        }
        
        $user = $this->Users->get($id, contain: ['Volunteers']);
        $this->set(compact('user'));
    }
}
