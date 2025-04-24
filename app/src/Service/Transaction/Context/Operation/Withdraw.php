<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Context\Operation;

use CommissionFeeCalculator\Enum\Calculation;
use CommissionFeeCalculator\Traits\DefaultOperationSetterGetter;
use DateTime;

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
    private array $operationPerWeek = [];

    public function getPerWeekKey(DateTime $operationPerWeek): string
    {
        return $operationPerWeek->format('Y-W');
    }

    public function setGroupOperationPerWeek(DateTime $operationPerWeek): void
    {
        if (!key_exists(
            $this->getPerWeekKey($operationPerWeek),
            $this->operationPerWeek
        )) {
            $this->operationPerWeek[
                $this->getPerWeekKey($operationPerWeek)
            ] = new self();
        }
    }

    public function getGroupOperationPerWeek(DateTime $operationPerWeek): self|null
    {
        return $this->operationPerWeek[
            $this->getPerWeekKey($operationPerWeek)
        ];
    }

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

    public function setAmountPerWorkingDay(string $amountPerWorkingDay): void
    {
        $this->amountPerWorkingDay = $amountPerWorkingDay;
    }

    public function updateDateGroupAmount(DateTime $operationPerWeek, string $amountPerWorkingDay): void
    {
        $operation = $this->getGroupOperationPerWeek($operationPerWeek);
        $operation->updateCounter();
        $operation->updateAmountPerWorkingDay($amountPerWorkingDay);

        $this->operationPerWeek[
            $this->getPerWeekKey($operationPerWeek)
        ] = $operation;
    }
}
