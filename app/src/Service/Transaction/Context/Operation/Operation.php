<?php

namespace CommissionFeeCalculator\Service\Transaction\Context\Operation;

class Operation
{
    private Deposit $deposit;
    private Withdraw $withdraw;

    public function __construct()
    {
        $this->deposit = new Deposit();
        $this->withdraw = new Withdraw();
    }

    public function getDeposit(): Deposit
    {
        return $this->deposit;
    }

    public function getWithdraw(): Withdraw
    {
        return $this->withdraw;
    }
}