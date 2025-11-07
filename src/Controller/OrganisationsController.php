<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;

class OrganisationsController extends AppController
{
    public function index()
    {
        $this->paginate = [
            'contain' => [],
            'order' => ['Organisations.org_name' => 'ASC'],
            'limit' => 15
        ];
        $organisations = $this->paginate($this->Organisations);
        $this->set(compact('organisations'));
    }

    public function view($id = null)
    {
        $organisation = $this->Organisations->get($id, contain: ['Events']);
        $this->set(compact('organisation'));
    }

    public function add()
    {
        return $this->handleForm();
    }

    public function edit($id = null)
    {
        $organisation = $this->Organisations->get($id);
        return $this->handleForm($organisation);
    }

    public function delete($id = null): ?Response
    {
        $this->request->allowMethod(['post', 'delete']);
        $organisation = $this->Organisations->get($id);

        if ($this->Organisations->delete($organisation)) {
            $this->Flash->success('Organisation has been deleted.');
        } else {
            $this->Flash->error('Unable to delete organisation.');
        }

        return $this->redirect(['action' => 'index']);
    }

    // ========== MODAL CONTENT ==========
    public function modal(): ?Response
    {
        $this->viewBuilder()->setLayout('ajax');

        $mode = $this->request->getQuery('mode');
        $id = $this->request->getQuery('id');

        $organisation = match ($mode) {
            'add' => $this->Organisations->newEmptyEntity(),
            'edit', 'view' => $this->Organisations->get($id, contain: ['Events']),
            default => throw new \Cake\Http\Exception\NotFoundException()
        };

        $this->set(compact('organisation', 'mode'));
        return $this->render($mode === 'view' ? 'view_modal' : 'form_modal');
    }

    // ========== PRIVATE: HANDLE ADD & EDIT ==========
    private function handleForm($organisation = null): ?Response
    {
        if (!$organisation) {
            $organisation = $this->Organisations->newEmptyEntity();
        }

        if ($this->request->is(['post', 'put'])) {
            $organisation = $this->Organisations->patchEntity($organisation, $this->request->getData());

            if ($this->Organisations->save($organisation)) {
                if ($this->request->is('ajax')) {
                    return $this->response
                        ->withType('json')
                        ->withStringBody(json_encode(['success' => true]));
                }
                $this->Flash->success('Organisation has been saved.');
                return $this->redirect(['action' => 'index']);
            }

            if ($this->request->is('ajax')) {
                $this->set(compact('organisation'));
                $this->viewBuilder()->setTemplate('form_modal');
                $html = $this->render()->getBody()->__toString();
                return $this->response
                    ->withType('json')
                    ->withStringBody(json_encode([
                        'success' => false,
                        'html' => $html
                    ]));
            }

            $this->Flash->error('Please fix the errors below.');
        }

        $this->set(compact('organisation'));
        return null;
    }
}