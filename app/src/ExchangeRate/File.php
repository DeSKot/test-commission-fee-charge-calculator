<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\ExchangeRate;

class File extends Source
{
    public function getRates(): array
    {
        $filePath = ROOT_PATH . '/storage/files/rates.json';
        if (!file_exists($filePath)) {
            file_put_contents($filePath, parent::getRates());
        }

        return json_decode(file_get_contents($filePath), true);
    }
}
