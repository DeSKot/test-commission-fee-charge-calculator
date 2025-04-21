<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Traits;

trait ExceptionMessageHandler
{

    protected function messageHandler($exception): void
    {
        echo $exception->getMessage() . PHP_EOL;
        echo $exception->getFile() . PHP_EOL;
        echo $exception->getLine() . PHP_EOL;
        exit(1);
    }
}