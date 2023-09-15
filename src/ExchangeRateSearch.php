<?php
namespace RallienIT\HmrcExRates;

interface ExchangeRateSearch
{
    public function searchMonthlyExRate(string $currency, string $month, string $year): float;
}