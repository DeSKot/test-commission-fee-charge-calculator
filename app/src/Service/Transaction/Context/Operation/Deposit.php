<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Context\Operation;

use CommissionFeeCalculator\Traits\DefaultOperationSetterGetter;

class Deposit
{
    use DefaultOperationSetterGetter;

    /**
     * Define how many times user use this operation
     */
    private int $counter = 0;
    private string $amount = "0.0";
}
