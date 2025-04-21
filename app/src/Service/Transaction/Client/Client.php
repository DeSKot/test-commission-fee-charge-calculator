<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Client;

use CommissionFeeCalculator\Enum\Calculation;
use CommissionFeeCalculator\Service\FileReader\Transaction\TransactionRowDto;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;
use CommissionFeeCalculator\Service\Transaction\Operation\Contract;
use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Service\Transaction\Context\User as UserContext;

abstract class Client implements Contract
{

    /**
     *
     * @param TransactionRowDto $row
     * @param UserContextMap $context
     * @return void
     */
    public function deposit(RowDto $row, UserContextMap $context): void
    {
        $user = $this->getUserContext($row, $context);
        $user->getOperation()->getDeposit()->updateCounter();
        $user->getOperation()->getDeposit()->updateAmount($row->getAmount());

        $currency = $row->getCurrency();

        $commissionFee = bcmul(
            $row->getAmount(),
            $context->getConfig()->getDepositFeeRate(),
            Calculation::DEFAULT_SCALE->value
        );
        $commissionFee = $this->roundUp($commissionFee, $context->getConfig()->getCurrencyDecimalPlaces($currency));

        echo $commissionFee . PHP_EOL;
    }

    protected function getUserContext( RowDto $row, UserContextMap $context): UserContext
    {
        if (!$context->containsUser($row->getUserId())) {
            $userContext = new UserContext();
            $userContext->setUserId($row->getUserId());
            $userContext->setUserType($row->getUserType());

            $context->set($row->getUserId(),$userContext);
        }

        return $context->get($row->getUserId());
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