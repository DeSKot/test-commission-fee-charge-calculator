<?php
declare(strict_types=1);
namespace CommissionFeeCalculator\Parameters\Validation;

use CommissionFeeCalculator\Parameters\DTO\CliParameters as MainDTO;

interface Validation
{
    public function validate(MainDTO $mainDto): bool;
}