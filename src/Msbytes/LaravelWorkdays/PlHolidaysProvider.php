<?php

namespace Msbytes\LaravelWorkdays;

use Carbon\Carbon;
use Msbytes\LaravelWorkdays\Contracts\HolidayProvider;

class PlHolidaysProvider implements HolidayProvider
{
    private $year;
    private $holidays;

    public function getHolidays($year)
    {
        if ($this->year != $year) {
            $this->year = $year;
            $this->setHolidays($year);
        }

        return $this->holidays;
    }

    protected function setHolidays($year)
    {
        $easter = $this->getEasterDate($year);
        $easterMonday = date('m-d', strtotime('+1 day', strtotime($year . '-' . $easter)));
        $corpusChristi = date('m-d', strtotime('+60 days', strtotime($year . '-' . $easter)));
        // Whit Sunday is always sunday so we don't need to include it in holidays array

        $holidays = array(
            '01-01', // New Year
            '01-06', // Epiphany
            '05-01', // Labour Day
            '05-03', // Constitution Day
            '08-15', // Assumption of the Blessed Virgin Mary
            '11-01', // All Saints' Day
            '11-11', // Independence Day
            '12-24', // Christmas Eve
            '12-25', // Christmas Day
            '12-26', // Second Day of Christmas
            '12-31'  // New Year's Eve
        );
        array_push($holidays, $easterMonday, $corpusChristi);

        $date = Carbon::createFromFormat('Y', $year);
        foreach ($holidays as $i => $holiday) {
            list($month, $day) = explode('-', $holiday);
            $date->month($month);
            $date->day($day);
            if ($date->isWeekend()) {
                unset($holidays[$i]);
            }
        }

        $this->holidays = $holidays;
    }

    private function getEasterDate($year)
    {
        $base = Carbon::createFromDate($year, 3, 21);
        $days = easter_days($year);

        return $base->addDays($days)->format('m-d');
    }
}
