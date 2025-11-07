<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

class EventsController extends AppController
{
    /**
     * Index method
     */
    public function index()
    {
        $keyword = $this->request->getQuery('keyword');

        // Base query with Organisation join
        $query = $this->Events->find()
            ->contain(['Organisations'])
            ->order(['Events.event_date' => 'ASC']);

        // Optional search
        if (!empty($keyword)) {
            $query->where([
                'OR' => [
                    'Events.title LIKE' => "%$keyword%",
                    'Events.location LIKE' => "%$keyword%",
                    'Organisations.org_name LIKE' => "%$keyword%",
                ]
            ]);
        }

        // Paginate the results
        $events = $this->paginate($query);
        $this->set(compact('events', 'keyword'));
    }

    /**
     * View method
     */
    public function view($id = null)
    {
        if (!$id) {
            $this->Flash->error(__('Invalid event ID.'));
            return $this->redirect(['action' => 'index']);
        }

        $event = $this->Events->find()
            ->contain(['Organisations'])
            ->where(['Events.id' => $id])
            ->first();

        if (!$event) {
            $this->Flash->error(__('Event not found.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('event'));
    }

    /**
     * Add method
     */
    public function add()
{
    $event = $this->Events->newEmptyEntity();

    if ($this->request->is('post')) {
        $data = $this->request->getData();

        // LOG DỮ LIỆU NHẬN ĐƯỢC
        \Cake\Log\Log::debug('Event Add Data: ' . json_encode($data, JSON_PRETTY_PRINT));

        $event = $this->Events->patchEntity($event, $data, [
            'validate' => true
        ]);

        // LOG LỖI VALIDATION
        if ($event->getErrors()) {
            \Cake\Log\Log::error('Validation Errors: ' . json_encode($event->getErrors(), JSON_PRETTY_PRINT));
        }

        if ($this->Events->save($event)) {
            $this->Flash->success('The event has been saved.');
            return $this->redirect(['action' => 'index']);
        }

        $this->Flash->error('Unable to save the event. Please fix the errors below.');
    }

    $organisations = $this->Events->Organisations->find('list', [
        'keyField' => 'id',
        'valueField' => 'org_name'
    ])->toArray();

    $this->set(compact('event', 'organisations'));
}


    /**
     * Edit method
     */
    public function edit($id = null)
    {
        if (!$id) {
            $this->Flash->error(__('Invalid event ID.'));
            return $this->redirect(['action' => 'index']);
        }

        $event = $this->Events->findById($id)->first();
        if (!$event) {
            $this->Flash->error(__('Event not found.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());

            if ($this->Events->save($event)) {
                $this->Flash->success(__('✅ The event has been updated.'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('❌ The event could not be updated. Please try again.'));
        }

        $organisations = $this->Events->Organisations->find('list', [
            'keyField' => 'id',
            'valueField' => 'org_name',
            'limit' => 200,
        ])->toArray();

        $this->set(compact('event', 'organisations'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $event = $this->Events->findById($id)->first();
        if (!$event) {
            $this->Flash->error(__('Event not found.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Events->delete($event)) {
            $this->Flash->success(__('🗑 The event has been deleted.'));
        } else {
            $this->Flash->error(__('❌ The event could not be deleted.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
