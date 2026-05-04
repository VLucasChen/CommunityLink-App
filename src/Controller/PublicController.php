<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;
use Cake\Mailer\Mailer;
use Exception;

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
    /**
     * @inheritDoc
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('public');
    }

    /**
     * Home page with featured events.
     *
     * @return void
     */
    public function home(): void
    {
        $events = $this->Events->find('all', [
            'contain' => ['Organisations'],
            'order' => ['event_date' => 'ASC'],
            'limit' => 3,
        ]);
        $this->set(compact('events'));
    }

    /**
     * Public volunteer registration form.
     *
     * @return \Cake\Http\Response|null
     */
    public function volunteerRegister(): ?Response
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

        return null;
    }

    /**
     * Public partner organisation registration form.
     *
     * @return \Cake\Http\Response|null
     */
    public function organisationRegister(): ?Response
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

        return null;
    }

    /**
     * Public contact form.
     *
     * @return \Cake\Http\Response|null
     */
    public function contact(): ?Response
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
                } catch (Exception $e) {
                }
                $this->Flash->success('📩 Message sent successfully!');

                return $this->redirect(['action' => 'contact']);
            }
            $this->Flash->error('❌ Unable to send your message.');
        }
        $this->set(compact('contact'));

        return null;
    }

    /**
     * Public listing of events.
     *
     * @return void
     */
    public function publicEvents(): void
    {
        $events = $this->Events->find('all', [
            'contain' => ['Organisations'],
            'order' => ['event_date' => 'ASC'],
        ]);
        $this->set(compact('events'));
    }
}
