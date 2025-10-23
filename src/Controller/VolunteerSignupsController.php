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
        $query = $this->VolunteerSignups->find();
        $volunteerSignups = $this->paginate($query);

        $this->set(compact('volunteerSignups'));
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
    public function edit($id = null)
    {
        $volunteerSignup = $this->VolunteerSignups->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
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
