<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Traits;

use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;
use CommissionFeeCalculator\Service\Transaction\Context\User;

trait UserContext
{
    protected function getUserContext(RowDto $row, UserContextMap $context): User
    {
        if (!$context->containsUser($row->getUserId())) {
            $userContext = new User();
            $userContext->setUserId($row->getUserId());
            $userContext->setUserType($row->getUserType());

            $context->set($row->getUserId(), $userContext);
        }

        return $context->get($row->getUserId());
    }
}
