<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class React extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'React';
    }
}
