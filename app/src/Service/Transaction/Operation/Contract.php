<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Operation;

use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;

interface Contract
{
    public function withdraw(RowDto $row, UserContextMap $context): void;
    public function deposit(RowDto $row, UserContextMap $context): void;
}
