<?php

class Sex
{
    protected $pesel;
    protected $sex;
    
    public function __construct(string $pesel) {
        $this->pesel = $pesel;
    }

    function generateSex($pesel) {
             
        $peselArr = str_split($pesel);
        
        ($peselArr[9] % 2) == 0 ? $sex = "female" : $sex = "male";
    
        return $sex;
    }
}
