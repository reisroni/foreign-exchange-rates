<?php
namespace RallienIT\HmrcExRates;

use RallienIT\HmrcExRates\ExchangeRateSearch;

class FakeExchangeRateSearch implements ExchangeRateSearch
{
    public function searchMonthlyExRate(string $currency, string $month, string $year): float
    {
        return 1.10;
    }
}