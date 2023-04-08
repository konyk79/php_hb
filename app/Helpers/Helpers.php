<?php

namespace App;

use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Log;

class Helpers
{

    /**
     *  function cut float to $dignum - s decimals
     * @param $float
     * @param int $dignum     -  Specifies how many decimals .
     * @return float|int|string
     */
    public static function formatFloat($float, $dignum = 2) {
        //  $float=(float)(double)($float*100000000)/100000000;

        if ( fmod((float)$float, 1) ) {                         // if  we have decimals
            $y = explode('.', $float);

            if (array_key_exists ( 1, $y)){
                $length = strlen( (string)$y[1] );
            } else {
                $length = 0;
            }
            $numberDecimal = ($length < $dignum) ? $length : $dignum;                 // calculate number decimal after witch cut

            for($i=0, $coef = 1; $i < $numberDecimal; $i++) {
                $coef *= 10;                                                          // calculate  cutting coefficient
            }
            return (float)((int)($float * $coef) / $coef);                            //uncomment for cutting 1,567-> 1,56  1,542 -> 1,54
            //return number_format($float, ($length < $dignum) ? $length : $dignum, '.', '');   //(uncomment for round)   1,567-> 1,57  1,542 -> 1,54
        } else {
            return number_format($float, 0, '.', '');               // if no decimals
        }
    }

    /**
     *  generate string   'от $from  до $to(if 0 'without limit')'    exempel:  'от 5 до 10'   ' от 5 до без ограничений'
     * @param $from             --
     * @param
     * @param int $dignum
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public static function makeFromToFloatOutputString($from, $to, $dignum = 2) {
        if (($from > 0) && ($to > 0)) {
            if ($from > $to) {
                $to += $from;
                $from = $to - $from;
                $to = $to - $from;
            }
        }
        return trans('helpers.sumplaceholder', [
                'min' => Helpers::formatFloat($from, 1),
                'max' => ($to > 0) ? Helpers::formatFloat($to, 1) : trans('helpers.withoutlimit')
            ]);
    }



    /**
     * Formatting date and time using separator
     * @param DateTime $dateTime date and time object
     * @param String $separator separator we should use to format date and time
     * @return string formatted date time string
     */
    public static function getDateTimeFormattedWithSeparator($dateTime, String $separator) {
        if (!$dateTime ) return '';
        return Helpers::getDateFormatted($dateTime) . $separator . Helpers::getTimeFormatted($dateTime);
    }

    /**
     * Formatting date and time using space as separator
     * @param DateTime $dateTime date and time object
     * @return string formatted date time string
     */
    public static function getDateTimeFormatted($dateTime) {
        if (!$dateTime ) return '';
        return Helpers::getDateTimeFormattedWithSeparator($dateTime, " ");
    }

    /**
     * Formatting date
     * @param DateTime $dateTime date and time object
     * @return string formatted date string
     */
    public static function getDateFormatted($dateTime) {
        if (!$dateTime ) return '';
        return $dateTime->format('d.m.Y');
    }

    /**
     * Formatting time
     * @param DateTime $dateTime date and time object
     * @return string formatted time string
     */
    public static function getTimeFormatted($dateTime) {
        if (!$dateTime ) return '';
        return $dateTime->format('h:i');
    }

}