<?php
declare(strict_types=1);

namespace App\Controller;

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
        $search = $this->request->getQuery('search');
        $statusFilter = $this->request->getQuery('status');
        $dateFrom = $this->request->getQuery('date_from');
        $dateTo = $this->request->getQuery('date_to');
        
        $query = $this->VolunteerSignups->find();
        
        // Search filter
        if ($search) {
            $query->where([
                'OR' => [
                    'first_name LIKE' => '%' . $search . '%',
                    'last_name LIKE' => '%' . $search . '%',
                    'email LIKE' => '%' . $search . '%',
                    'phone LIKE' => '%' . $search . '%',
                    'status LIKE' => '%' . $search . '%',
                ]
            ]);
        }
        
        // Status filter
        if ($statusFilter && $statusFilter !== 'all') {
            $query->where(['status' => $statusFilter]);
        }
        
        // Date range filter
        if ($dateFrom && $dateTo) {
            $startDate = $dateFrom . ' 00:00:00';
            $endDate = $dateTo . ' 23:59:59';
            $query->where(function ($exp) use ($startDate, $endDate) {
                return $exp->between('created', $startDate, $endDate);
            });
        } elseif ($dateFrom) {
            $startDate = $dateFrom . ' 00:00:00';
            $query->where(['created >=' => $startDate]);
        } elseif ($dateTo) {
            $endDate = $dateTo . ' 23:59:59';
            $query->where(['created <=' => $endDate]);
        }
        
        $volunteerSignups = $this->paginate($query);

        $this->set(compact('volunteerSignups', 'search', 'statusFilter', 'dateFrom', 'dateTo'));
    }

    /**
     * View method
     *
     * @param string|null $id Volunteer Signup id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
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
            $data = $this->request->getData();

            // Handle profile_picture upload
            if (isset($data['profile_picture']) && $data['profile_picture'] instanceof \Laminas\Diactoros\UploadedFile) {
                if (!empty($data['profile_picture']->getClientFilename()) && $data['profile_picture']->getError() === UPLOAD_ERR_OK) {
                    $file = time() . '_' . $data['profile_picture']->getClientFilename();
                    $uploadDir = WWW_ROOT . 'uploads' . DS . 'profiles' . DS;
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $data['profile_picture']->moveTo($uploadDir . $file);
                    $data['profile_picture'] = 'uploads/profiles/' . $file;
                } else {
                    unset($data['profile_picture']);
                }
            }

            // Handle documents upload
            if (isset($data['documents']) && $data['documents'] instanceof \Laminas\Diactoros\UploadedFile) {
                if (!empty($data['documents']->getClientFilename()) && $data['documents']->getError() === UPLOAD_ERR_OK) {
                    $file = time() . '_' . $data['documents']->getClientFilename();
                    $uploadDir = WWW_ROOT . 'uploads' . DS . 'documents' . DS;
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $data['documents']->moveTo($uploadDir . $file);
                    $data['documents'] = 'uploads/documents/' . $file;
                } else {
                    unset($data['documents']);
                }
            }

            $volunteerSignup = $this->VolunteerSignups->patchEntity($volunteerSignup, $data);
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
    public function edit($id = null)
    {
        $volunteerSignup = $this->VolunteerSignups->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // Handle profile_picture upload
            if (isset($data['profile_picture']) && $data['profile_picture'] instanceof \Laminas\Diactoros\UploadedFile) {
                if (!empty($data['profile_picture']->getClientFilename()) && $data['profile_picture']->getError() === UPLOAD_ERR_OK) {
                    // New file uploaded, process it
                    $file = time() . '_' . $data['profile_picture']->getClientFilename();
                    $uploadDir = WWW_ROOT . 'uploads' . DS . 'profiles' . DS;
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $data['profile_picture']->moveTo($uploadDir . $file);
                    $data['profile_picture'] = 'uploads/profiles/' . $file;
                } else {
                    // No file uploaded, remove from data to keep existing value
                    unset($data['profile_picture']);
                }
            }

            // Handle documents upload
            if (isset($data['documents']) && $data['documents'] instanceof \Laminas\Diactoros\UploadedFile) {
                if (!empty($data['documents']->getClientFilename()) && $data['documents']->getError() === UPLOAD_ERR_OK) {
                    // New file uploaded, process it
                    $file = time() . '_' . $data['documents']->getClientFilename();
                    $uploadDir = WWW_ROOT . 'uploads' . DS . 'documents' . DS;
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $data['documents']->moveTo($uploadDir . $file);
                    $data['documents'] = 'uploads/documents/' . $file;
                } else {
                    // No file uploaded, remove from data to keep existing value
                    unset($data['documents']);
                }
            }

            $volunteerSignup = $this->VolunteerSignups->patchEntity($volunteerSignup, $data);
            if ($this->VolunteerSignups->save($volunteerSignup)) {
                $this->Flash->success(__('The volunteer signup has been saved.'));
                // Reload the entity to get updated data
                $volunteerSignup = $this->VolunteerSignups->get($id, contain: []);
            } else {
                $this->Flash->error(__('The volunteer signup could not be saved. Please, try again.'));
            }
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
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $volunteerSignup = $this->VolunteerSignups->get($id);
        if ($this->VolunteerSignups->delete($volunteerSignup)) {
            $this->Flash->success(__('The volunteer signup has been deleted.'));
        } else {
            $this->Flash->error(__('The volunteer signup could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
