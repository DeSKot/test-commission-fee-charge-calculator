<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\FileReader\Csv;

use CommissionFeeCalculator\Exceptions\CsvFileReaderException;
use CommissionFeeCalculator\FileReader\Reader;
use Generator;

abstract class Csv extends Reader
{
    /**
     * Generator to read a CSV file row by row.
     * @throws CsvFileReaderException
     */
    public function read(string $filePath): Generator
    {
        if (($file = fopen($filePath, 'r')) === false) {
            throw new CsvFileReaderException("Unable to open file '$filePath'.");
        }

        try {
            while (!feof($file)) {
                $row = fgetcsv($file);
                if ($row === false) {
                    throw new CsvFileReaderException("Error reading file '$filePath'.");
                }
                yield $this->setRowDto($row);
            }
        } finally {
            fclose($file);
        }
    }
}