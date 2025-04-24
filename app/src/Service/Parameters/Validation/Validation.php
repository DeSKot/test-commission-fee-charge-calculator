<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Parameters\Validation;

use CommissionFeeCalculator\Service\Parameters\DTO\CliParameters as MainDTO;

interface Validation
{
    public function validate(MainDTO $mainDto): bool;
}
