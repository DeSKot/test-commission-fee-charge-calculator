<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\Parameters\DTO;

class CliParameters
{
    protected int $argc;
    protected string|null $filePath;

    public function __construct(int $argc, array $argv)
    {
        $this->setArgc($argc);
        $this->setFilePath($argv[1] ?? null);
    }

    protected function setArgc(int $argc): void
    {
        $this->argc = $argc;
    }

    protected function setFilePath(?string $filePath): void
    {
        $this->filePath = $filePath;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function getArgc(): int
    {
        return $this->argc;
    }
}