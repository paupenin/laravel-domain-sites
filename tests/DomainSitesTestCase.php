<?php

use Paupenin\DomainSites\Domain;
use Paupenin\DomainSites\Site;

class DomainSitesTestCase extends TestCase
{
    /**
     * Setup before each test.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        Route::get('/', function (Site $site) {
            return $site->name;
        });
    }

    /**
     * Creates Current Domain and sets URL for requests
     *
     * @param  Domain $domain
     * @return Domain $domain
     */
    protected function createCurrentDomain($domain = null){
        if(! $domain)
          $domain = factory(Domain::class)->create();

        $this->baseUrl = 'http://' . $domain->url;

        return $domain;
    }
}
