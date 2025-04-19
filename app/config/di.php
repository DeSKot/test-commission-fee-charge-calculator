<?php

declare(strict_types=1);

use CommissionFeeCalculator\App;
use CommissionFeeCalculator\Parameters\Validation\Main\Handler as MainHandlerValidation;
use DI\ContainerBuilder;
use DI\Container;

return function (): Container|string
{
    $container = new ContainerBuilder();

    $container->addDefinitions([
        App::class => DI\create(App::class)->constructor(
            DI\create(MainHandlerValidation::class),
        )
    ]);

    return $container->build();
};