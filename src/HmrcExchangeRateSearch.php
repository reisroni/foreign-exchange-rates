<?php
namespace RallienIT\HmrcExRates;

use SimpleXMLElement;

class HmrcExchangeRateSearch implements ExchangeRateSearch
{
    private const HMRC_URL = "http://www.hmrc.gov.uk/softwaredevelopers/rates/exrates-monthly-%s%s.XML";

    public function searchMonthlyExRate(string $currency, string $month, string $year): float
    {
        $rate = 0;
        $monthlyExRatesXml = @simplexml_load_file(sprintf(self::HMRC_URL, $month, $year));

        if ($monthlyExRatesXml)
            $rate = $this->searchExRate($monthlyExRatesXml, $currency);

        return $rate;
    }

    private function searchExRate(SimpleXMLElement $monthlyExRatesxml, string $currencyCode): float {
        $result = 0;

        foreach($monthlyExRatesxml->exchangeRate as $exchangeRate)
		{
			if ($currencyCode == (string) $exchangeRate->currencyCode) {
				$result = (float) $exchangeRate->rateNew;
                break;
			}
		}

        return $result;
    }
}