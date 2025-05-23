<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Config;

readonly class Config
{
    public function __construct(
        private string $depositFeeRate,
        private string $businessWithdrawFeeRate,
        private string $privateWithdrawFeeRate,
        private string $freeLimit,
        private int    $freeOperationsLimit,
        private array  $currencyDecimalPlaces,
    ) {
    }

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
