<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Mailer;
use Exception;

/**
 * Organisations Controller
 *
 * @property \App\Model\Table\OrganisationsTable $Organisations
 */
class OrganisationsController extends AppController
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

        $query = $this->Organisations->find()
            ->contain(['Events']);

        // Search by organisation name only
        $search = $this->request->getQuery('search');
        if ($search) {
            $query->where(['Organisations.org_name LIKE' => '%' . $search . '%']);
        }

        // Filter by industry (partial match) and description (partial match)
        $industry = $this->request->getQuery('industry');
        if ($industry) {
            $query->where(['Organisations.industry LIKE' => '%' . $industry . '%']);
        }
        $description = $this->request->getQuery('description');
        if ($description) {
            $query->where(['Organisations.help_description LIKE' => '%' . $description . '%']);
        }

        // A5 Requirement: Server-side pagination using QueryBuilder
        $organisations = $this->paginate($query->order(['Organisations.org_name' => 'ASC']), [
            'limit' => 10,
        ]);

        $this->set(compact('organisations', 'search', 'industry', 'description'));
    }

    /**
     * View method
     *
     * @param string|null $id Organisation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();

        // Disable layout for admin pages (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);

        // A5 Requirement: View organisation details including related events
        $organisation = $this->Organisations->get($id, contain: ['Events']);
        $this->set(compact('organisation'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->requireLogin();
        $this->requireAdmin();
        $this->viewBuilder()->setLayout(null);
        $organisation = $this->Organisations->newEmptyEntity();
        if ($this->request->is('post')) {
            $organisation = $this->Organisations->patchEntity($organisation, $this->request->getData());
            if ($this->Organisations->save($organisation)) {
                $this->Flash->success(__('The organisation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // Display validation errors if save fails
            $errors = $organisation->getErrors();
            if (!empty($errors)) {
                foreach ($errors as $field => $fieldErrors) {
                    foreach ($fieldErrors as $error) {
                        $this->Flash->error(__('{0}: {1}', [ucfirst($field), $error]));
                    }
                }
            } else {
                $this->Flash->error(__('The organisation could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('organisation'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Organisation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();
        $this->viewBuilder()->setLayout(null);
        $organisation = $this->Organisations->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $organisation = $this->Organisations->patchEntity($organisation, $this->request->getData());
            if ($this->Organisations->save($organisation)) {
                $this->Flash->success(__('The organisation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // Display validation errors if save fails
            $errors = $organisation->getErrors();
            if (!empty($errors)) {
                foreach ($errors as $field => $fieldErrors) {
                    foreach ($fieldErrors as $error) {
                        $this->Flash->error(__('{0}: {1}', [ucfirst($field), $error]));
                    }
                }
            } else {
                $this->Flash->error(__('The organisation could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('organisation'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Organisation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();
        $this->request->allowMethod(['post', 'delete']);
        $organisation = $this->Organisations->get($id);
        if ($this->Organisations->delete($organisation)) {
            $this->Flash->success(__('The organisation has been deleted.'));
        } else {
            $this->Flash->error(__('The organisation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Public organisation signup page - A5 requirement
     * Allows partner organisations to register publicly
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function publicSignup()
    {
        // Disable layout for public page (has full HTML like A3)
        $this->viewBuilder()->setLayout(null);

        $message = '';
        $error = '';
        $organisation = $this->Organisations->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Patch entity with form data
            $organisation = $this->Organisations->patchEntity($organisation, $data);

            if ($this->Organisations->save($organisation)) {
                // Send email notification using CakePHP Mailer
                try {
                    $emailBody = "A new partner organisation has registered:\n\n";
                    $emailBody .= 'Business Name: ' . $organisation->org_name . "\n";
                    $emailBody .= 'Business Address: ' . $organisation->business_address . "\n";
                    $emailBody .= 'Contact Person: ' . $organisation->contact_person_full_name . "\n";
                    $emailBody .= 'Email: ' . $organisation->email . "\n";
                    $emailBody .= 'Phone: ' . $organisation->phone . "\n";
                    $emailBody .= 'Industry: ' . $organisation->industry . "\n";
                    $emailBody .= "What they can help with:\n" . $organisation->help_description . "\n\n";
                    $emailBody .= 'Submitted on: ' . date('Y-m-d H:i:s') . "\n";
                    $emailBody .= 'This registration was submitted from the CommunityLink website.';

                    // A5 Requirement: Email must go to admin@communitylink.com
                    $mailer = new Mailer('default');
                    $mailer->setFrom(['noreply@communitylink.com' => 'CommunityLink'])
                        ->setTo('admin@communitylink.com')
                        ->setReplyTo($organisation->email)
                        ->setSubject('New Partner Organisation Registration - CommunityLink')
                        ->setEmailFormat('text')
                        ->deliver($emailBody);

                    $message = 'Thank you for your registration! We will review your information and get back to you soon.';
                    $organisation = $this->Organisations->newEmptyEntity(); // Clear form
                } catch (Exception $e) {
                    $error = 'Your registration was saved but there was an issue sending the email notification. We will still receive your registration.';
                }
            } else {
                // Get validation errors from entity
                $validationErrors = $organisation->getErrors();
                if (!empty($validationErrors)) {
                    $errorMessages = [];
                    foreach ($validationErrors as $errors) {
                        foreach ($errors as $errorMsg) {
                            $errorMessages[] = $errorMsg;
                        }
                    }
                    $error = implode('<br>', $errorMessages);
                } else {
                    $error = 'The organisation registration could not be saved. Please check your input and try again.';
                }
            }
        }

        $this->set(compact('organisation', 'message', 'error'));
    }
}
