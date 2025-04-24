<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Client\Business;

use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Service\FileReader\Transaction\TransactionRowDto;
use CommissionFeeCalculator\Service\Transaction\Client\Client as AbstractClient;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;

class Client extends AbstractClient
{

    /**
     * @param TransactionRowDto $row
     * @param UserContextMap $context
     * @return void
     */
    public function withdraw(RowDto $row, UserContextMap $context): void
    {
        $commissionFee = $this->roundUp(
            $this->calculate($row->getAmount(), $context->getConfig()->getBusinessWithdrawFeeRate()),
            $context->getConfig()->getCurrencyDecimalPlaces(
                $row->getCurrency()
            )
        );

        echo $commissionFee . PHP_EOL;
    }
}
