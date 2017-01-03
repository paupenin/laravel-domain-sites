<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\ClassFinder;

use Illuminate\Database\Eloquent\Factory;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * List of providers files to load for the test case.
     *
     * @var array
     */
    protected $providers = [
        'Paupenin\DomainSites\Providers\DomainSitesServiceProvider'
    ];


    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';

        $this->registerProviders( $app );

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        $this->registerFactories( $app );

        return $app;
    }

    /**
     * Setup a fresh memory DB before each test.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->app['config']->set('database.default','sqlite');
        $this->app['config']->set('database.connections.sqlite.database', ':memory:');

        $this->registerMigrations();

        // Prevent Notifications like Mail for faster testing
        $this->withoutNotifications();
    }

    /**
     * Register package providers
     *
     * @return void
     */
    public function registerProviders($app)
    {
       foreach( $this->providers as $provider ){
         $app->register($provider);
       }
    }

    /**
     * Load package model factories
     *
     * @return void
     */
    public function registerFactories($app)
    {
       $app->make(Factory::class)->load(__DIR__.'/../src/database/factories');
    }

    /**
     * Run package database migrations
     *
     * @return void
     */
    public function registerMigrations()
    {
       $fileSystem = new Filesystem;
       $classFinder = new ClassFinder;

       foreach($fileSystem->files(__DIR__ . '/../src/database/migrations') as $file)
       {
           $fileSystem->requireOnce($file);
           $migrationClass = $classFinder->findClass($file);

           (new $migrationClass)->up();
       }
    }
}
