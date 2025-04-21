<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Client\Provider;

use CommissionFeeCalculator\Service\Transaction\Client\Client;

interface Contract
{
    public function select(string $clientType): Client;
}