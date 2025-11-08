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
        
        // Load Volunteers table for profile editing
        $this->Volunteers = $this->fetchTable('Volunteers');
        
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
        
        // Users can only view their own profile
        if ($currentUserId && $currentUserId !== $id) {
            $this->Flash->error(__('You can only view your own profile.'));
            return $this->redirect(['action' => 'profile', $currentUserId]);
        }
        
        $user = $this->Users->get($id, contain: ['Volunteers']);
        $volunteer = null;
        
        // Get volunteer if exists
        if ($user->volunteer_id) {
            try {
                $volunteer = $this->Volunteers->get($user->volunteer_id);
            } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
                $volunteer = null;
            }
        }
        
        $this->set(compact('user', 'volunteer'));
    }

    // ✏️ Chỉnh sửa profile (cho public/volunteer)
    public function editProfile($id = null)
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
            $this->Flash->error(__('Please login to edit your profile.'));
            return $this->redirect(['action' => 'home']);
        }
        
        // Users can only edit their own profile
        if ($currentUserId && $currentUserId !== $id) {
            $this->Flash->error(__('You can only edit your own profile.'));
            return $this->redirect(['action' => 'editProfile', $currentUserId]);
        }
        
        $user = $this->Users->get($id, contain: ['Volunteers']);
        $volunteer = null;
        $isNewVolunteer = false;
        
        // Get volunteer if exists, otherwise create a new one
        if ($user->volunteer_id) {
            try {
                $volunteer = $this->Volunteers->get($user->volunteer_id);
                // Convert null values to empty strings for form display
                $volunteer->last_name = $volunteer->last_name ?? '';
                $volunteer->email = $volunteer->email ?? '';
                $volunteer->phone = $volunteer->phone ?? '';
                $volunteer->skills = $volunteer->skills ?? '';
                $volunteer->availability = $volunteer->availability ?? '';
                $volunteer->self_intro = $volunteer->self_intro ?? '';
                // Ensure first_name is set
                if (empty($volunteer->first_name)) {
                    $volunteer->first_name = $user->username ?? '';
                }
            } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
                // Volunteer not found, create a new one with default values
                $volunteer = $this->Volunteers->newEmptyEntity();
                $volunteer = $this->Volunteers->patchEntity($volunteer, [
                    'first_name' => $user->username ?? '',
                    'last_name' => '',
                    'email' => '',
                    'phone' => '',
                    'skills' => '',
                    'availability' => '',
                    'self_intro' => '',
                    'status' => 'active'
                ], ['validate' => false]);
                $isNewVolunteer = true;
            }
        } else {
            // No volunteer associated, create a new one with default values
            $volunteer = $this->Volunteers->newEmptyEntity();
            $volunteer = $this->Volunteers->patchEntity($volunteer, [
                'first_name' => $user->username ?? '',
                'last_name' => '',
                'email' => '',
                'phone' => '',
                'skills' => '',
                'availability' => '',
                'self_intro' => '',
                'status' => 'active'
            ], ['validate' => false]);
            $isNewVolunteer = true;
        }
        
        // Handle POST request for editing
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            // Handle profile_picture upload
            if (isset($data['profile_picture']) && $data['profile_picture'] instanceof \Laminas\Diactoros\UploadedFile) {
                if (!empty($data['profile_picture']->getClientFilename()) && $data['profile_picture']->getError() === UPLOAD_ERR_OK) {
                    $file = time() . '_' . $data['profile_picture']->getClientFilename();
                    $uploadDir = WWW_ROOT . 'uploads' . DS . 'volunteers' . DS . 'profiles' . DS;
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $data['profile_picture']->moveTo($uploadDir . $file);
                    $data['profile_picture'] = 'uploads/volunteers/profiles/' . $file;
                } else {
                    // No file uploaded, remove from data to keep existing value
                    unset($data['profile_picture']);
                }
            }
            
            // Handle documents upload
            if (isset($data['documents']) && $data['documents'] instanceof \Laminas\Diactoros\UploadedFile) {
                if (!empty($data['documents']->getClientFilename()) && $data['documents']->getError() === UPLOAD_ERR_OK) {
                    $file = time() . '_' . $data['documents']->getClientFilename();
                    $uploadDir = WWW_ROOT . 'uploads' . DS . 'volunteers' . DS . 'documents' . DS;
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $data['documents']->moveTo($uploadDir . $file);
                    $data['documents'] = 'uploads/volunteers/documents/' . $file;
                } else {
                    // No file uploaded, remove from data to keep existing value
                    unset($data['documents']);
                }
            }
            
            $volunteer = $this->Volunteers->patchEntity($volunteer, $data, [
                'validate' => true,
                'guard' => false
            ]);
            if ($this->Volunteers->save($volunteer)) {
                // If volunteer was just created, link it to the user
                if (!$user->volunteer_id) {
                    $user->volunteer_id = $volunteer->id;
                    $this->Users->save($user);
                }
                $this->Flash->success('✅ Profile updated successfully!');
                return $this->redirect(['action' => 'profile', $id]);
            }
            $this->Flash->error('❌ Failed to update profile. Please check your input.');
        }
        
        // Ensure volunteer data is properly loaded
        // If volunteer exists in DB, make sure we have fresh data
        // If it's new, the set() values should be available
        $this->set(compact('user', 'volunteer', 'isNewVolunteer'));
    }
}
