<?php

namespace CommissionFeeCalculator\Service\Transaction\Client\Rules\FreeCharge\Chain;

use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Service\FileReader\Transaction\TransactionRowDto;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;
use CommissionFeeCalculator\Utils\CurrencyConvertor;

class TotalAmountPerDays extends Handler
{
    public function __construct(
        protected CurrencyConvertor $currencyConvertor
    )
    {
    }

    /**
     * @param TransactionRowDto $row
     * @param UserContextMap $context
     * @return string
     */
    public function handle(RowDto $row, UserContextMap $context): string
    {
        $userContext = $context->get($row->getUserId());
        $operationContext = $userContext->getOperation()->getWithdraw();

        $amountInEuro = $this->currencyConvertor->convertToEuro($row->getAmount(), $row->getCurrency());
        $operationContext->updateAmountPerWorkingDay($amountInEuro);

        if (bccomp($operationContext->getAmountPerWorkingDay(), $context->getConfig()->getFreeLimit()) <= -1) {
            return parent::handle($row, $context);
        }

        return $context->getConfig()->getPrivateWithdrawFeeRate();
    }
}