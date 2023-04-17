<?php

namespace PayTR\Enums;

enum Currency
{
    public const CURRENCIES = [
        self::TL,
        self::EUR,
        self::USD,
        self::GBP,
        self::RUB
    ];

    public const TL = 'TL';
    public const EUR = 'EUR';
    public const USD = 'USD';
    public const GBP = 'GBP';
    public const RUB = 'RUB';
}
