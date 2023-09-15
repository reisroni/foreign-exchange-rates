<?php
namespace RallienIT\HmrcExRates;

interface ForeignExchangeRate
{
    public function fetchMonthlyRate(string $month, string $year): float;
    public function printCurrencyCode(): string;
}