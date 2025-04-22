<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Client\Rules\FreeCharge\Chain;

use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;
class CountOfOperation extends Handler
{
    public function handle(RowDto $row, UserContextMap $context): string
    {
        $userContext = $context->get($row->getUserId());
        $operationContext = $userContext->getOperation()->getWithdraw();

        if ($operationContext->getCounter() <= $context->getConfig()->getFreeOperationsLimit()) {
            return parent::handle($row, $context);
        }

        return $context->getConfig()->getPrivateWithdrawFeeRate();
    }

}