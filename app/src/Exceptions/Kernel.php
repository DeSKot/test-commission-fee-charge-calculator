<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Exceptions;

use CommissionFeeCalculator\Traits\ExceptionMessageHandler;

class Kernel
{
    use ExceptionMessageHandler;

    public function setExceptionHandler(): void
    {
        set_exception_handler(function ($exception) {
            $this->messageHandler($exception);
        });
    }
}