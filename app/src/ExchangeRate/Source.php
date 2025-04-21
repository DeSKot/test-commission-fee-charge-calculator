<?php

namespace CommissionFeeCalculator\ExchangeRate;

use CommissionFeeCalculator\Enum\Currency;

class Source implements Contract
{
    protected array $symbols = [];
    public function __construct()
    {
        foreach (Currency::cases() as $currency) {
            $this->symbols[] = $currency->value;
        }
    }

    const BASE_URL = "https://api.exchangeratesapi.io/latest";

    public function getRates(): array
    {
        $params = [
            'access_key' => $_ENV['EXCHANGE_RATES_ACCESS_KEY'],
            'symbols' => implode(',', $this->symbols),
        ];
        $url = self::BASE_URL . '?' . http_build_query($params);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);

        $response = curl_exec($ch);

        if ($error = curl_error($ch)) {
            echo $error;
        }

        $decodedData = json_decode($response, true);

        curl_close($ch);

        return $decodedData['rates'];
    }
}