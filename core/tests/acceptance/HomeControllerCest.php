<?php


class HomeControllerCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function it_visit_home_page(AcceptanceTester $I)
    {
        $I->amOnPage('/');
    }

}
