<?php

namespace App\Enums;

enum TypeTransaction: int
{
    case Deposit = 10;

    case Withdraw = 20;

    case Transfer = 30;

    case Receivetransfer = 40;

    public function label(): string
    {
        return match ($this) {
            self::Deposit => 'Nạp tiền',
            self::Withdraw => 'Rút tiền',
            self::Transfer => 'Chuyển tiền',
            self::Receivetransfer => 'Nhận tiền'
        };
    }

    public static function asSelectArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => $case->label()])
            ->toArray();
    }


}