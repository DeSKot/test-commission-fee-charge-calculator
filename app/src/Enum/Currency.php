<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Enum;

enum Currency: string
{
    case EUR = 'EUR';
    case USD = 'USD';
    case GBP = 'GBP';
}