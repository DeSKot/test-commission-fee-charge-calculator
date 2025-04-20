<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\FileReader;

use Generator;

interface Contract
{
    function read(string $filePath): Generator;
    public function display(Generator $rows): void;
}