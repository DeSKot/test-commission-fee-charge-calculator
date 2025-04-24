<?php

declare(strict_types=1);

use CommissionFeeCalculator\App;
use CommissionFeeCalculator\Exceptions\Kernel as KernelException;
use CommissionFeeCalculator\Service\FileReader\Transaction\Reader as TransactionReader;
use CommissionFeeCalculator\Service\Parameters\Validation\Main\Handler as MainHandlerValidation;
use CommissionFeeCalculator\Service\Transaction\Client\Provider\Provider as TransactionClientProvider;
use CommissionFeeCalculator\Config\Config;
use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;
use CommissionFeeCalculator\Service\Transaction\Client\Rules\FreeCharge\CommissionHandler as PrivateWithdrawCommissionHandler;
use CommissionFeeCalculator\Utils\CurrencyConvertor;
use CommissionFeeCalculator\ExchangeRate\File;
use DI\Container;
use DI\ContainerBuilder;

return function (): Container|string {
    $container = new ContainerBuilder();

    $container->addDefinitions([
        Config::class => DI\create(Config::class)->constructor(
            $_ENV['DEPOSIT_FEE_RATE'],
            $_ENV['BUSINESS_WITHDRAW_FEE_RATE'],
            $_ENV['PRIVATE_WITHDRAW_FEE_RATE'],
            $_ENV['FREE_LIMIT'],
            (int) $_ENV['FREE_OPERATIONS_LIMIT'],
            [
                'EUR' => (int) $_ENV['CURRENCY_DECIMAL_PLACES_EUR'],
                'USD' => (int) $_ENV['CURRENCY_DECIMAL_PLACES_USD'],
                'JPY' => (int) $_ENV['CURRENCY_DECIMAL_PLACES_JPY'],
            ]
        ),
        UserContextMap::class => DI\create(UserContextMap::class)
            ->constructor(
                DI\get(Config::class)
            ),
        CurrencyConvertor::class => DI\create(CurrencyConvertor::class)->constructor(DI\get(File::class)),
        PrivateWithdrawCommissionHandler::class => DI\create(PrivateWithdrawCommissionHandler::class)->constructor(
            DI\get(CurrencyConvertor::class)
        ),
        App::class => DI\create(App::class)->constructor(
            DI\create(MainHandlerValidation::class),
            DI\create(KernelException::class),
            DI\create(TransactionReader::class)->constructor(
                DI\create(TransactionClientProvider::class)->constructor(
                    DI\get(Config::class),
                    DI\get(PrivateWithdrawCommissionHandler::class)
                ),
                Di\get(UserContextMap::class)
            )
        ),
    ]);

    return $container->build();
};
