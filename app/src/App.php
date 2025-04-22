<?php
declare(strict_types=1);

namespace CommissionFeeCalculator;

use CommissionFeeCalculator\Exceptions\Kernel as KernelException;
use CommissionFeeCalculator\Service\FileReader\Reader as FileReader;
use CommissionFeeCalculator\Service\Parameters\DTO\CliParameters;
use CommissionFeeCalculator\Service\Parameters\Validation\Validation;

readonly class App
{
    public function __construct(
        private Validation      $validation,
        private KernelException $kernelException,
        private FileReader      $fileReader,
    )
    {
        $this->kernelException->setExceptionHandler();
    }

    public function handle(int $argc, array $argv): void
    {
        $parameters = new CliParameters($argc, $argv);
        $this->validation->validate($parameters);

        $this->fileReader->display(
            $this->fileReader->read($parameters->getFilePath())
        );
    }
}