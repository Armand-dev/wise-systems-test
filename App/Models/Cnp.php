<?php

namespace App\Models;

class Cnp
{

    public string   $cnp;
    private int     $length = 13;
    private int     $maxMonths = 12;
    private int     $maxDaysInMonth = 31;
    private int     $maxCounty = 52;
    private array   $controlNumber = array(2,7,9,1,4,6,3,5,8,2,7,9);
    private int     $controlDivider = 11;

    /**
     * Create instance of CNP.
     *
     * @param string $cnp
     */
    public function __construct(string $cnp)
    {
        $this->cnp = $cnp;
    }

    /**
     * Check if CNP is valid.
     *
     * @return bool
     */
    public function validate()
    {
        // Guard cnp length
        if (! $this->checkLength()) return false;

        // Convert string to array, each array element has one character
        $cnp = str_split($this->cnp);

        /**
         * I will guard based on a simplification of the exercise documents,
         * as follows:
         *          Position              |              Rule
         *           0 - S                |        cant be 0
         */
        if (number_format($cnp[0]) == 0) return false;

        /*
         *
         *          Position              |              Rule
         *          1,2 - AA              |         can be any value
         */
        // no validations needed

        /*
         *
         *          Position              |              Rule
         *          3,4 - LL              |         3,4 cant form a number higher than 12
         */
        $monthDigits = number_format($cnp[3].$cnp[4]);
        if ( $monthDigits > $this->maxMonths ) return false; // number_format() will also remove a leading zero

        /*
         *
         *          Position              |              Rule
         *          5,6 - LL              |         5,6 cant form a number higher than 31
         */
        $daysDigits = number_format($cnp[5].$cnp[6]);
        if ( $daysDigits > $this->maxDaysInMonth ) return false; // number_format() will also remove a leading zero

        /*
         * Check if the days dont exceed the number of days in that month.
         */
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthDigits, date('Y'));
        if ($daysDigits > $daysInMonth) return false;

        /*
         *
         *          Position              |              Rule
         *          7,8 - JJ              |         7,8 cant form a number higher than 52
         */
        $countyDigits = number_format($cnp[7].$cnp[8]);
        if ( $countyDigits > $this->maxCounty ) return false; // number_format() will also remove a leading zero

        /*
         *
         *          Position              |              Rule
         *        9,10,11 - NNN           |         can be any value
         */
        // no validations needed

        /*
         *
         *          Position              |              Rule
         *           12 - C               |       as per formula in docs
         */
        $sum = 0;
        for ($i = 0; $i < count($this->controlNumber); $i++)
        {
            $sum += $cnp[$i] * $this->controlNumber[$i];
        }
        $controlDigit = ($sum % $this->controlDivider) == ($this->controlDivider - 1) ? 1 : $sum % $this->controlDivider;
        if ($controlDigit != $cnp[12]) return false;

        return true;
    }

    /**
     * Get number of digits in CNP.
     *
     * @return bool
     */
    public function checkLength(): bool
    {
        return (strlen($this->cnp) == $this->length);
    }

}