<?php

namespace Gruppe\Petlocator;

class phoneChecker
{
    public static function checkNumber(string $num) : bool{
        return preg_match("/\+([0-9]){6,16}/", $num);
    }
}