<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\NotFoundException;

class EventsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
      
        $this->loadComponent('Flash');
        
    }

    /**
     * Index
     */
    public function index()
    {
        $keyword = $this->request->getQuery('keyword');

        $query = $this->Events->find('all', [
            'contain' => ['Organisations'],
            'order' => ['event_date' => 'ASC']
        ]);

        if (!empty($keyword)) {
            $query->where([
                'OR' => [
                    'Events.title LIKE' => "%$keyword%",
                    'Events.location LIKE' => "%$keyword%",
                    'Organisations.org_name LIKE' => "%$keyword%"
                ]
            ]);
        }

        $events = $this->paginate($query, [
        'limit' => 10
    ]);

        $this->set(compact('events', 'keyword'));
    }

    /**
     * View 
     */
    public function view($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Organisations', 'VolunteerEvents' => ['Volunteers']]
        ]);

        $this->set(compact('event'));
    }

    /**
     * Add 
     */
    public function add()
    {
        $event = $this->Events->newEmptyEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been created successfully.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to save the event. Please try again.'));
        }

        $organisations = $this->Events->Organisations->find('list', [
            'keyField' => 'id',
            'valueField' => 'org_name',
            'limit' => 200
        ])->all();

        $this->set(compact('event', 'organisations'));
    }

    /**
     * Edit 
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been updated successfully.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update the event. Please try again.'));
        }

        $organisations = $this->Events->Organisations->find('list', [
            'keyField' => 'id',
            'valueField' => 'org_name',
            'limit' => 200
        ])->all();

        $this->set(compact('event', 'organisations'));
    }

    /**
     * Delete 
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
