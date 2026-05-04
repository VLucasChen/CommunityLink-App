<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;
use Exception;

/**
 * ContactMessages Controller
 *
 * @property \App\Model\Table\ContactMessagesTable $ContactMessages
 */
class ContactMessagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->requireLogin();
        $this->requireAdmin();

        // Disable layout for admin pages (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);

        $query = $this->ContactMessages->find();

        // Filters: sender name and message content
        $sender = $this->request->getQuery('sender');
        if ($sender) {
            $query->where([
                'OR' => [
                    'ContactMessages.first_name LIKE' => '%' . $sender . '%',
                    'ContactMessages.last_name LIKE' => '%' . $sender . '%',
                ],
            ]);
        }
        $messageFilter = $this->request->getQuery('message');
        if ($messageFilter) {
            $query->where(['ContactMessages.message LIKE' => '%' . $messageFilter . '%']);
        }

        // Filter by reply status (A3 logic preserved)
        $status_filter = $this->request->getQuery('status');
        if ($status_filter === 'replied') {
            $query->where(['ContactMessages.is_replied' => true]);
        } elseif ($status_filter === 'unreplied') {
            $query->where(['ContactMessages.is_replied' => false]);
        }

        // A5 Requirement: Server-side pagination using QueryBuilder
        $contactMessages = $this->paginate($query->order(['ContactMessages.created' => 'DESC']), [
            'limit' => 10,
        ]);

        $this->set(compact('contactMessages', 'sender', 'messageFilter', 'status_filter'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact Message id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();

        // Disable layout for admin pages (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);

        $contactMessage = $this->ContactMessages->get($id, contain: []);
        $this->set(compact('contactMessage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contactMessage = $this->ContactMessages->newEmptyEntity();
        if ($this->request->is('post')) {
            $contactMessage = $this->ContactMessages->patchEntity($contactMessage, $this->request->getData());
            if ($this->ContactMessages->save($contactMessage)) {
                $this->Flash->success(__('The contact message has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact message could not be saved. Please, try again.'));
        }
        $this->set(compact('contactMessage'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Contact Message id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();
        $this->viewBuilder()->setLayout(null);

        $contactMessage = $this->ContactMessages->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $action = $this->request->getData('action');
            if ($action === 'reply') {
                $replyBody = (string)($this->request->getData('reply_body') ?? '');
                try {
                    $mailer = new Mailer('default');
                    $mailer->setFrom(['admin@communitylink.com' => 'CommunityLink'])
                        ->setTo($contactMessage->email)
                        ->setSubject('Re: Your message to CommunityLink')
                        ->setEmailFormat('text')
                        ->deliver('Dear ' . ($contactMessage->first_name ?: 'Community member') . ",\n\n" . $replyBody . "\n\nBest regards,\nCommunityLink");
                    $this->Flash->success(__('Reply sent successfully.'));
                } catch (Exception $e) {
                    $this->Flash->error(__('Failed to send the reply. Please try again.'));
                }

                return $this->redirect(['action' => 'index']);
            } else {
                // Only allow changing reply status
                $isReplied = (bool)$this->request->getData('is_replied');
                $contactMessage->is_replied = $isReplied;
                if ($this->ContactMessages->save($contactMessage)) {
                    $this->Flash->success(__('Status updated.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The status could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('contactMessage'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();
        $this->request->allowMethod(['post', 'delete']);
        $messagesTable = $this->fetchTable('ContactMessages');
        $contactMessage = $messagesTable->get($id);
        if ($messagesTable->delete($contactMessage)) {
            $this->Flash->success(__('The contact message has been deleted.'));
        } else {
            $this->Flash->error(__('The contact message could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Mark as replied method
     *
     * @param string|null $id Contact Message id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function markReplied(?string $id = null)
    {
        $this->request->allowMethod(['post', 'patch', 'put']);
        $contactMessage = $this->ContactMessages->get($id);
        $contactMessage->is_replied = true;

        if ($this->ContactMessages->save($contactMessage)) {
            $this->Flash->success(__('The contact message has been marked as replied.'));
        } else {
            $this->Flash->error(__('The contact message could not be marked as replied. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Public contact form page - A5 equivalent to A3 contact.php
     * Preserves A3 logic: validation, email notification
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function publicContact()
    {
        // Disable layout for public page (has full HTML like A3)
        $this->viewBuilder()->setLayout(null);

        $message = '';
        $error = '';
        $contactMessage = $this->ContactMessages->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Patch entity with form data
            $contactMessage = $this->ContactMessages->patchEntity($contactMessage, $data);

            if ($this->ContactMessages->save($contactMessage)) {
                // Send email notification using CakePHP Mailer
                try {
                    $emailBody = "A new contact form has been submitted:\n\n";
                    $emailBody .= 'Name: ' . $contactMessage->first_name . ' ' . $contactMessage->last_name . "\n";
                    $emailBody .= 'Email: ' . $contactMessage->email . "\n";
                    $emailBody .= 'Phone: ' . $contactMessage->phone . "\n";
                    $emailBody .= "Message:\n" . $contactMessage->message . "\n\n";
                    $emailBody .= 'Submitted on: ' . date('Y-m-d H:i:s') . "\n";
                    $emailBody .= 'This message was sent from the CommunityLink website contact form.';

                    // A5 Requirement: Email must go to admin@communitylink.com
                    $mailer = new Mailer('default');
                    $mailer->setFrom(['noreply@communitylink.com' => 'CommunityLink'])
                        ->setTo('admin@communitylink.com')
                        ->setReplyTo($contactMessage->email)
                        ->setSubject('New Contact Form Submission - CommunityLink')
                        ->setEmailFormat('text')
                        ->deliver($emailBody);

                    $message = 'Thank you for your message! We will get back to you soon.';
                    $contactMessage = $this->ContactMessages->newEmptyEntity(); // Clear form
                } catch (Exception $e) {
                    $error = 'Your message was saved but there was an issue sending the email notification. We will still receive your message.';
                }
            } else {
                // Get validation errors from entity
                $validationErrors = $contactMessage->getErrors();
                if (!empty($validationErrors)) {
                    $errorMessages = [];
                    foreach ($validationErrors as $errors) {
                        foreach ($errors as $errorMsg) {
                            $errorMessages[] = $errorMsg;
                        }
                    }
                    $error = implode('<br>', $errorMessages);
                } else {
                    $error = 'The contact message could not be saved. Please check your input and try again.';
                }
            }
        }

        $this->set(compact('contactMessage', 'message', 'error'));
    }
}
