<?php

namespace App\Enums;

enum GenderCustomer: int
{
    case Male = 10;

    case Female = 20;

    public function label()
    {
        return match ($this) {
            self::Male => 'Nam',
            self::Female => 'Nữ'
        };
    }
    public static function asSelectArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => $case->label()])
            ->toArray();
    }
}