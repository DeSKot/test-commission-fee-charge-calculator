<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Utils;

use CommissionFeeCalculator\Enum\Calculation;
use CommissionFeeCalculator\Enum\Currency;
use CommissionFeeCalculator\ExchangeRate\Contract;

class CurrencyConvertor
{
    private array $rates;

    public function __construct(private readonly Contract $rateSource)
    {
        $this->rates = $this->getRates();
    }

    /**
     * Get currency rates
     *
     * @return array
     */
    private function getRates(): array
    {
        $file = ROOT_PATH . '/storage/cache/currency_rates.json';

        if (file_exists($file) && (time() - filemtime($file)) < 3600) {
            $cachedData = json_decode(file_get_contents($file), true);
            if (!empty($cachedData['rates'])) {
                return $cachedData['rates'];
            }
        }

        $rates = $this->rateSource->getRates();
        file_put_contents($file, json_encode(['rates' => $rates, 'cached_at' => time()]));

        return $rates;
    }

    public function convertToEuro(string $amount, string $currency): ?string
    {
        if ($currency === Currency::EUR->value) {
            return $amount;
        }
        return bcdiv($amount, (string) $this->rates[$currency], Calculation::DEFAULT_SCALE->value);
    }

    public function convertFromEuro(string $amount, string $currency): ?string
    {
        if ($currency === Currency::EUR->value) {
            return $amount;
        }
        return bcmul($amount, (string) $this->rates[$currency], Calculation::DEFAULT_SCALE->value);
    }
}
