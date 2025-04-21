<?php

namespace CommissionFeeCalculator\Enum;

enum Operation: string
{
    case WITHDRAW = 'withdraw';
    case DEPOSIT = 'deposit';
}