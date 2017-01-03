<?php

use Paupenin\DomainSites\Exceptions\DomainNotFoundException;

class DomainSitesTest extends DomainSitesTestCase
{
    /** @test */
    public function it_fails_if_domain_does_not_exists()
    {
        $this->get('/')
             ->assertResponseStatus(500);
    }

    /** @test */
    public function it_loads_current_domain_site()
    {
        $domain = $this->createCurrentDomain();

        $this->visit('/')
             ->assertResponseOk()
             ->see( $domain->site->name );
    }
}
