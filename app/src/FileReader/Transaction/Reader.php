<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\FileReader\Transaction;

use CommissionFeeCalculator\FileReader\Csv\Csv;
use CommissionFeeCalculator\FileReader\RowDto;
use Generator;

class Reader extends Csv
{
    function setRowDto(array $rowData): RowDto
    {
        return new TransactionRowDto($rowData);
    }

    public function display(Generator $rows): void
    {
        /**
         * @var TransactionRowDto $row
         */
        foreach ($rows as $row) {
            if (!$row instanceof TransactionRowDto) {
            }
        }
    }
}