<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Client\Rules\FreeCharge\Chain;

use CommissionFeeCalculator\Enum\Calculation;
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
        $operationContext->updateDateGroupAmount($row->getDate(), $amountInEuro);

        if (
            bccomp(
                $operationContext->getGroupOperationPerWeek($row->getDate())->getAmountPerWorkingDay(),
                $context->getConfig()->getFreeLimit()
            ) <= -1) {
            return parent::handle($row, $context);
        } else {
            $excessInEuro = bcsub(
                $operationContext->getGroupOperationPerWeek($row->getDate())->getAmountPerWorkingDay(),
                $context->getConfig()->getFreeLimit(), Calculation::DEFAULT_SCALE->value
            );
            $feeInEuro = $this->calculate($excessInEuro, $context->getConfig()->getPrivateWithdrawFeeRate());
            $fee = $this->currencyConvertor->convertFromEuro($feeInEuro, $row->getCurrency());

            $operationContext
                ->getGroupOperationPerWeek($row->getDate())
                ->setAmountPerWorkingDay(
                    $context->getConfig()->getFreeLimit()
                );
            return $fee;
        }
    }
}