<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\FileReader\Transaction;

use CommissionFeeCalculator\Service\FileReader\RowDto;
use DateTime;

class TransactionRowDto extends RowDto
{
    private readonly int $userId;
    private readonly string $userType;
    private readonly string $operationType;
    private readonly string $amount;
    private readonly string $currency;
    private readonly DateTime $date;

    protected function setRowData(): void
    {
        $this->date = DateTime::createFromFormat('Y-m-d', $this->rowData[0]);
        $this->userId = (int)$this->rowData[1];
        $this->userType = $this->rowData[2];
        $this->operationType = $this->rowData[3];
        $this->amount = $this->rowData[4];
        $this->currency = $this->rowData[5];
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUserType(): string
    {
        return $this->userType;
    }

    public function getOperationType(): string
    {
        return $this->operationType;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }
}