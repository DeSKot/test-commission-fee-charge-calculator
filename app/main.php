<?php

declare(strict_types=1);

const ROOT_PATH = __DIR__;

require_once './vendor/autoload.php';
use CommissionFeeCalculator\App;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dotenv->required([
    'EXCHANGE_RATES_ACCESS_KEY',
    'DEPOSIT_FEE_RATE',
    'BUSINESS_WITHDRAW_FEE_RATE',
    'PRIVATE_WITHDRAW_FEE_RATE',
    'FREE_LIMIT',
    'FREE_OPERATIONS_LIMIT',
    'CURRENCY_DECIMAL_PLACES_EUR',
    'CURRENCY_DECIMAL_PLACES_USD',
    'CURRENCY_DECIMAL_PLACES_JPY',
    'PHP_CS_FIXER_IGNORE_ENV'
])->notEmpty();

$containerFactory = require_once __DIR__ . '/config/di.php';
$container = $containerFactory();


$app = $container->get(App::class);
$app->handle($argc, $argv);
