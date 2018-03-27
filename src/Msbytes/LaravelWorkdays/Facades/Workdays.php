<?php

namespace Msbytes\LaravelWorkdays\Facades;

use Illuminate\Support\Facades\Facade;

class Workdays extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'workdays';
    }
}
