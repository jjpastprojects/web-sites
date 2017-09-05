<?php

namespace Lembarek\Api\Controllers;

use Lembarek\Core\Controllers\Controller as MainController;
use Lembarek\Api\Traits\Apiable;

abstract class Controller extends MainController
{
    use Apiable;
}
