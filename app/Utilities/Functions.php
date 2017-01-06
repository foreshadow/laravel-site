<?php

namespace App\Utilities;

class Functions
{
    static function datetime($expression)
    {
        return date('y/n/j G:i', strtotime((string)$expression));
    }
}
