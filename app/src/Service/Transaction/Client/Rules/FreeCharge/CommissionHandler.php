<?php

namespace CommissionFeeCalculator\Service\Transaction\Client\Rules\FreeCharge;

use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Service\Transaction\Client\Rules\FreeCharge\Chain\CountOfOperation;
use CommissionFeeCalculator\Service\Transaction\Client\Rules\FreeCharge\Chain\RangeDays;
use CommissionFeeCalculator\Service\Transaction\Client\Rules\FreeCharge\Chain\TotalAmountPerDays;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;
use CommissionFeeCalculator\Utils\CurrencyConvertor;

class CommissionHandler
{

    public function __construct(
        protected CurrencyConvertor $currencyConvertor,
    )
    {
    }

    public function handle(RowDto $row, UserContextMap $context): string
    {
        $chain = new RangeDays();

        $chain->setNext(new TotalAmountPerDays($this->currencyConvertor))
            ->setNext(new CountOfOperation());

        return $chain->handle($row, $context);
    }
}