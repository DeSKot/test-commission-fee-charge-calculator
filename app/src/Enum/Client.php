<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Enum;

enum Client: string
{
    case PRIVATE = 'private';
    case BUSINESS = 'business';
}