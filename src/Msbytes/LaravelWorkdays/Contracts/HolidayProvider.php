<?php

namespace Msbytes\LaravelWorkdays\Contracts;

interface HolidayProvider
{
    public function getHolidays($year);
}