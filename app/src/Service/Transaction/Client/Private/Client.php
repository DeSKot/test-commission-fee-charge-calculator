<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Client\Private;

use CommissionFeeCalculator\Enum\Calculation;
use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Service\FileReader\Transaction\TransactionRowDto;
use CommissionFeeCalculator\Service\Transaction\Client\Client as AbstractClient;
use CommissionFeeCalculator\Service\Transaction\Client\Rules\FreeCharge\CommissionHandler;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;
use CommissionFeeCalculator\Traits\UserContext;

class Client extends AbstractClient
{
    use UserContext;

    public function __construct(
        protected CommissionHandler $commissionHandler
    )
    {}

    /**
     * @param TransactionRowDto $row
     * @param UserContextMap $context
     * @return void
     */
    public function withdraw(RowDto $row, UserContextMap $context): void
    {
        $this->getUserContext($row, $context)
            ->getOperation()
            ->getWithdraw()
            ->setGroupOperationPerWeek($row->getDate());

        $commissionFee = $this->commissionHandler->handle($row, $context);

        $commissionFee = $this->roundUp(
            $commissionFee,
            $context->getConfig()->getCurrencyDecimalPlaces($row->getCurrency())
        );

        echo $commissionFee . PHP_EOL;
    }

}