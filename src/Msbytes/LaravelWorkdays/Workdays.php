<?php

namespace Msbytes\LaravelWorkdays;

use Carbon\Carbon;
use Msbytes\LaravelWorkdays\Contracts\HolidayProvider;

class Workdays
{
    /** @var HolidayProvider */
    private $holidayProvider;

    /**
     * @param HolidayProvider $holidayProvider
     */
    public function setHolidayProvider(HolidayProvider $holidayProvider)
    {
        $this->holidayProvider = $holidayProvider;
    }

    public function isWorkingDay($date)
    {
        $date = Carbon::parse($date);

        return $date->isWeekday()
            && !in_array($date->format('m-d'), $this->holidayProvider->getHolidays($date->format('Y')));
    }

    public function addWorkingDays($date, $interval)
    {
        return $this->calculateDate($date, $interval);
    }

    public function substractWorkingDays($date, $interval)
    {
        return $this->calculateDate($date, -$interval);
    }

    protected function calculateDate($date, $interval)
    {
        $forward = $interval > 0;
        $interval = abs($interval);

        $i = 0;
        $date = Carbon::parse($date);
        while ($i < $interval) {
            $forward ? $date->addDay() : $date->subDay();
            if ($date->isWeekday() && !in_array($date->format('m-d'), $this->holidayProvider->getHolidays($date->format('Y')))) {
                $i++;
            }
        }

        return $date->format('Y-m-d');
    }
}
