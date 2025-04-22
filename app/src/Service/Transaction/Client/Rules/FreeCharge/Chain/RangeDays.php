<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Client\Rules\FreeCharge\Chain;

use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;
class RangeDays extends Handler
{
    public function handle(RowDto $row, UserContextMap $context): string
    {
        $dayOfWeek = (int)$row->getDate()->format('N');

        if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
            return parent::handle($row, $context);
        }

        return $context->getConfig()->getPrivateWithdrawFeeRate();
    }
}