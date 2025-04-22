<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Transaction\Context;

use CommissionFeeCalculator\Service\Transaction\Context\Operation\Operation;

class User
{
    private Operation $operation;
    private int $userId;
    private string $userType;

    public function __construct()
    {
        $this->operation = new Operation();
    }

    public function getOperation(): Operation
    {
        return $this->operation;
    }

    public function setOperation(Operation $operation): void
    {
        $this->operation = $operation;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserType(): string
    {
        return $this->userType;
    }

    public function setUserType(string $userType): void
    {
        $this->userType = $userType;
    }
}