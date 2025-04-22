<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Parameters\Validation\Main;

use CommissionFeeCalculator\Exceptions\Parameters\InvalidArgumentException;
use CommissionFeeCalculator\Service\Parameters\DTO\CliParameters as MainDTO;
use CommissionFeeCalculator\Service\Parameters\Validation\Validation;
use RuntimeException;

class Handler implements Validation
{

    /**
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function validate(MainDTO $mainDto): bool
    {
        $filePath = $mainDto->getFilePath();

        return match (true) {
            $mainDto->getArgc() < 2 => throw new InvalidArgumentException("Usage: php script.php <file_path>"),
            !file_exists($filePath) => throw new RuntimeException("File '$filePath' does not exist"),
            !is_readable($filePath) => throw new RuntimeException("File '$filePath' is not readable"),
            default => true
        };
    }
}