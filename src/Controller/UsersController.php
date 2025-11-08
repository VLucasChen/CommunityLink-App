<?php
declare(strict_types=1);

namespace App\Controller;

use Authentication\Controller\Component\AuthenticationComponent;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
        $this->Authentication->allowUnauthenticated(['login', 'logout']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Only admin and assistant can access
        $this->requireRole(['admin', 'assistant']);

        $query = $this->Users->find()
            ->contain(['Volunteers']);
        $users = $this->paginate($query);

        // Get current user role for UI restrictions
        $identity = $this->Authentication->getIdentity();
        $currentUserRole = null;
        if (is_object($identity)) {
            $currentUserRole = $identity->role ?? null;
        } elseif (is_array($identity)) {
            $currentUserRole = $identity['role'] ?? $identity['data']['role'] ?? null;
        }

        $this->set(compact('users', 'currentUserRole'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // Only admin and assistant can access
        $this->requireRole(['admin', 'assistant']);

        $user = $this->Users->get($id, contain: ['Volunteers']);
        
        // Get current user role for UI restrictions
        $identity = $this->Authentication->getIdentity();
        $currentUserRole = null;
        if (is_object($identity)) {
            $currentUserRole = $identity->role ?? null;
        } elseif (is_array($identity)) {
            $currentUserRole = $identity['role'] ?? $identity['data']['role'] ?? null;
        }

        $this->set(compact('user', 'currentUserRole'));
    }

    /**
     * Profile method - Public profile page
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function profile($id = null)
    {
        // Only admin and assistant can access
        $this->requireRole(['admin', 'assistant']);
        
        $user = $this->Users->get($id, contain: ['Volunteers']);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        // Only admin and assistant can access
        $this->requireRole(['admin', 'assistant']);

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Password is required when adding a new user
            if (empty($data['password'])) {
                $this->Flash->error(__('Password is required when creating a new user.'));
                $volunteers = $this->Users->Volunteers->find('list', limit: 200)->all();
                $this->set(compact('user', 'volunteers'));
                return;
            }
            
            // If role is admin or assistant, remove volunteer_id
            if (isset($data['role']) && in_array($data['role'], ['admin', 'assistant'])) {
                $data['volunteer_id'] = null;
            }
            
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                // Reload the entity to get saved data
                $user = $this->Users->get($user->id, contain: []);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $volunteers = $this->Users->Volunteers->find('list', limit: 200)->all();
        $this->set(compact('user', 'volunteers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // Only admin and assistant can access
        $this->requireRole(['admin', 'assistant']);

        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            // If password is empty, remove it from data to keep current password
            if (empty($data['password'])) {
                unset($data['password']);
            }
            
            // If role is admin or assistant, remove volunteer_id
            if (isset($data['role']) && in_array($data['role'], ['admin', 'assistant'])) {
                $data['volunteer_id'] = null;
            }
            
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                // Reload the entity to get updated data
                $user = $this->Users->get($id, contain: []);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $volunteers = $this->Users->Volunteers->find('list', limit: 200)->all();
        $this->set(compact('user', 'volunteers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // Only admin and assistant can access
        $this->requireRole(['admin', 'assistant']);

        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        
        // Check if current user is assistant trying to delete an admin
        $identity = $this->Authentication->getIdentity();
        $currentUserRole = null;
        if (is_object($identity)) {
            $currentUserRole = $identity->role ?? null;
        } elseif (is_array($identity)) {
            $currentUserRole = $identity['role'] ?? $identity['data']['role'] ?? null;
        }
        
        // Assistant cannot delete admin users
        if (strtolower($currentUserRole) === 'assistant' && strtolower($user->role) === 'admin') {
            $this->Flash->error(__('You do not have permission to delete admin users.'));
            return $this->redirect(['action' => 'index']);
        }
        
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Login method - A5 Authentication equivalent to A3 login
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        
        if ($result->isValid()) {
            // Get user identity to determine redirect based on role
            $identity = $this->Authentication->getIdentity();
            $userRole = null;
            $userId = null;
            
            if (is_object($identity)) {
                $userRole = $identity->role ?? null;
                $userId = $identity->id ?? null;
            } elseif (is_array($identity)) {
                $userRole = $identity['role'] ?? $identity['data']['role'] ?? null;
                $userId = $identity['id'] ?? $identity['data']['id'] ?? null;
            }
            
            // Redirect based on role
            if (strtolower($userRole) === 'volunteer') {
                // Volunteer redirects to public home
                return $this->redirect(['controller' => 'Public', 'action' => 'home']);
            } elseif (in_array(strtolower($userRole), ['admin', 'assistant'])) {
                // Admin and assistant redirect to dashboard
                $target = $this->Authentication->getLoginRedirect() ?? ['controller' => 'Pages', 'action' => 'dashboard'];
                return $this->redirect($target);
            } else {
                // Default fallback
                return $this->redirect(['controller' => 'Public', 'action' => 'home']);
            }
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }


    /**
     * Logout method - A5 Authentication equivalent to A3 logout
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function logout()
    {
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Authentication->logout();
            $this->Flash->success(__('You have been logged out.'));
        }
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
}
