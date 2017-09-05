<?php namespace Ccp\Repositories;

use Ccp\Interfaces\ContactUsInterface;
use Ccp\Models\ContactUs;

class ContactUsRepository extends Repository implements ContactUsInterface

{
    protected $model;

    public function __construct(ContactUs $model)
    {
        $this->model = $model;
    }


}
