<?php
declare(strict_types=1);
namespace CommissionFeeCalculator\FileReder;

class Example
{
    /**
     * Generator to read a CSV file row by row.
     *
     * @param string $filePath Path to the CSV file.
     * @return \Generator Yields each row as an array.
     * @throws RuntimeException If the file cannot be opened.
     */
    function readLargeCsv(string $filePath): \Generator
    {

        if (($handle = fopen($filePath, 'r')) === false) {
            throw new RuntimeException("Unable to open file '$filePath'.");
        }

        try {
            while (($row = fgetcsv($handle)) !== false) {
                yield $row;
            }
        } finally {
            fclose($handle);
        }
    }

    public function test()
    {

        // Example usage
        $csvFile = 'path/to/large_file.csv';

        try {
            foreach (readLargeCsv($csvFile) as $row) {
                // Process each row here
                // Example: Print the row or perform operations
                // print_r($row);

                // Add your processing logic here
            }
        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }
    }

}