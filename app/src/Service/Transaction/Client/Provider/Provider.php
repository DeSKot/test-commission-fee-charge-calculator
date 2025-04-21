<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Client\Provider;

use CommissionFeeCalculator\Config\Config;
use CommissionFeeCalculator\Exceptions\Transaction\InvalidClientType;
use CommissionFeeCalculator\Service\Transaction\Client\Business\Client as BusinessClient;
use CommissionFeeCalculator\Service\Transaction\Client\Client as AbstractClient;
use CommissionFeeCalculator\Service\Transaction\Client\Private\Client as PrivateClient;
use CommissionFeeCalculator\Enum\Client as ClientEnum;
use CommissionFeeCalculator\Service\Transaction\Client\Rules\FreeCharge\CommissionHandler as PrivateWithdrawCommissionHandler;

class Provider implements Contract
{

    public function __construct(
        protected Config $config,
        protected PrivateWithdrawCommissionHandler $privateWithdrawCommissionHandler,
    )
    {
    }

    /**
     * @throws InvalidClientType
     */
    public function select(string $clientType): AbstractClient
    {
        return match ($clientType) {
            ClientEnum::PRIVATE->value => new PrivateClient($this->privateWithdrawCommissionHandler),
            ClientEnum::BUSINESS->value => new BusinessClient(),
            default => throw new InvalidClientType('Invalid client type'),
        };
    }
}