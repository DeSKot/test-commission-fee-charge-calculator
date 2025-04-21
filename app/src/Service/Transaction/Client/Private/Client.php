<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Client\Private;

use CommissionFeeCalculator\Enum\Calculation;
use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Service\Transaction\Client\Client as AbstractClient;
use CommissionFeeCalculator\Service\Transaction\Client\Rules\FreeCharge\CommissionHandler;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;

class Client extends AbstractClient
{

    public function __construct(
        protected CommissionHandler $commissionHandler
    )
    {}

    public function withdraw(RowDto $row, UserContextMap $context): void
    {
        $userContext = $this->getUserContext($row, $context);
        $userContext->getOperation()->getWithdraw()->updateCounter();
        $userContext->getOperation()->getWithdraw()->updateAmount($row->getAmount());

        $commissionFee = bcmul(
            $row->getAmount(),
            $this->commissionHandler->handle($row, $context),
            Calculation::DEFAULT_SCALE->value
        );

        $commissionFee = $this->roundUp(
            $commissionFee,
            $context->getConfig()->getCurrencyDecimalPlaces($row->getCurrency())
        );

        echo $commissionFee . PHP_EOL;
    }

}