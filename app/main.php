<?php

declare(strict_types=1);

const ROOT_PATH = __DIR__;

require_once './vendor/autoload.php';
use CommissionFeeCalculator\App;


$containerFactory = require_once __DIR__ . '/config/di.php';
$container = $containerFactory();


$app = $container->get(App::class);
$app->handle($argc, $argv);


