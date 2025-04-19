<?php
declare(strict_types=1);
namespace CommissionFeeCalculator;

use CommissionFeeCalculator\Parameters\DTO\CliParameters;
use CommissionFeeCalculator\Parameters\Validation\Validation;

class App
{
    public function __construct(
        private Validation $validation,
        //file handler (inside file handler we will provide calc chain inerface
        // which can handle full creanatio
        //jr nned to thing about structure of realisastion
        //do'nt forget about operation interface
        //client abstract class implements opertion interface
        // we create provider which handle type of client and provide specific client implementation
        // after we have to define operation method from interface by name from file
    )
    {}

    public function handle(int $argc, array $argv): void
    {
        $parameters = new CliParameters($argc, $argv);
        $this->validation->validate($parameters);

        var_dump($parameters);
    }
}