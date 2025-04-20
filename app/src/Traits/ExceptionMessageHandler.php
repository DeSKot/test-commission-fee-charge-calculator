<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Traits;

trait ExceptionMessageHandler
{

    protected function messageHandler($exception): void
    {
        echo $exception->getMessage() . PHP_EOL;
        exit(1);
    }
}