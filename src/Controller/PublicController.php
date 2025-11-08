<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;

class PublicController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Events');
        $this->loadModel('Organisations');
        $this->loadModel('VolunteerSignups');
        $this->loadModel('ContactMessages');
        $this->viewBuilder()->setLayout('public');
    }

    // 🏠 Trang chủ
    public function home()
    {
        $events = $this->Events->find('all', [
            'contain' => ['Organisations'],
            'order' => ['event_date' => 'ASC'],
            'limit' => 3
        ]);
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
        $events = $this->Events->find('all', [
            'contain' => ['Organisations'],
            'order' => ['event_date' => 'ASC']
        ]);
        $this->set(compact('events'));
    }
}
