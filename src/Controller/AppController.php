<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Authentication\Controller\Component\AuthenticationComponent;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/5/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    /**
     * Check if current user has required role
     * 
     * @param string|array $roles Required role(s) - 'admin', 'assistant', or ['admin', 'assistant']
     * @return bool
     */
    protected function checkRole($roles): bool
    {
        $identity = $this->Authentication->getIdentity();
        if (!$identity) {
            return false;
        }

        $userRole = null;
        if (is_object($identity)) {
            $userRole = $identity->role ?? null;
            if (!$userRole && method_exists($identity, 'get')) {
                $userRole = $identity->get('role');
            }
        } elseif (is_array($identity)) {
            $userRole = $identity['role'] ?? $identity['data']['role'] ?? null;
        }

        if (!$userRole) {
            return false;
        }

        $roles = is_array($roles) ? $roles : [$roles];
        return in_array(strtolower($userRole), array_map('strtolower', $roles));
    }

    /**
     * Require role - redirect if user doesn't have required role
     * 
     * @param string|array $roles Required role(s)
     * @return void
     */
    protected function requireRole($roles): void
    {
        if (!$this->checkRole($roles)) {
            $this->Flash->error(__('You do not have permission to access this page.'));
            
            // Get current user to determine redirect
            $identity = $this->Authentication->getIdentity();
            $userRole = null;
            if (is_object($identity)) {
                $userRole = $identity->role ?? null;
            } elseif (is_array($identity)) {
                $userRole = $identity['role'] ?? $identity['data']['role'] ?? null;
            }
            
            // Redirect based on role
            if (strtolower($userRole) === 'volunteer') {
                // Volunteer can access their profile
                $userId = null;
                if (is_object($identity)) {
                    $userId = $identity->id ?? null;
                } elseif (is_array($identity)) {
                    $userId = $identity['id'] ?? $identity['data']['id'] ?? null;
                }
                if ($userId) {
                    $this->redirect(['controller' => 'Users', 'action' => 'profile', $userId]);
                } else {
                    $this->redirect(['controller' => 'Public', 'action' => 'home']);
                }
            } else {
                // Not logged in or other roles
                $this->redirect(['controller' => 'Public', 'action' => 'home']);
            }
        }
    }
}

