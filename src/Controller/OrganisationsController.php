<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

class OrganisationsController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'order' => ['Organisations.org_name' => 'ASC'],
            'limit' => 15
        ];
        $organisations = $this->paginate($this->Organisations);

        // Default: form Add
        $organisation = $this->Organisations->newEmptyEntity();

        // Xử lý form (Add/Edit)
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $id = $data['id'] ?? null;

            if ($id && $id !== '') {
                $organisation = $this->Organisations->get($id);
            }

            $organisation = $this->Organisations->patchEntity($organisation, $data);

            if ($this->Organisations->save($organisation)) {
                $this->Flash->success('Organisation saved successfully.');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Please fix the errors.');
        }

        $this->set(compact('organisations', 'organisation'));
    }

    public function delete($id = null): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $org = $this->Organisations->get($id);

        if ($this->Organisations->delete($org)) {
            $this->Flash->success('Deleted.');
        } else {
            $this->Flash->error('Cannot delete.');
        }

        return $this->redirect(['action' => 'index']);
    }
}