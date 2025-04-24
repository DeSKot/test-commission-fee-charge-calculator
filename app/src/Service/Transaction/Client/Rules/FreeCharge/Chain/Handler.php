<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Client\Rules\FreeCharge\Chain;

use CommissionFeeCalculator\Enum\Calculation;
use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;
use CommissionFeeCalculator\Traits\Calculation as CalculationTrait;

abstract class Handler
{
    use CalculationTrait;

    protected ?Handler $nextHandler = null;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(RowDto $row, UserContextMap $context): string
    {
        return $this->nextHandler?->handle($row, $context) ?? $this->getNoCharge();
    }

    public function getNoCharge(): string
    {
        return "0.000";
    }
}
