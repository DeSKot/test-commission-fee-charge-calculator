<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Traits;

trait Calculation
{
    public function calculate(string $amount, string $feeRate): string
    {
        return bcmul(
            $amount,
            $feeRate,
            \CommissionFeeCalculator\Enum\Calculation::DEFAULT_SCALE->value
        );
    }
}
