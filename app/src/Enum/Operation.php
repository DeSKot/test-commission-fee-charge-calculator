<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Enum;

enum Operation: string
{
    case WITHDRAW = 'withdraw';
    case DEPOSIT = 'deposit';
}