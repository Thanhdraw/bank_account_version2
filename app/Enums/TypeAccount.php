<?php

namespace App\Enums;

enum TypeAccount: int
{
    case Standard = 10;
    case Vip = 20;

    public function label(): string
    {
        return match ($this) {
            self::Standard => 'Basic',
            self::Vip => 'Vip',
        };
    }

    public static function asSelectArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => $case->label()])
            ->toArray();
    }

}