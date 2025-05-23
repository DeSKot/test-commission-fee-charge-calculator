<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\FileReader;

abstract class RowDto
{
    public function __construct(
        protected array $rowData
    ) {
        $this->setRowData();
    }

    abstract protected function setRowData(): void;
}
