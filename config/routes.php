<?php
/**
 * Routes configuration for CommunityLink (Assessment 5)
 *
 * Customised to match FIT2104 requirements:
 * - Public homepage replaces CakePHP default page
 * - Clean URLs for volunteer/org registration and contact forms
 * - Dashboard remains under /dashboard for internal users
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {
    // Default route style: dashed-case (e.g., /volunteer-signups)
    $routes->setRouteClass(DashedRoute::class);

    /*
     * Main application routes
     * ------------------------------------------------------------
     */
    $routes->scope('/', function (RouteBuilder $builder): void {

        /**
         * ✅ PUBLIC ROUTES
         * These pages are accessible without login.
         * All handled by PublicController.
         */
        $builder->connect('/', ['controller' => 'Public', 'action' => 'home']);

        // Volunteer registration form
        $builder->connect('/volunteer/register', [
            'controller' => 'Public',
            'action' => 'volunteerRegister'
        ]);

        // Partner organisation registration form
        $builder->connect('/organisation/register', [
            'controller' => 'Public',
            'action' => 'organisationRegister'
        ]);

        // Contact Us page
        $builder->connect('/contact', [
            'controller' => 'Public',
            'action' => 'contact'
        ]);

        // Public event listing
        $builder->connect('/events/public', [
            'controller' => 'Public',
            'action' => 'publicEvents'
        ]);

        // User profile page
        $builder->connect('/profile/users/{id}', [
            'controller' => 'Users',
            'action' => 'profile'
        ], [
            'id' => '[a-f0-9\-]{36}',
            'pass' => ['id']
        ]);

        /**
         * ✅ DASHBOARD ROUTE (for Amy & assistants)
         * This can later be protected by Authentication plugin.
         */
        $builder->connect('/dashboard', [
            'controller' => 'Pages',
            'action' => 'dashboard'
        ]);

        /**
         * ✅ FILES ROUTE
         * Serve uploaded files (profile pictures, documents, etc.)
         * Format: /files/{category}/{type}/{filename}
         */
        $builder->connect('/files/{category}/{type}/{filename}', [
            'controller' => 'Files',
            'action' => 'serve'
        ], [
            'pass' => ['category', 'type', 'filename']
        ]);

        /**
         * ✅ FALLBACK ROUTES
         * Enable standard CRUD access for all baked controllers.
         * Example: /volunteers, /events/edit/1
         */
        $builder->fallbacks(DashedRoute::class);
    });

    /*
     * Optional scope for APIs (future use)
     *
     * $routes->scope('/api', function (RouteBuilder $builder): void {
     *     $builder->setExtensions(['json', 'xml']);
     *     // Define API routes here if needed
     * });
     */
};
