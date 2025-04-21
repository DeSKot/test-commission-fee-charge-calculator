<?php

namespace CommissionFeeCalculator\Config;

class Config
{


    public function __construct(
        private readonly string $depositFeeRate,
        private readonly string $businessWithdrawFeeRate,
        private readonly string $privateWithdrawFeeRate,
        private readonly string $freeLimit,
        private readonly int    $freeOperationsLimit,
        private readonly array  $currencyDecimalPlaces,
    )
    {}

    public function getDepositFeeRate(): string
    {
        return $this->depositFeeRate;
    }

    public function getBusinessWithdrawFeeRate(): string
    {
        return $this->businessWithdrawFeeRate;
    }

    public function getPrivateWithdrawFeeRate(): string
    {
        return $this->privateWithdrawFeeRate;
    }

    public function getFreeLimit(): string
    {
        return $this->freeLimit;
    }

    public function getFreeOperationsLimit(): int
    {
        return $this->freeOperationsLimit;
    }

    public function getCurrencyDecimalPlaces(string $currency): int
    {
        return $this->currencyDecimalPlaces[$currency] ?? 2;
    }
}