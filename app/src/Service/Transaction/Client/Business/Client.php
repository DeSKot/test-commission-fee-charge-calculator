<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Client\Business;

use CommissionFeeCalculator\Enum\Calculation;
use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Service\FileReader\Transaction\TransactionRowDto;
use CommissionFeeCalculator\Service\Transaction\Client\Client as AbstractClient;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;

class Client extends AbstractClient
{

    /**
     * @param TransactionRowDto $row
     * @return void
     */
    public function withdraw(RowDto $row, UserContextMap $context): void
    {
        $commissionFee = bcmul(
            $row->getAmount(),
            $context->getConfig()->getBusinessWithdrawFeeRate(),
            Calculation::DEFAULT_SCALE->value
        );

        $commissionFee = $this->roundUp(
            $commissionFee,
            $context->getConfig()->getCurrencyDecimalPlaces(
                $row->getCurrency()
            )
        );

        echo $commissionFee . PHP_EOL;
    }
}