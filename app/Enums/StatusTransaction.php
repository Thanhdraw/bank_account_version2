<?php

namespace App\Enums;

enum StatusTransaction: int
{
    case Success = 10;

    case Peding = 20;

    case Fail = 30;

    public function label()
    {
        return match ($this) {
            self::Success => 'Thành công',
            self::Peding => 'Đang chuyển',
            self::Fail => 'Thất bại'
        };
    }

    public static function asSelectArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => $case->label()])
            ->toArray();
    }
}