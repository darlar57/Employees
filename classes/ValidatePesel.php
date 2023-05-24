<?php

class ValidatePesel
{
    protected $pesel;
    protected $controlSum;
    
    public function __construct(string $pesel)
    {
        $this->pesel = $pesel;
    }

    function getLastDigit($number)
    {
        return $number % 10;
    }

    function validatePesel($pesel): bool
    {
        // Check if the PESEL number is 11 digits
        if (!preg_match('/^[0-9]{11}$/', $pesel)) {
            return false;
        }
    
        $digits = str_split($pesel);
    
        // OPTION 1 - Control based on the PESEL digits and control weights (substr)
        /* 
        $controlSum = $digits[0] * 1 + (($digits[1] * 3) > 9 ? substr(($digits[1] * 3), -1) : ($digits[1] * 3)) + (($digits[2] * 7) > 9 ? substr(($digits[2] * 7), -1) : ($digits[2] * 7)) + (($digits[3] * 9) > 9 ? substr(($digits[3] * 9), -1) : ($digits[3] * 9)) + ($digits[4] * 1) + (($digits[5] * 3) > 9 ? substr(($digits[5] * 3), -1) : ($digits[5] * 3)) + (($digits[6] * 7) > 9 ? substr(($digits[6] * 7), -1) : ($digits[6] * 7)) + (($digits[7] * 9) > 9 ? substr(($digits[7] * 9), -1) : ($digits[7] * 9)) +
        ($digits[8] * 1) + (($digits[9] * 3) > 9 ? substr(($digits[9] * 3), -1) : ($digits[9] * 3));
        */

        // OPTION 2 - Control based on the PESEL digits and control weights (%)
        $controlSum = $digits[0] * 1 + (($digits[1] * 3) > 9 ? $this->getLastDigit(($digits[1] * 3)) : ($digits[1] * 3)) + (($digits[2] * 7) > 9 ? $this->getLastDigit(($digits[2] * 7)) : ($digits[2] * 7)) + (($digits[3] * 9) > 9 ? $this->getLastDigit(($digits[3] * 9)) : ($digits[3] * 9)) + ($digits[4] * 1) + (($digits[5] * 3) > 9 ? $this->getLastDigit(($digits[5] * 3)) : ($digits[5] * 3)) + (($digits[6] * 7) > 9 ? $this->getLastDigit(($digits[6] * 7)) : ($digits[6] * 7)) + (($digits[7] * 9) > 9 ? $this->getLastDigit(($digits[7] * 9)) : ($digits[7] * 9)) +
        ($digits[8] * 1) + (($digits[9] * 3) > 9 ? $this->getLastDigit(($digits[9] * 3)) : ($digits[9] * 3));
        $controlSum = 10 - $this->getLastDigit($controlSum);

        return ($controlSum == $digits[10]);
    }
}