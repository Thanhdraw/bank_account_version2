<?php

namespace App\Traits;


trait HasEnumLabel
{
    public function getEnumLabel(string $enumclass, int|string $value)
    {
        return $enumclass::from($value)->label();
    }   
}