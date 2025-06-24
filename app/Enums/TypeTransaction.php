<?php

namespace App\Enums;

enum TypeTransaction: int
{
    case Deposit = 10;

    case Withdraw = 20;

    public function label(): string
    {
        return match ($this) {
            self::Deposit => 'Nạp tiền',
            self::Withdraw => 'Rút tiền',
        };
    }

    public static function asSelectArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => $case->label()])
            ->toArray();
    }


}