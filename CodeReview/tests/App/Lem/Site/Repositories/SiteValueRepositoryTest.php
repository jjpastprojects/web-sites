<?php

use Lem\Site\Repositories\SiteValueRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SiteValueRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    protected $siteValueRepo;

    public function setUp()
    {
        parent::setUp();
        $this->siteValueRepo = new SiteValueRepository();
    }


    /**
    * @test
    */
    public function it_check_if_site_has_value()
    {
        $variable = factory('Lem\Profile\Models\Variable')->create();
        $siteValue = factory('Lem\Site\Models\SiteValue')->create(['variable_id' => $variable->id]);
        $this->assertTrue($this->siteValueRepo->exists($siteValue['variable_id'], $siteValue['value']));
        $this->assertFalse($this->siteValueRepo->exists(1, 4, 'foo'));
    }

}
