<?php

declare(strict_types=1);

use CommissionFeeCalculator\App;
use CommissionFeeCalculator\Exceptions\Kernel as KernelException;
use CommissionFeeCalculator\FileReader\Transaction\Reader as TransactionReader;
use CommissionFeeCalculator\Parameters\Validation\Main\Handler as MainHandlerValidation;
use DI\Container;
use DI\ContainerBuilder;

return function (): Container|string
{
    $container = new ContainerBuilder();

    $container->addDefinitions([
        App::class => DI\create(App::class)->constructor(
            DI\create(MainHandlerValidation::class),
            DI\create(KernelException::class),
            DI\create(TransactionReader::class)
        ),
    ]);

    return $container->build();
};