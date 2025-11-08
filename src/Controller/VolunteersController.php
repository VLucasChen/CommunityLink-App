<?php
declare(strict_types=1);

namespace App\Controller;

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
        $query = $this->Volunteers->find();
        $volunteers = $this->paginate($query);

        $this->set(compact('volunteers'));
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
        if (!$id) {
            $this->Flash->error(__('Invalid volunteer ID.'));
            return $this->redirect(['action' => 'index']);
        }

        $volunteer = $this->Volunteers->find()
            ->where(['Volunteers.id' => $id])
            ->first();

        if (!$volunteer) {
            $this->Flash->error(__('Volunteer not found.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('volunteer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $volunteer = $this->Volunteers->newEmptyEntity();
        if ($this->request->is('post')) {
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
                    unset($data['documents']);
                }
            }

            $volunteer = $this->Volunteers->patchEntity($volunteer, $data);
            if ($this->Volunteers->save($volunteer)) {
                $this->Flash->success(__('The volunteer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The volunteer could not be saved. Please, try again.'));
        }
        $this->set(compact('volunteer'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Volunteer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if (!$id) {
            $this->Flash->error(__('Invalid volunteer ID.'));
            return $this->redirect(['action' => 'index']);
        }

        $volunteer = $this->Volunteers->find()
            ->where(['Volunteers.id' => $id])
            ->first();

        if (!$volunteer) {
            $this->Flash->error(__('Volunteer not found.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // Handle profile_picture upload
            if (isset($data['profile_picture']) && $data['profile_picture'] instanceof \Laminas\Diactoros\UploadedFile) {
                if (!empty($data['profile_picture']->getClientFilename()) && $data['profile_picture']->getError() === UPLOAD_ERR_OK) {
                    // New file uploaded, process it
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
                    // New file uploaded, process it
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

            $volunteer = $this->Volunteers->patchEntity($volunteer, $data);
            if ($this->Volunteers->save($volunteer)) {
                $this->Flash->success(__('The volunteer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The volunteer could not be saved. Please, try again.'));
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
        $this->request->allowMethod(['post', 'delete']);

        if (!$id) {
            $this->Flash->error(__('Invalid volunteer ID.'));
            return $this->redirect(['action' => 'index']);
        }

        $volunteer = $this->Volunteers->find()
            ->where(['Volunteers.id' => $id])
            ->first();

        if (!$volunteer) {
            $this->Flash->error(__('Volunteer not found.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Volunteers->delete($volunteer)) {
            $this->Flash->success(__('The volunteer has been deleted.'));
        } else {
            $this->Flash->error(__('The volunteer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
