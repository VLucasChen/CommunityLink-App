<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * VolunteerEvents Controller
 *
 * @property \App\Model\Table\VolunteerEventsTable $VolunteerEvents
 */
class VolunteerEventsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->VolunteerEvents->find()
            ->contain(['Events', 'Volunteers']);
        $volunteerEvents = $this->paginate($query);

        $this->set(compact('volunteerEvents'));
    }

    /**
     * View method
     *
     * @param string|null $id Volunteer Event id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $volunteerEvent = $this->VolunteerEvents->get($id, contain: ['Events', 'Volunteers']);
        $this->set(compact('volunteerEvent'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $volunteerEvent = $this->VolunteerEvents->newEmptyEntity();
        if ($this->request->is('post')) {
            $volunteerEvent = $this->VolunteerEvents->patchEntity($volunteerEvent, $this->request->getData());
            if ($this->VolunteerEvents->save($volunteerEvent)) {
                $this->Flash->success(__('The volunteer event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The volunteer event could not be saved. Please, try again.'));
        }
        // A5 Requirement: Use virtual fields for unambiguous dropdowns
        $events = $this->VolunteerEvents->Events->find('list', [
            'keyField' => 'id',
            'valueField' => function ($event) {
                return $event->title . ' - ' . $event->location . ' (' . ($event->event_date ? $event->event_date->format('Y-m-d') : 'N/A') . ')';
            }
        ])->order(['event_date' => 'DESC'])->all();
        
        $volunteers = $this->VolunteerEvents->Volunteers->find('list', [
            'keyField' => 'id',
            'valueField' => function ($volunteer) {
                return $volunteer->first_name . ' ' . $volunteer->last_name . ' (' . $volunteer->email . ')';
            }
        ])->order(['first_name' => 'ASC', 'last_name' => 'ASC'])->all();
        $this->set(compact('volunteerEvent', 'events', 'volunteers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Volunteer Event id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $volunteerEvent = $this->VolunteerEvents->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $volunteerEvent = $this->VolunteerEvents->patchEntity($volunteerEvent, $this->request->getData());
            if ($this->VolunteerEvents->save($volunteerEvent)) {
                $this->Flash->success(__('The volunteer event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The volunteer event could not be saved. Please, try again.'));
        }
        // A5 Requirement: Use virtual fields for unambiguous dropdowns
        $events = $this->VolunteerEvents->Events->find('list', [
            'keyField' => 'id',
            'valueField' => function ($event) {
                return $event->title . ' - ' . $event->location . ' (' . ($event->event_date ? $event->event_date->format('Y-m-d') : 'N/A') . ')';
            }
        ])->order(['event_date' => 'DESC'])->all();
        
        $volunteers = $this->VolunteerEvents->Volunteers->find('list', [
            'keyField' => 'id',
            'valueField' => function ($volunteer) {
                return $volunteer->first_name . ' ' . $volunteer->last_name . ' (' . $volunteer->email . ')';
            }
        ])->order(['first_name' => 'ASC', 'last_name' => 'ASC'])->all();
        $this->set(compact('volunteerEvent', 'events', 'volunteers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Volunteer Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $volunteerEvent = $this->VolunteerEvents->get($id);
        if ($this->VolunteerEvents->delete($volunteerEvent)) {
            $this->Flash->success(__('The volunteer event has been deleted.'));
        } else {
            $this->Flash->error(__('The volunteer event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
