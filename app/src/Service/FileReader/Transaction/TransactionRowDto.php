<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\FileReader\Transaction;

use CommissionFeeCalculator\FileReader\RowDto;
use DateTime;

class TransactionRowDto extends RowDto
{
    private readonly int $userId;
    private readonly string $userType;
    private readonly string $type;
    private readonly string $amount;
    private readonly string $currency;
    private readonly \DateTime $date;

    protected function setRowData(): void
    {
        $this->userId = (int)$this->rowData[0];
        $this->userType = $this->rowData[1];
        $this->type = $this->rowData[2];
        $this->amount = $this->rowData[3];
        $this->currency = $this->rowData[4];
        $this->date = DateTime::createFromFormat('Y-m-d', $this->rowData[0]);
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getUserType(): string
    {
        return $this->userType;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }
}