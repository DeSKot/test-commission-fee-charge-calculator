<?php

namespace CommissionFeeCalculator\ExchangeRate;

interface Contract
{
    public function getRates(): array;
}