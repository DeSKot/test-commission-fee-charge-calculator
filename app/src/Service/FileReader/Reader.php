<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\FileReader;

abstract class Reader implements Contract
{
    abstract function setRowDto(array $rowData): RowDto;
}