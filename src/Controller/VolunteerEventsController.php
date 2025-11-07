<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;
use Cake\Utility\Text;
class VolunteerEventsController extends AppController
{
    

    public function index()
    {
        $query = $this->VolunteerEvents->find()
            ->contain(['Events', 'Volunteers'])
            ->order(['VolunteerEvents.created' => 'DESC']);

        $this->paginate = ['limit' => 15];
        $volunteerEvents = $this->paginate($query);

        // Tạo entity mới + UUID
        $volunteerEvent = $this->VolunteerEvents->newEmptyEntity();
        $volunteerEvent->id = Text::uuid(); // TỰ SINH UUID

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $id = $data['id'] ?? null;

            if ($id) {
                $volunteerEvent = $this->VolunteerEvents->get($id);
            } else {
                // Nếu là thêm mới → tạo entity mới + UUID
                $volunteerEvent = $this->VolunteerEvents->newEmptyEntity();
                $volunteerEvent->id = Text::uuid();
            }

            $volunteerEvent = $this->VolunteerEvents->patchEntity($volunteerEvent, $data, [
                'accessibleFields' => ['id' => true] // Cho phép patch id
            ]);

            if ($this->VolunteerEvents->save($volunteerEvent)) {
                $this->Flash->success('Assignment saved.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Please fix errors.');
        }

        $events = $this->VolunteerEvents->Events->find('list', [
            'keyField' => 'id',
            'valueField' => 'title'
        ])->toArray();

        $volunteers = $this->VolunteerEvents->Volunteers->find('list', [
            'keyField' => 'id',
            'valueField' => fn($v) => $v->first_name . ' ' . $v->last_name
        ])->toArray();

        $this->set(compact('volunteerEvents', 'volunteerEvent', 'events', 'volunteers'));
    }

    public function delete($id = null): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $ve = $this->VolunteerEvents->get($id);

        if ($this->VolunteerEvents->delete($ve)) {
            $this->Flash->success('Assignment deleted.');
        } else {
            $this->Flash->error('Cannot delete.');
        }

        return $this->redirect(['action' => 'index']);
    }
}