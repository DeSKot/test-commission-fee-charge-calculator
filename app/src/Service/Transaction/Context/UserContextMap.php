<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Context;

use CommissionFeeCalculator\Config\Config;
use Doctrine\Common\Collections\ArrayCollection;

class UserContextMap
{
    private ArrayCollection $collection;

    public function __construct(
        private readonly Config $config,
    ) {
        $this->collection = new ArrayCollection();
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function set(int $userId, User $userContext): void
    {
        $this->collection->set($userId, $userContext);
    }

    public function get(int $userId): User
    {
        return $this->collection->get($userId);
    }

    public function containsUser(int $userId): bool
    {
        return $this->collection->containsKey($userId);
    }
}
