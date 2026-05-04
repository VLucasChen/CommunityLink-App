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
        // Paginator is built into Controller in CakePHP 5, no need to load it
        $this->loadComponent('Authentication.Authentication', [
            'logoutRedirect' => '/users/login',
            // Don't require authentication for public actions
            'requireIdentity' => false, // Let individual actions control access
        ]);

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/5/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    /**
     * Check if user is logged in - A5 equivalent to A3 isLoggedIn()
     *
     * @return bool
     */
    protected function isLoggedIn(): bool
    {
        $result = $this->Authentication->getResult();

        return $result->isValid();
    }

    /**
     * Require login - A5 equivalent to A3 requireLogin()
     * Redirects to login if not logged in
     *
     * @return void
     */
    protected function requireLogin(): void
    {
        $result = $this->Authentication->getResult();
        if (!$result->isValid()) {
            // Check if we're already on login page to avoid redirect loops
            $currentUrl = $this->request->getUri()->getPath();
            if ($currentUrl !== '/users/login' && $currentUrl !== '/users/logout') {
                // Use redirect with proper URL encoding to avoid loops
                $redirectUrl = '/users/login';
                $currentPath = $this->request->getRequestTarget();
                if ($currentPath !== '/users/login' && $currentPath !== '/users/logout') {
                    $redirectUrl .= '?redirect=' . urlencode($currentPath);
                }
                $this->redirect($redirectUrl);
            }
        }
    }

    /**
     * Require admin access - A5 equivalent to A3 requireAdmin()
     * Only admins and assistants can access
     *
     * @return void
     */
    protected function requireAdmin(): void
    {
        $this->requireLogin();
        $user = $this->Authentication->getIdentity();
        $role = $user ? $user->get('role') : null;
        if (!$user || !in_array($role, ['admin', 'assistant'], true)) {
            $this->Flash->error(__('You do not have permission to access this page.'));
            $this->redirect(['controller' => 'Pages', 'action' => 'home']);
        }
    }

    /**
     * Check if current user is volunteer - A5 equivalent to A3 isVolunteer()
     *
     * @return bool
     */
    protected function isVolunteer(): bool
    {
        $user = $this->Authentication->getIdentity();

        return $user && ($user->get('role') === 'volunteer');
    }
}
