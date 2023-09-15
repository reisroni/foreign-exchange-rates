<?php
namespace RallienIT\HmrcExRatesTests;

use RallienIT\HmrcExRates\HmrcForeignExchangeRate;
use RallienIT\HmrcExRates\FakeExchangeRateSearch;
use DomainException;

it("should create a new HMRC exchange rate", function () {
    $underTest = new HmrcForeignExchangeRate('EUR', new FakeExchangeRateSearch());
    
    expect($underTest->printCurrencyCode())->toBe('EUR');
});

it("should throw an exception when ISO currency code is not valid", function () {
    new HmrcForeignExchangeRate('US', new FakeExchangeRateSearch());
})->throws(DomainException::class);

it("should fetch monthly exchange rate", function () {
    $underTest = new HmrcForeignExchangeRate('USD', new FakeExchangeRateSearch());

    expect($underTest->fetchMonthlyRate('08', '23'))->toBe(1.10);
});