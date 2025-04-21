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
     */
    public function validate(MainDTO $mainDto): bool
    {
        if ($mainDto->getArgc() < 2) {
            throw new InvalidArgumentException("Usage: php script.php <file_path>");
        }

        $filePath = $mainDto->getFilePath();
        if (!file_exists($filePath)) {
            throw new RuntimeException("File '$filePath' does not exist");
        }

        if (!is_readable($filePath)) {
            throw new RuntimeException("File '$filePath' is not readable.");
        }

        return true;
    }
}