<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\ExchangeRate;

interface Contract
{
    public function getRates(): array;
}