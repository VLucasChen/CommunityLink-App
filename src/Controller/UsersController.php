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
        $this->loadComponent('Authentication.Authentication', [
            'logoutRedirect' => '/users/login'
        ]);
        
        // Allow login and logout actions without authentication
        $this->Authentication->allowUnauthenticated(['login', 'logout']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->requireLogin();
        $this->requireAdmin();
        
        // Disable layout for admin pages (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);
        
        $query = $this->Users->find()
            ->contain(['Volunteers']);

        // Filters: username and role
        $username = $this->request->getQuery('username');
        if ($username) {
            $query->where(['Users.username LIKE' => '%' . $username . '%']);
        }
        $role = $this->request->getQuery('role');
        if ($role && in_array($role, ['admin', 'assistant', 'volunteer'], true)) {
            $query->where(['Users.role' => $role]);
        }

        // A5 Requirement: Server-side pagination using QueryBuilder
        $users = $this->paginate($query->order(['Users.username' => 'ASC']), [
            'limit' => 10
        ]);

        $this->set(compact('users', 'username', 'role'));
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
        $this->requireLogin();
        $this->requireAdmin();
        $this->viewBuilder()->setLayout(null);
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
        $this->requireLogin();
        $this->requireAdmin();
        $this->viewBuilder()->setLayout(null);
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            // A3-like server-side checks
            if (!empty($data['role']) && $data['role'] === 'volunteer' && empty($data['volunteer_id'])) {
                $this->Flash->error(__('Please select a volunteer for volunteer role.'));
            } elseif (empty($data['password'])) {
                $this->Flash->error(__('Password is required for new users.'));
            } elseif (empty($data['confirm_password'])) {
                $this->Flash->error(__('Please confirm your password.'));
            } elseif ($data['password'] !== $data['confirm_password']) {
                $this->Flash->error(__('Passwords do not match.'));
            } else {
                $user = $this->Users->patchEntity($user, $data);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                // Display validation errors if save fails
                $errors = $user->getErrors();
                if (!empty($errors)) {
                    foreach ($errors as $field => $fieldErrors) {
                        foreach ($fieldErrors as $error) {
                            $this->Flash->error(__('{0}: {1}', [ucfirst($field), $error]));
                        }
                    }
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            }
        }
        $volunteers = $this->Users->Volunteers
            ->find('list', keyField: 'id', valueField: function ($row) {
                $first = (string)($row->first_name ?? '');
                $last = (string)($row->last_name ?? '');
                $full = trim($first . ' ' . $last);
                return $full !== '' ? $full : ($row->full_name ?? 'Volunteer');
            })
            ->order(['first_name' => 'ASC', 'last_name' => 'ASC'])
            ->all();
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
        $this->requireLogin();
        $this->requireAdmin();
        $this->viewBuilder()->setLayout(null);
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            // If password empty, do not change it
            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                // If password is provided, confirm_password is required and must match
                if (empty($data['confirm_password'])) {
                    $this->Flash->error(__('Please confirm your new password.'));
                    // A5 Requirement: Use virtual fields for unambiguous dropdowns
                    $volunteers = $this->Users->Volunteers->find('list', [
                        'keyField' => 'id',
                        'valueField' => function ($row) {
                            $first = (string)($row->first_name ?? '');
                            $last = (string)($row->last_name ?? '');
                            $full = trim($first . ' ' . $last);
                            return $full !== '' ? $full . ' (' . $row->email . ')' : ($row->full_name ?? 'Volunteer');
                        }
                    ])->order(['first_name' => 'ASC', 'last_name' => 'ASC'])->all();
                    $this->set(compact('user', 'volunteers'));
                    return;
                } elseif ($data['password'] !== $data['confirm_password']) {
                    $this->Flash->error(__('Passwords do not match.'));
                    // A5 Requirement: Use virtual fields for unambiguous dropdowns
                    $volunteers = $this->Users->Volunteers->find('list', [
                        'keyField' => 'id',
                        'valueField' => function ($row) {
                            $first = (string)($row->first_name ?? '');
                            $last = (string)($row->last_name ?? '');
                            $full = trim($first . ' ' . $last);
                            return $full !== '' ? $full . ' (' . $row->email . ')' : ($row->full_name ?? 'Volunteer');
                        }
                    ])->order(['first_name' => 'ASC', 'last_name' => 'ASC'])->all();
                    $this->set(compact('user', 'volunteers'));
                    return;
                }
            }
            if (!empty($data['role']) && $data['role'] === 'volunteer' && empty($data['volunteer_id'])) {
                $this->Flash->error(__('Please select a volunteer for volunteer role.'));
            }
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // Display validation errors if save fails
            $errors = $user->getErrors();
            if (!empty($errors)) {
                foreach ($errors as $field => $fieldErrors) {
                    foreach ($fieldErrors as $error) {
                        $this->Flash->error(__('{0}: {1}', [ucfirst($field), $error]));
                    }
                }
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $volunteers = $this->Users->Volunteers
            ->find('list', keyField: 'id', valueField: function ($row) {
                $first = (string)($row->first_name ?? '');
                $last = (string)($row->last_name ?? '');
                $full = trim($first . ' ' . $last);
                return $full !== '' ? $full : ($row->full_name ?? 'Volunteer');
            })
            ->order(['first_name' => 'ASC', 'last_name' => 'ASC'])
            ->all();
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
        $this->requireLogin();
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        
        // A5 Requirement: Assistant cannot delete Amy/admin users
        $currentUser = $this->Authentication->getIdentity();
        $currentRole = $currentUser ? ($currentUser->get('role') ?? '') : '';
        if (!in_array($currentRole, ['admin', 'assistant'], true)) {
            $this->Flash->error(__('You do not have permission to delete users.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($currentUser && (string)$currentUser->getIdentifier() === (string)$user->id) {
            $this->Flash->error(__('You cannot delete your own account.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($currentRole === 'assistant' && ($user->get('role') === 'admin' || $user->get('username') === 'AmyTan')) {
            $this->Flash->error(__('Assistants cannot delete administrator accounts.'));
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
     * Preserves A3 functionality: role-based redirect (admin→dashboard, volunteer→profile)
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        
        // Disable layout since login template has its own full HTML (A3 style)
        $this->viewBuilder()->setLayout(null);
        
        $result = $this->Authentication->getResult();
        
        // If user is logged in, redirect based on role (A3 behavior)
        if ($result->isValid()) {
            $user = $this->Authentication->getIdentity();
            $redirect = $this->request->getQuery('redirect');
            
            // If no redirect specified, use role-based redirect (A3 logic)
            if (!$redirect) {
                $role = $user->get('role');
                if ($role === 'admin' || $role === 'assistant') {
                    $redirect = ['controller' => 'Pages', 'action' => 'dashboard'];
                } else {
                    // Volunteer redirect to profile page (A3 behavior)
                    $redirect = ['controller' => 'Volunteers', 'action' => 'profile'];
                }
            }
            
            return $this->redirect($redirect);
        }
        
        // Display error if user submitted and authentication failed (A3 validation behavior)
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
