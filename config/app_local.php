<?php

use Cake\Database\Connection;
use Cake\Database\Driver\Mysql;
use function Cake\Core\env;

/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */
return [
    /*
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),

    /*
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        'salt' => env('SECURITY_SALT', '747624b22021f29f710d590be9c69c7e796966ec8d53bcc87685831b32168990'),
    ],

    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
    'Datasources' => [
        'default' => [
            'className' => Connection::class,
            'driver' => Mysql::class,
            // Use 127.0.0.1 instead of localhost on macOS to force TCP connection
            // If using MAMP, change to '127.0.0.1' and uncomment port => 8889
            'host' => '127.0.0.1',
            /*
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to change this
             * XAMPP/Homebrew uses default port 3306
             */
            //'port' => 8889,  // Uncomment this if using MAMP

            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),

            'database' => env('DB_DATABASE', 'A5'),
            
            /*
             * For macOS users experiencing socket issues, you can uncomment
             * and set the socket path. Common paths:
             * - MAMP: /Applications/MAMP/tmp/mysql/mysql.sock
             * - Homebrew: /tmp/mysql.sock or /var/mysql/mysql.sock
             * - XAMPP: /Applications/XAMPP/xamppfiles/var/mysql/mysql.sock
             */
            //'unix_socket' => env('DB_SOCKET', '/tmp/mysql.sock'),

            /*
             * You can use a DSN string to set the entire configuration
             */
            'url' => env('DATABASE_URL', null),
        ],

        /*
         * The test connection is used during the test suite.
         */
        'test' => [
            'className' => Connection::class,
            'driver' => Mysql::class,
            'host' => '127.0.0.1',
            //'port' => 8889,  // Uncomment this if using MAMP
            'username' => 'root',
            'password' => '',
            'database' => 'A5_test',
            //'schema' => 'myapp',
            'url' => env('DATABASE_TEST_URL', null),
        ],
    ],

    /*
     * Email configuration.
     *
     * Host and credential configuration in case you are using SmtpTransport
     *
     * See app.php for more configuration options.
     */
    'EmailTransport' => [
        'default' => [
            'host' => 'localhost',
            'port' => 25,
            'username' => null,
            'password' => null,
            'client' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],
];
