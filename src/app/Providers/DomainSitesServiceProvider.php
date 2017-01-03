<?php

namespace Paupenin\DomainSites\Providers;

use Paupenin\DomainSites\Domain;
use Paupenin\DomainSites\Site;

use Paupenin\DomainSites\Exceptions\DomainNotFoundException;
use Paupenin\DomainSites\Exceptions\SiteNotFoundException;

use Illuminate\Support\ServiceProvider;

class DomainSitesServiceProvider extends ServiceProvider
{
    /**
     * Register package resources.
     *
     * @return void
     */
    public function boot()
    {
        // Set migrations path
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->bindCurrentDomain();
        $this->bindCurrentSite();
    }

    /**
     * Binds the loading of Domain for the current Request
     *
     * @return void
     */
    private function bindCurrentDomain()
    {
        $this->app->singleton(Domain::class, function($app){
            $domain = Domain::where('url', request()->getHost())->first();

            if( ! $domain OR ! $domain->exists() ){
                throw new DomainNotFoundException;
            }

            return $domain;
        });
    }

    /**
     * Binds the loading of Site for the current Request
     *
     * @return void
     */
    private function bindCurrentSite()
    {
        $this->app->singleton(Site::class, function($app){
            $domain = $this->app->make(Domain::class);

            if( ! $domain->site OR ! $domain->site->exists() ){
                throw new SiteNotFoundException;
            }

            return $domain->site;
        });
    }
}
