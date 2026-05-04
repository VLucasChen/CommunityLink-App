<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\Date;
use Cake\Mailer\Mailer;
use Exception;

/**
 * VolunteerSignups Controller
 *
 * @property \App\Model\Table\VolunteerSignupsTable $VolunteerSignups
 */
class VolunteerSignupsController extends AppController
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

        $query = $this->VolunteerSignups->find();

        // Search by name only
        $search = $this->request->getQuery('search');
        if ($search) {
            $query->where([
                'OR' => [
                    'VolunteerSignups.first_name LIKE' => '%' . $search . '%',
                    'VolunteerSignups.last_name LIKE' => '%' . $search . '%',
                ],
            ]);
        }

        // Filter by status (show all statuses by default, including hired)
        $status = $this->request->getQuery('status');
        if ($status && in_array($status, ['pending', 'declined', 'hired'])) {
            $query->where(['VolunteerSignups.status' => $status]);
        }
        // If no status filter, show all statuses (pending, declined, hired)

        // Filter by skills (A3 logic preserved)
        $skills = $this->request->getQuery('skills');
        if ($skills) {
            $query->where(['VolunteerSignups.skills LIKE' => '%' . $skills . '%']);
        }

        // Filter by availability (A5 requirement)
        $availability = $this->request->getQuery('availability');
        if ($availability) {
            $query->where(['VolunteerSignups.availability LIKE' => '%' . $availability . '%']);
        }

        // A5 Requirement: Server-side pagination using QueryBuilder
        $volunteerSignups = $this->paginate($query->order(['VolunteerSignups.created' => 'DESC']), [
            'limit' => 10,
        ]);

        $this->set(compact('volunteerSignups', 'search', 'status', 'skills', 'availability'));
    }

    /**
     * View method
     *
     * @param string|null $id Volunteer Signup id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view(?string $id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();

        // Disable layout for admin pages (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);

        $volunteerSignup = $this->VolunteerSignups->get($id, contain: []);
        $this->set(compact('volunteerSignup'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $volunteerSignup = $this->VolunteerSignups->newEmptyEntity();
        if ($this->request->is('post')) {
            $volunteerSignup = $this->VolunteerSignups->patchEntity($volunteerSignup, $this->request->getData());
            if ($this->VolunteerSignups->save($volunteerSignup)) {
                $this->Flash->success(__('The volunteer signup has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The volunteer signup could not be saved. Please, try again.'));
        }
        $this->set(compact('volunteerSignup'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Volunteer Signup id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();

        // Disable layout for admin pages (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);

        $volunteerSignup = $this->VolunteerSignups->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // Only update status from the edit page
            $newStatus = $this->request->getData('status');
            if (in_array($newStatus, ['pending', 'hired', 'declined'], true)) {
                $volunteerSignup->status = $newStatus;
                if ($this->VolunteerSignups->save($volunteerSignup)) {
                    $this->Flash->success(__('Signup status updated.'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The signup status could not be updated. Please, try again.'));
        }
        $this->set(compact('volunteerSignup'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Volunteer Signup id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();

        $this->request->allowMethod(['post', 'delete']);
        $volunteerSignup = $this->VolunteerSignups->get($id);

        // Delete associated files
        if ($volunteerSignup->profile_picture) {
            $profileFilename = str_replace('volunteer_profiles/', '', $volunteerSignup->profile_picture);
            $profilePath = WWW_ROOT . 'img' . DS . 'volunteer_profiles' . DS . $profileFilename;
            if (file_exists($profilePath)) {
                unlink($profilePath);
            }
        }

        if ($volunteerSignup->documents) {
            $docPath = WWW_ROOT . 'volunteer_documents' . DS . $volunteerSignup->documents;
            if (file_exists($docPath)) {
                unlink($docPath);
            }
        }

        if ($this->VolunteerSignups->delete($volunteerSignup)) {
            $this->Flash->success(__('The volunteer signup has been deleted.'));
        } else {
            $this->Flash->error(__('The volunteer signup could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Approve volunteer signup method
     *
     * @param string|null $id Volunteer Signup id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function approve(?string $id = null)
    {
        $this->request->allowMethod(['post', 'patch', 'put']);
        $volunteerSignup = $this->VolunteerSignups->get($id);
        $volunteerSignup->status = 'hired';

        if ($this->VolunteerSignups->save($volunteerSignup)) {
            $this->Flash->success(__('The volunteer signup has been approved.'));
        } else {
            $this->Flash->error(__('The volunteer signup could not be approved. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Decline volunteer signup method
     *
     * @param string|null $id Volunteer Signup id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function decline(?string $id = null)
    {
        $this->request->allowMethod(['post', 'patch', 'put']);
        $volunteerSignup = $this->VolunteerSignups->get($id);
        $volunteerSignup->status = 'declined';

        if ($this->VolunteerSignups->save($volunteerSignup)) {
            $this->Flash->success(__('The volunteer signup has been declined.'));
        } else {
            $this->Flash->error(__('The volunteer signup could not be declined. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Update status method - A3 equivalent for status modal
     * Handles status updates from the modal form (A3 logic preserved)
     *
     * @return \Cake\Http\Response|null Redirects to index.
     */
    public function updateStatus()
    {
        $this->request->allowMethod(['post', 'patch', 'put']);

        $signupId = $this->request->getData('signup_id');
        $newStatus = $this->request->getData('status');

        if (!$signupId || !in_array($newStatus, ['pending', 'hired', 'declined'])) {
            $this->Flash->error(__('Invalid request.'));

            return $this->redirect(['action' => 'index']);
        }

        try {
            $volunteerSignup = $this->VolunteerSignups->get($signupId);
            $volunteerSignup->status = $newStatus;

            // If status is being changed to 'hired', create a volunteer record (A3 logic)
            if ($newStatus === 'hired') {
                $volunteersTable = $this->fetchTable('Volunteers');
                $volunteer = $volunteersTable->newEmptyEntity();

                // Map volunteer signup to volunteer (A5 schema)
                $volunteer->first_name = $volunteerSignup->first_name;
                $volunteer->last_name = $volunteerSignup->last_name;
                $volunteer->email = $volunteerSignup->email;
                $volunteer->phone = $volunteerSignup->phone;
                $volunteer->skills = $volunteerSignup->skills;
                $volunteer->profile_picture = $volunteerSignup->profile_picture;
                $volunteer->documents = $volunteerSignup->documents;
                $volunteer->availability = $volunteerSignup->availability;
                $volunteer->self_intro = $volunteerSignup->self_intro;
                $volunteer->date_submitted = $volunteerSignup->date_submitted ?? new Date();
                $volunteer->status = 'active';

                if ($volunteersTable->save($volunteer)) {
                    $this->Flash->success(__('Volunteer hired successfully! A new volunteer record has been created.'));
                }
            }

            if ($this->VolunteerSignups->save($volunteerSignup)) {
                if ($newStatus !== 'hired') {
                    $this->Flash->success(__('Volunteer signup status updated successfully!'));
                }
            } else {
                $this->Flash->error(__('The volunteer signup could not be updated. Please, try again.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('Database error: ' . $e->getMessage()));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Public volunteer signup page - A5 equivalent to A3 volunteer-signup.php
     * Preserves A3 logic: validation, file upload, email notification
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function publicSignup()
    {
        // Disable layout for public page (has full HTML like A3)
        $this->viewBuilder()->setLayout(null);

        $message = '';
        $error = '';
        $volunteerSignup = $this->VolunteerSignups->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Handle profile picture upload (A5 requirement)
            $profilePicture = '';
            if (!empty($this->request->getUploadedFiles()['profile_picture'])) {
                $file = $this->request->getUploadedFiles()['profile_picture'];

                if ($file->getError() === UPLOAD_ERR_OK) {
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    $fileType = $file->getClientMediaType();

                    if (in_array($fileType, $allowedTypes)) {
                        $fileExtension = strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));
                        $profilePicture = 'signup_' . time() . '_' . uniqid() . '.' . $fileExtension;
                        // Store in webroot/img/volunteer_profiles to align with Volunteers page
                        $uploadDir = WWW_ROOT . 'img' . DS . 'volunteer_profiles' . DS;

                        // Create directory if it doesn't exist
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }

                        $file->moveTo($uploadDir . $profilePicture);
                        $data['profile_picture'] = $profilePicture;
                    } else {
                        $error = 'Profile picture: Only JPG, PNG and GIF files are allowed.';
                    }
                } else {
                    $error = 'Please upload a profile picture.';
                }
            } else {
                $error = 'Please upload a profile picture.';
            }

            // Handle documents upload (A5 requirement: WWCC, Police check, CV etc combined into one PDF)
            $documents = '';
            if (empty($error) && !empty($this->request->getUploadedFiles()['documents'])) {
                $file = $this->request->getUploadedFiles()['documents'];

                if ($file->getError() === UPLOAD_ERR_OK) {
                    // Check file size (10MB max)
                    if ($file->getSize() > 10 * 1024 * 1024) {
                        $error = 'Documents file size must be less than 10MB.';
                    } else {
                        $fileType = $file->getClientMediaType();
                        $fileExtension = strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));

                        // Allow PDF files only
                        if ($fileType === 'application/pdf' || $fileExtension === 'pdf') {
                            $documents = 'signup_docs_' . time() . '_' . uniqid() . '.pdf';
                            // Keep documents in webroot/volunteer_documents (as used elsewhere)
                            $uploadDir = WWW_ROOT . 'volunteer_documents' . DS;

                            // Create directory if it doesn't exist
                            if (!is_dir($uploadDir)) {
                                mkdir($uploadDir, 0755, true);
                            }

                            $file->moveTo($uploadDir . $documents);
                            $data['documents'] = $documents;
                        } else {
                            $error = 'Documents: Only PDF files are allowed. Please combine all documents (WWCC, Police check, CV, etc.) into one PDF.';
                        }
                    }
                } else {
                    $error = 'Please upload your official documents (PDF).';
                }
            } elseif (empty($error)) {
                $error = 'Please upload your official documents (PDF).';
            }

            // Set default status to pending (A3 behavior)
            $data['status'] = 'pending';

            // A5 Requirement: Set date_submitted to today's date
            $data['date_submitted'] = date('Y-m-d');

            // Patch entity with form data
            $volunteerSignup = $this->VolunteerSignups->patchEntity($volunteerSignup, $data);

            if (empty($error) && $this->VolunteerSignups->save($volunteerSignup)) {
                // Send email notification using CakePHP Mailer
                try {
                    $emailBody = "A new volunteer has signed up:\n\n";
                    $emailBody .= 'Name: ' . $volunteerSignup->first_name . ' ' . $volunteerSignup->last_name . "\n";
                    $emailBody .= 'Email: ' . $volunteerSignup->email . "\n";
                    $emailBody .= 'Phone: ' . $volunteerSignup->phone . "\n";
                    $emailBody .= 'Skills: ' . $volunteerSignup->skills . "\n";
                    $emailBody .= 'Availability: ' . ($volunteerSignup->availability ?? 'N/A') . "\n";
                    $emailBody .= "Self-intro:\n" . ($volunteerSignup->self_intro ?? 'N/A') . "\n";
                    $emailBody .= 'Documents: ' . ($volunteerSignup->documents ?? 'N/A') . "\n";
                    $emailBody .= 'Date Submitted: ' . ($volunteerSignup->date_submitted ? $volunteerSignup->date_submitted->format('Y-m-d') : date('Y-m-d')) . "\n\n";
                    $emailBody .= 'Submitted on: ' . date('Y-m-d H:i:s') . "\n";
                    $emailBody .= 'This signup was submitted from the CommunityLink volunteer signup form.';

                    // A5 Requirement: Email must go to admin@communitylink.com
                    $mailer = new Mailer('default');
                    $mailer->setFrom(['noreply@communitylink.com' => 'CommunityLink'])
                        ->setTo('admin@communitylink.com')
                        ->setReplyTo($volunteerSignup->email)
                        ->setSubject('New Volunteer Signup - CommunityLink')
                        ->setEmailFormat('text')
                        ->deliver($emailBody);

                    $message = 'Thank you for your volunteer application! We will review your information and get back to you soon.';
                    $volunteerSignup = $this->VolunteerSignups->newEmptyEntity(); // Clear form
                } catch (Exception $e) {
                    $error = 'Your application was saved but there was an issue sending the email notification. We will still receive your application.';
                }
            } else {
                if (empty($error)) {
                    // Get validation errors from entity
                    $validationErrors = $volunteerSignup->getErrors();
                    if (!empty($validationErrors)) {
                        $errorMessages = [];
                        foreach ($validationErrors as $errors) {
                            foreach ($errors as $errorMsg) {
                                $errorMessages[] = $errorMsg;
                            }
                        }
                        $error = implode('<br>', $errorMessages);
                    } else {
                        $error = 'The volunteer signup could not be saved. Please check your input and try again.';
                    }
                }
            }
        }

        $this->set(compact('volunteerSignup', 'message', 'error'));
    }
}
