<?php
require_once __DIR__.'/../vendor/autoload.php';

use RallienIT\HmrcExRates\HmrcExchangeRateSearch;
use RallienIT\HmrcExRates\HmrcForeignExchangeRate;

if (isset($_GET['submit']))
{
    try
    {
        // Prepare the data
        $d = strip_tags(trim($_GET['d']));
        $c = strip_tags(trim($_GET['c']));
        
        if (empty($d)) {
            throw new DomainException('Date is empty.');
        }

        if (empty($c)) {
            throw new DomainException('Currency code is empty.');
        }

        $date_format = 'Y-m';
        $date = date_create_immutable_from_format($date_format, $d);
        $currency = strtoupper($c);

        if (FALSE === $date || $d !== $date->format($date_format)) {
            throw new DomainException('Date is not valid. Please try with another.');
        }

        if ((int) $date->format('Y') < 2016) {
            throw new RangeException('Date is not valid. Only rates from 2016');
        }

        if ($date > date_create_immutable()) {
            throw new RangeException('Date is not valid. Please try with another.');
        }

        // Fetch the rate
        $hmrc_exrate = new HmrcForeignExchangeRate($currency, new HmrcExchangeRateSearch());
        $month = $date->format('m');
        $year = $date->format('y');
        $rate = $currency === 'GBP' ? 1 : $hmrc_exrate->fetchMonthlyRate($month, $year);
        
        if (empty($rate)) {
            throw new RuntimeException('Not able to fetch the exchange rate. Please try again.');
        }

        $result = TRUE;
    }
    catch (Throwable $err)
    {
        $result = FALSE;
        $error_msg = $err->getMessage();
    }
}