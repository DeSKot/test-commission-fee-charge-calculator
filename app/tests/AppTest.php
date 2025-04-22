<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Tests;

use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    const INPUT_FILE = __DIR__ . '/fixtures/input.csv';
    const EXPECTED_OUTPUT_FILE = __DIR__ . '/fixtures/output.csv';

    public function testCliOutputWithProvidedFiles(): void
    {
        // Define the command to execute the CLI application
        $command = sprintf('php %s %s', __DIR__ . '/../main.php', self::INPUT_FILE);

        // Execute the command and capture the output
        $output = [];
        exec($command, $output);

        // Read the expected output from the file
        $expectedOutput = file(self::EXPECTED_OUTPUT_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Assert that the CLI output matches the expected output
        $this->assertEquals($expectedOutput, $output);
    }
}