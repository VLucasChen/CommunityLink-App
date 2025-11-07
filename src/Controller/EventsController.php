<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;

class EventsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        // Paginator không cần loadComponent trong CakePHP 5
        $this->loadComponent('Flash');
    }

    /**
     * Index method — hiển thị danh sách sự kiện (có search & auto-archive)
     */
    public function index()
{
    $today = new \DateTime('today');
    $keyword = $this->request->getQuery('keyword');

    $query = $this->Events->find('all', [
        'contain' => ['Organisations'],
        'order' => ['event_date' => 'ASC']

    ]);

    if (!empty($keyword)) {
        $query->where([
            'OR' => [
                'Events.name LIKE' => "%$keyword%",
                'Organisations.name LIKE' => "%$keyword%"
            ]
        ]);
    }

    // ✅ Phân trang trước
    $events = $this->paginate($query);

    // ✅ Sau đó gắn trạng thái Archived/Active
    foreach ($events as $event) {
        $event->status = ($event->end_date < $today) ? 'Archived' : 'Active';
    }

    $this->set(compact('events', 'keyword'));
}



    /**
     * View method
     */
    public function view($id = null)
    {
        try {
            $event = $this->Events->get($id, [
                'contain' => ['Organisations', 'VolunteerEvents' => ['Volunteers']],
            ]);
        } catch (RecordNotFoundException $e) {
            $this->Flash->error(__('Event not found.'));
            return $this->redirect(['action' => 'index']);
        }

        $today = new \DateTime('today');
        $event->status = ($event->end_date < $today) ? 'Archived' : 'Active';

        $this->set(compact('event'));
    }

    /**
     * Add method
     */
    public function add()
    {
        $event = $this->Events->newEmptyEntity();
        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $organisations = $this->Events->Organisations->find('list')->all();
        $this->set(compact('event', 'organisations'));
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {
        try {
            $event = $this->Events->get($id);
        } catch (RecordNotFoundException $e) {
            $this->Flash->error(__('Event not found.'));
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update the event. Please, try again.'));
        }

        $organisations = $this->Events->Organisations->find('list')->all();
        $this->set(compact('event', 'organisations'));
    }

    /**
     * Delete method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        try {
            $event = $this->Events->get($id);
            if ($this->Events->delete($event)) {
                $this->Flash->success(__('The event has been deleted.'));
            } else {
                $this->Flash->error(__('The event could not be deleted. Please, try again.'));
            }
        } catch (RecordNotFoundException $e) {
            $this->Flash->error(__('Event not found.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
