<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Traits;

use CommissionFeeCalculator\Enum\Calculation;

trait DefaultOperationSetterGetter
{
    public function getAmount(): string
    {
        return $this->amount;
    }

    public function updateAmount(string $amount): void
    {
        $this->amount = bcadd(
            $this->amount,
            $amount,
            Calculation::DEFAULT_SCALE->value
        );
    }

    public function getCounter(): int
    {
        return $this->counter;
    }

    public function updateCounter(int $up = 1): void
    {
        $this->counter += $up;
    }
}
