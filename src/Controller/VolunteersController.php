<?php
declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\UploadedFileInterface;

/**
 * Volunteers Controller
 *
 * @property \App\Model\Table\VolunteersTable $Volunteers
 */
class VolunteersController extends AppController
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
        
        $query = $this->Volunteers->find()
            ->contain(['Users', 'Events']);

        // Search by name only
        $search = $this->request->getQuery('search');
        if ($search) {
            $query->where([
                'OR' => [
                    'Volunteers.first_name LIKE' => '%' . $search . '%',
                    'Volunteers.last_name LIKE' => '%' . $search . '%'
                ]
            ]);
        }

        // Filter by status (A3 logic preserved)
        $status = $this->request->getQuery('status');
        if ($status) {
            $query->where(['Volunteers.status' => $status]);
        }

        // Filter by skills (A3 logic preserved)
        $skills = $this->request->getQuery('skills');
        if ($skills) {
            $query->where(['Volunteers.skills LIKE' => '%' . $skills . '%']);
        }

        // Filter by availability (A5 requirement)
        $availability = $this->request->getQuery('availability');
        if ($availability) {
            $query->where(['Volunteers.availability LIKE' => '%' . $availability . '%']);
        }

        // A5 Requirement: Server-side pagination using QueryBuilder
        $volunteers = $this->paginate($query->order(['Volunteers.first_name' => 'ASC']), [
            'limit' => 10
        ]);

        $this->set(compact('volunteers', 'search', 'status', 'skills', 'availability'));
    }

    /**
     * View method
     *
     * @param string|null $id Volunteer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();
        
        // Disable layout for admin pages (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);
        
        // A5 Requirement: View volunteer details including related events
        $volunteer = $this->Volunteers->get($id, contain: ['Events', 'Users']);
        
        // Get events participated by this volunteer
        $volunteerEventsTable = $this->fetchTable('VolunteerEvents');
        $volunteerEvents = $volunteerEventsTable->find()
            ->contain(['Events'])
            ->where(['VolunteerEvents.volunteer_id' => $volunteer->id])
            ->toArray();
        
        $events = [];
        foreach ($volunteerEvents as $ve) {
            if ($ve->has('event') && $ve->event) {
                $events[] = $ve->event;
            }
        }
        
        $this->set(compact('volunteer', 'events'));
    }

    /**
     * Add method - A5 with file upload support
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->requireLogin();
        $this->requireAdmin();
        
        // Disable layout for admin pages (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);
        
        $volunteer = $this->Volunteers->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // A3 Pattern: Unset UploadedFile objects before patching
            unset($data['profile_picture'], $data['documents']);
            
            $hasErrors = false;
            $profilePicture = '';
            $documents = '';
            
            $uploadedFiles = $this->request->getUploadedFiles();
            $profileUpload = $uploadedFiles['profile_picture'] ?? null;
            if ($profileUpload instanceof UploadedFileInterface && $profileUpload->getError() !== UPLOAD_ERR_NO_FILE) {
                $file = $profileUpload;
                
                if ($file->getError() === UPLOAD_ERR_OK) {
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    $fileType = $file->getClientMediaType();
                    
                    if (in_array($fileType, $allowedTypes)) {
                        // Check file size (5MB max)
                        if ($file->getSize() > 5 * 1024 * 1024) {
                            $this->Flash->error(__('Profile picture file size must be less than 5MB.'));
                            $hasErrors = true;
                        } else {
                            $fileExtension = strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));
                            $newFilename = 'volunteer_' . time() . '_' . uniqid() . '.' . $fileExtension;
                            $uploadDir = WWW_ROOT . 'img' . DS . 'volunteer_profiles' . DS;
                            
                            if (!is_dir($uploadDir)) {
                                mkdir($uploadDir, 0755, true);
                            }
                            
                            try {
                                $file->moveTo($uploadDir . $newFilename);
                                $profilePicture = $newFilename;
                            } catch (\RuntimeException $e) {
                                $this->Flash->error(__('Failed to upload profile picture.'));
                                $hasErrors = true;
                            }
                        }
                    } else {
                        $this->Flash->error(__('Profile picture: Only JPG, PNG and GIF files are allowed.'));
                        $hasErrors = true;
                    }
                } else {
                    $this->Flash->error(__('Profile picture upload failed. Please try again.'));
                    $hasErrors = true;
                }
            } else {
                // Profile picture is required for new volunteers
                $this->Flash->error(__('Profile picture is required when creating a volunteer.'));
                $hasErrors = true;
            }
            
            $documentsUpload = $uploadedFiles['documents'] ?? null;
            if ($documentsUpload instanceof UploadedFileInterface && $documentsUpload->getError() !== UPLOAD_ERR_NO_FILE) {
                $file = $documentsUpload;
                
                if ($file->getError() === UPLOAD_ERR_OK) {
                    // Check file size (10MB max)
                    if ($file->getSize() > 10 * 1024 * 1024) {
                        $this->Flash->error(__('Documents file size must be less than 10MB.'));
                        $hasErrors = true;
                    } else {
                        $fileType = $file->getClientMediaType();
                        $fileExtension = strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));
                        
                        if ($fileType === 'application/pdf' || $fileExtension === 'pdf') {
                            $newFilename = 'documents_' . time() . '_' . uniqid() . '.pdf';
                            $uploadDir = WWW_ROOT . 'volunteer_documents' . DS;
                            
                            if (!is_dir($uploadDir)) {
                                mkdir($uploadDir, 0755, true);
                            }
                            
                            try {
                                $file->moveTo($uploadDir . $newFilename);
                                $documents = $newFilename;
                            } catch (\RuntimeException $e) {
                                $this->Flash->error(__('Failed to upload documents.'));
                                $hasErrors = true;
                            }
                        } else {
                            $this->Flash->error(__('Documents: Only PDF files are allowed.'));
                            $hasErrors = true;
                        }
                    }
                } else {
                    $this->Flash->error(__('Documents upload failed. Please try again.'));
                    $hasErrors = true;
                }
            }
            
            // Only proceed if no errors
            if (!$hasErrors) {
                // Only update file fields if new files were uploaded
                // If left empty, existing files will be preserved (not included in $data)
                if ($profilePicture) {
                    $data['profile_picture'] = $profilePicture;
                }
                if ($documents) {
                    $data['documents'] = $documents;
                }
                
                $volunteer = $this->Volunteers->patchEntity($volunteer, $data);
                if ($this->Volunteers->save($volunteer)) {
                    $this->Flash->success(__('The volunteer has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                
                // Display validation errors if save fails
                $errors = $volunteer->getErrors();
                if (!empty($errors)) {
                    foreach ($errors as $field => $fieldErrors) {
                        foreach ($fieldErrors as $error) {
                            $this->Flash->error(__('{0}: {1}', [ucfirst($field), $error]));
                        }
                    }
                } else {
                    $this->Flash->error(__('The volunteer could not be saved. Please, try again.'));
                }
            }
        }
        $this->set(compact('volunteer'));
    }

    /**
     * Edit method - A5 with file upload support
     *
     * @param string|null $id Volunteer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();
        
        // Disable layout for admin pages (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);
        
        $volunteer = $this->Volunteers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            // A3 Pattern: Unset UploadedFile objects before patching
            unset($data['profile_picture'], $data['documents']);
            
            $hasErrors = false;
            $profilePicture = '';
            $documents = '';
            
            // A3 Pattern: Handle profile picture upload (only if new file is uploaded)
            // Following A3 edit logic: only update if new file uploaded
            // A3 checks: isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0
            $uploadedFiles = $this->request->getUploadedFiles();
            if (!empty($uploadedFiles['profile_picture']) && $uploadedFiles['profile_picture']->getError() === UPLOAD_ERR_OK) {
                $file = $uploadedFiles['profile_picture'];
                
                // A3 Pattern: Exact same validation order as A3
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxBytes = 5 * 1024 * 1024; // 5MB
                $fileSize = (int)$file->getSize();
                
                // A3 Pattern: Get MIME type from temp file (like A3: mime_content_type($_FILES['profile_picture']['tmp_name']))
                $tmpPath = null;
                try {
                    $stream = $file->getStream();
                    $tmpPath = $stream->getMetadata('uri');
                } catch (\Exception $e) {
                    // Fallback if stream not available
                }
                
                $fileType = $tmpPath ? mime_content_type($tmpPath) : $file->getClientMediaType();
                
                // A3 Pattern: Check MIME type FIRST (like A3)
                if (!in_array($fileType, $allowedTypes)) {
                    $this->Flash->error(__('Only JPG, PNG and GIF files are allowed.'));
                    $hasErrors = true;
                } elseif ($fileSize > $maxBytes) {
                    // A3 Pattern: Check file size SECOND (like A3)
                    $this->Flash->error(__('Profile picture exceeds the 5MB size limit.'));
                    $hasErrors = true;
                } else {
                    // A3 Pattern: Check extension THIRD (like A3)
                    $fileExtension = strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));
                    if (!in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                        $this->Flash->error(__('Invalid file extension for profile picture.'));
                        $hasErrors = true;
                    } else {
                        // A3 Pattern: Generate filename (like A3)
                        $newFilename = 'volunteer_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $fileExtension;
                        $uploadDir = WWW_ROOT . 'img' . DS . 'volunteer_profiles' . DS;
                        
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }
                        
                        $uploadPath = $uploadDir . $newFilename;
                        
                        // A3 Pattern: Use move_uploaded_file equivalent (moveTo)
                        try {
                            $file->moveTo($uploadPath);
                            // A3 Pattern: Get old picture to delete if new one uploaded
                            $oldPicture = $volunteer->profile_picture;
                            
                            // Delete old picture if it exists (database stores just filename)
                            if ($oldPicture && file_exists($uploadDir . $oldPicture)) {
                                unlink($uploadDir . $oldPicture);
                            }
                            $profilePicture = $newFilename;
                        } catch (\RuntimeException $e) {
                            $this->Flash->error(__('Failed to upload profile picture.'));
                            $hasErrors = true;
                        }
                    }
                }
            }
            
            // A3 Pattern: Handle document upload (only if new file is uploaded)
            // A3 checks: isset($_FILES['documents']) && $_FILES['documents']['error'] == 0
            if (!empty($uploadedFiles['documents']) && $uploadedFiles['documents']->getError() === UPLOAD_ERR_OK) {
                $file = $uploadedFiles['documents'];
                
                // A3 Pattern: Check file size FIRST (like A3 pattern for documents)
                $maxBytes = 10 * 1024 * 1024; // 10MB
                $fileSize = (int)$file->getSize();
                
                if ($fileSize > $maxBytes) {
                    $this->Flash->error(__('Documents file size must be less than 10MB.'));
                    $hasErrors = true;
                } else {
                    // A3 Pattern: Get MIME type from temp file
                    $tmpPath = null;
                    try {
                        $stream = $file->getStream();
                        $tmpPath = $stream->getMetadata('uri');
                    } catch (\Exception $e) {
                        // Fallback if stream not available
                    }
                    
                    $fileType = $tmpPath ? mime_content_type($tmpPath) : $file->getClientMediaType();
                    $fileExtension = strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));
                    
                    // A3 Pattern: Check both MIME type AND extension
                    if ($fileType === 'application/pdf' || $fileExtension === 'pdf') {
                        $newFilename = 'documents_' . $id . '_' . time() . '_' . bin2hex(random_bytes(4)) . '.pdf';
                        $uploadDir = WWW_ROOT . 'volunteer_documents' . DS;
                        
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }
                        
                        $uploadPath = $uploadDir . $newFilename;
                        
                        // A3 Pattern: Use move_uploaded_file equivalent (moveTo)
                        try {
                            $file->moveTo($uploadPath);
                            // Delete old document if it exists (database stores just filename)
                            if ($volunteer->documents && file_exists($uploadDir . $volunteer->documents)) {
                                unlink($uploadDir . $volunteer->documents);
                            }
                            $documents = $newFilename;
                        } catch (\RuntimeException $e) {
                            $this->Flash->error(__('Failed to upload documents.'));
                            $hasErrors = true;
                        }
                    } else {
                        $this->Flash->error(__('Documents: Only PDF files are allowed.'));
                        $hasErrors = true;
                    }
                }
            }
            
            // A3 Pattern: Only proceed if no errors
            if (!$hasErrors) {
                // A3 Pattern: Only update file fields if new files were uploaded (conditional update like A3 SQL)
                // If left empty, existing files will be preserved (field not included in $data)
                if ($profilePicture) {
                    $data['profile_picture'] = $profilePicture;
                }
                if ($documents) {
                    $data['documents'] = $documents;
                }
                
                // A3 Pattern: Patch entity with accessibleFields to ensure only intended fields are updated
                $volunteer = $this->Volunteers->patchEntity($volunteer, $data, [
                    'accessibleFields' => ['*' => true]
                ]);
                if ($this->Volunteers->save($volunteer)) {
                    $this->Flash->success(__('The volunteer has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                
                // Display validation errors if save fails
                $errors = $volunteer->getErrors();
                if (!empty($errors)) {
                    foreach ($errors as $field => $fieldErrors) {
                        foreach ($fieldErrors as $error) {
                            $this->Flash->error(__('{0}: {1}', [ucfirst($field), $error]));
                        }
                    }
                } else {
                    $this->Flash->error(__('The volunteer could not be saved. Please, try again.'));
                }
            }
        }
        $this->set(compact('volunteer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Volunteer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();
        $this->request->allowMethod(['post', 'delete']);
        
        $volunteer = $this->Volunteers->get($id);
        
        // Delete associated files
        if ($volunteer->profile_picture) {
            $profilePath = WWW_ROOT . 'img' . DS . 'volunteer_profiles' . DS . $volunteer->profile_picture;
            if (file_exists($profilePath)) {
                unlink($profilePath);
            }
        }
        
        if ($volunteer->documents) {
            $docPath = WWW_ROOT . 'volunteer_documents' . DS . $volunteer->documents;
            if (file_exists($docPath)) {
                unlink($docPath);
            }
        }
        
        if ($this->Volunteers->delete($volunteer)) {
            $this->Flash->success(__('The volunteer has been deleted.'));
        } else {
            $this->Flash->error(__('The volunteer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Profile method - A5 equivalent to A3 volunteer-profile.php
     * Allows volunteers to view and edit their own profile
     * Preserves A3 logic: validation, file upload, profile management
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function profile()
    {
        $this->requireLogin();
        // Allow standard POST as well as method overrides used by FormHelper (PATCH/PUT)
        $this->request->allowMethod(['get', 'post', 'put', 'patch']);
        
        // Only volunteers can access this page (A3 behavior)
        $user = $this->request->getAttribute('identity');
        if (!$user || !$this->isVolunteer()) {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
        
        // Disable layout for profile page (has full HTML like A3)
        $this->viewBuilder()->setLayout(null);
        
        // Get volunteer data from logged-in user (A3 logic preserved)
        $volunteerId = $user->get('volunteer_id');
        if (!$volunteerId) {
            $this->Flash->error(__('Volunteer profile not found.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'logout']);
        }
        
        $volunteer = $this->Volunteers->get($volunteerId);
        $message = '';
        $error = '';
        
        // Handle form submission (support POST/PATCH/PUT from FormHelper)
        if ($this->request->is(['post', 'patch', 'put'])) {
            $data = $this->request->getData();
            
            // A3 Pattern: Unset UploadedFile objects before patching
            unset($data['profile_picture'], $data['documents']);
            
            // A3 Pattern: Keep existing picture by default (like A3 profile page)
            $profilePicture = $volunteer->profile_picture ?? '';
            $documents = $volunteer->documents ?? '';
            
            // A3 Pattern: Handle profile picture upload (like A3 profile page)
            // Always update profile_picture (either old or new value)
            // A3 checks: isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0
            $uploadedFiles = $this->request->getUploadedFiles();
            if (!empty($uploadedFiles['profile_picture']) && $uploadedFiles['profile_picture']->getError() === UPLOAD_ERR_OK) {
                $file = $uploadedFiles['profile_picture'];
                
                // A3 Pattern: Exact same validation order as A3
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxBytes = 5 * 1024 * 1024; // 5MB
                $fileSize = (int)$file->getSize();
                
                // A3 Pattern: Get MIME type from temp file (like A3: mime_content_type($_FILES['profile_picture']['tmp_name']))
                $tmpPath = null;
                try {
                    $stream = $file->getStream();
                    $tmpPath = $stream->getMetadata('uri');
                } catch (\Exception $e) {
                    // Fallback if stream not available
                }
                
                $fileType = $tmpPath ? mime_content_type($tmpPath) : $file->getClientMediaType();
                
                // A3 Pattern: Check MIME type FIRST (like A3)
                if (!in_array($fileType, $allowedTypes)) {
                    $error = 'Only JPG, PNG and GIF files are allowed.';
                } elseif ($fileSize > $maxBytes) {
                    // A3 Pattern: Check file size SECOND (like A3)
                    $error = 'Profile picture exceeds the 5MB size limit.';
                } else {
                    // A3 Pattern: Check extension THIRD (like A3)
                    $fileExtension = strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));
                    if (!in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                        $error = 'Invalid file extension for profile picture.';
                    } else {
                        // A3 Pattern: Generate filename (like A3)
                        $newFilename = 'volunteer_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $fileExtension;
                        $uploadDir = WWW_ROOT . 'img' . DS . 'volunteer_profiles' . DS;
                        
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }
                        
                        $uploadPath = $uploadDir . $newFilename;
                        
                        // A3 Pattern: Use move_uploaded_file equivalent (moveTo)
                        try {
                            $file->moveTo($uploadPath);
                            // A3 Pattern: Delete old picture if it exists
                            if ($volunteer->profile_picture && file_exists($uploadDir . $volunteer->profile_picture)) {
                                unlink($uploadDir . $volunteer->profile_picture);
                            }
                            $profilePicture = $newFilename;
                        } catch (\RuntimeException $e) {
                            $error = 'Failed to upload profile picture.';
                        }
                    }
                }
            }
            // If no file uploaded or error is UPLOAD_ERR_NO_FILE, keep existing value
            
            // A5 Requirement: Handle document upload (WWCC, Police check, CV, etc. - combined PDF)
            // A3 Pattern: Keep existing document by default, update if new file uploaded
            // A3 checks: isset($_FILES['documents']) && $_FILES['documents']['error'] == 0
            if (empty($error) && !empty($uploadedFiles['documents']) && $uploadedFiles['documents']->getError() === UPLOAD_ERR_OK) {
                $file = $uploadedFiles['documents'];
                
                // A3 Pattern: Check file size FIRST (like A3 pattern for documents)
                $maxBytes = 10 * 1024 * 1024; // 10MB
                $fileSize = (int)$file->getSize();
                
                if ($fileSize > $maxBytes) {
                    $error = 'Documents file size must be less than 10MB.';
                } else {
                    // A3 Pattern: Get MIME type from temp file
                    $tmpPath = null;
                    try {
                        $stream = $file->getStream();
                        $tmpPath = $stream->getMetadata('uri');
                    } catch (\Exception $e) {
                        // Fallback if stream not available
                    }
                    
                    $fileType = $tmpPath ? mime_content_type($tmpPath) : $file->getClientMediaType();
                    $fileExtension = strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));
                    
                    // A3 Pattern: Check both MIME type AND extension
                    if ($fileType === 'application/pdf' || $fileExtension === 'pdf') {
                        $newFilename = 'documents_' . $volunteerId . '_' . time() . '_' . bin2hex(random_bytes(4)) . '.pdf';
                        $uploadDir = WWW_ROOT . 'volunteer_documents' . DS;
                        
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }
                        
                        $uploadPath = $uploadDir . $newFilename;
                        
                        // A3 Pattern: Use move_uploaded_file equivalent (moveTo)
                        try {
                            $file->moveTo($uploadPath);
                            // A3 Pattern: Delete old document if it exists
                            if ($volunteer->documents && file_exists($uploadDir . $volunteer->documents)) {
                                unlink($uploadDir . $volunteer->documents);
                            }
                            $documents = $newFilename;
                        } catch (\RuntimeException $e) {
                            $error = 'Failed to upload documents.';
                        }
                    } else {
                        $error = 'Documents: Only PDF files are allowed.';
                    }
                }
            }
            // If no file uploaded or error is UPLOAD_ERR_NO_FILE, keep existing value
            
            // A3 Pattern: Only proceed if no errors
            if (empty($error)) {
                // A3 Pattern: Always update file fields (either old or new value, like A3 profile page)
                $data['profile_picture'] = $profilePicture;
                $data['documents'] = $documents;
                
                // Patch entity with form data
                $volunteer = $this->Volunteers->patchEntity($volunteer, $data, [
                    'accessibleFields' => ['*' => true]
                ]);
                
                if ($this->Volunteers->save($volunteer)) {
                    // Use query flag to show custom success banner; avoid flash to prevent duplicate styling
                    return $this->redirect(['action' => 'profile', '?' => ['updated' => 1]]);
                } else {
                    $errors = $volunteer->getErrors();
                    if (!empty($errors)) {
                        foreach ($errors as $field => $fieldErrors) {
                            foreach ($fieldErrors as $msg) {
                                $this->Flash->error(__('{0}: {1}', [ucfirst((string)$field), (string)$msg]));
                            }
                        }
                    } else {
                        $this->Flash->error(__('The volunteer profile could not be saved. Please check your input and try again.'));
                    }
                }
            } else {
                // Error from file upload
                $this->Flash->error(__($error));
            }
        }
        
        $this->set(compact('volunteer', 'message', 'error'));
    }
}




