<?php

namespace CommissionFeeCalculator\Service\Transaction\Context\Operation;

use CommissionFeeCalculator\Enum\Calculation;
use CommissionFeeCalculator\Traits\DefaultOperationSetterGetter;

class Withdraw
{
    use DefaultOperationSetterGetter;

    /**
     * Define how many times user use this operation per week
     */
    private int $counter = 0;
    private string $amount = "0.00";
    /**
     * Define how much user use this operation per week in EUR
     */
    private string $amountPerWorkingDay = "0.00";

    public function getAmountPerWorkingDay(): string
    {
        return $this->amountPerWorkingDay;
    }

    public function updateAmountPerWorkingDay(string $amountPerWorkingDay): void
    {
        $this->amountPerWorkingDay = bcadd(
            $this->amountPerWorkingDay,
            $amountPerWorkingDay,
            Calculation::DEFAULT_SCALE->value
        );
    }
}