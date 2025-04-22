<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Client;

use CommissionFeeCalculator\Enum\Calculation;
use CommissionFeeCalculator\Service\FileReader\Transaction\TransactionRowDto;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;
use CommissionFeeCalculator\Service\Transaction\Operation\Contract;
use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Traits\Calculation as CalculationTrait;

abstract class Client implements Contract
{

    use CalculationTrait;
    /**
     *
     * @param TransactionRowDto $row
     * @param UserContextMap $context
     * @return void
     */
    public function deposit(RowDto $row, UserContextMap $context): void
    {
        $commissionFee = $this->roundUp(
            $this->calculate($row->getAmount(), $context->getConfig()->getDepositFeeRate()),
            $context->getConfig()->getCurrencyDecimalPlaces($row->getCurrency())
        );

        echo $commissionFee . PHP_EOL;
    }

    protected function roundUp(string $amount ,int $decimalPlaces): string
    {
        $factor = bcpow('10', (string) $decimalPlaces, 0);
        return bcdiv(
            (string) ceil(
                (float) bcmul($amount, $factor, 0)
            ),
            $factor,
            $decimalPlaces
        );
    }
}