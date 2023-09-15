<?php
namespace RallienIT\HmrcExRates;

use DomainException;

class HmrcForeignExchangeRate implements ForeignExchangeRate
{
    private readonly string $currencyCode;
    private readonly ExchangeRateSearch $rateSearch;
    private const ISO_CODE_LEN = 3;

    public function __construct(string $currencyCode, ExchangeRateSearch $rateSearch)
    {
        $this->checkCurrencyIsoCode($currencyCode);
        $this->currencyCode = strtoupper($currencyCode);
        $this->rateSearch = $rateSearch;
    }

    private function checkCurrencyIsoCode(string $currencyCode): void
    {
        if (self::ISO_CODE_LEN != mb_strlen($currencyCode))
            throw new DomainException('ISO currency code should have a length of ' . self::ISO_CODE_LEN);
    }
    
    public function fetchMonthlyRate(string $month, string $year): float
    {
        return  $this->rateSearch->searchMonthlyExRate($this->currencyCode, $month, $year);
    }

    public function printCurrencyCode(): string
    {
        return $this->currencyCode;
    }
}