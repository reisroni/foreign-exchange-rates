<?php
namespace RallienIT\HmrcExRatesTests;
use DateTime;

uses()->group('integration');

it("should create an error when date is empty", function () {
    $_GET['submit'] = 'true';
    $_GET['d'] = '';
    $_GET['c'] = 'USD';

    require __DIR__.'/../../src/Submit.php';

    expect($result)->toBeFalse()
        ->and($error_msg)->toContain('Date is empty');
});

it("should create an error when currency code is empty", function () {
    $_GET['submit'] = 'true';
    $_GET['d'] = '2022-01';
    $_GET['c'] = '';

    require __DIR__.'/../../src/Submit.php';

    expect($result)->toBeFalse()
        ->and($error_msg)->toContain('Currency');
});

it("should create an error when a future date is submited", function () {
    $futureDate = (new DateTime())->modify('+1 month')->format('Y-m');
    $_GET['submit'] = 'true';
    $_GET['d'] = $futureDate;
    $_GET['c'] = 'USD';
    
    require __DIR__.'/../../src/Submit.php';

    expect($result)->toBeFalse()
        ->and($error_msg)->toContain('Date is not valid');
});

it("should create an error when a not valid/bad formated date is submited", function () {
    $_GET['submit'] = 'true';
    $_GET['d'] = '01152022';
    $_GET['c'] = 'USD';

    require __DIR__.'/../../src/Submit.php';

    expect($result)->toBeFalse()
        ->and($error_msg)->toContain('Date is not valid');
});

it("should create an error when overflow date is submited", function () {
    $_GET['submit'] = 'true';
    $_GET['d'] = '2022-15';
    $_GET['c'] = 'USD';

    require __DIR__.'/../../src/Submit.php';
   
    expect($result)->toBeFalse()
        ->and($error_msg)->toContain('Date is not valid');
});

it("should create an error when old date is submited", function () {
    $_GET['submit'] = 'true';
    $_GET['d'] = '2002-01';
    $_GET['c'] = 'USD';

    require __DIR__.'/../../src/Submit.php';

    expect($result)->toBeFalse()
        ->and($error_msg)->toContain('Date is not valid');
});

it("should create an error when an invalid ISO currency code is submited", function () {
    $_GET['submit'] = 'true';
    $_GET['d'] = '2022-01';
    $_GET['c'] = 'US';

    require __DIR__.'/../../src/Submit.php';

    expect($result)->toBeFalse()
        ->and($error_msg)->toContain('ISO currency code');
});

it("should create an error when not able to fetch the rate", function () {
    $_GET['submit'] = 'true';
    $_GET['d'] = '2022-01';
    $_GET['c'] = 'XXX';

    require __DIR__.'/../../src/Submit.php';

    expect($result)->toBeFalse()
        ->and($error_msg)->toContain('Not able to fetch');
});

it("should fech a rate when a valid form is submited", function () {
    $_GET['submit'] = 'true';
    $_GET['d'] = '2022-01';
    $_GET['c'] = 'USD';

    require __DIR__.'/../../src/Submit.php';

    expect($result)->toBeTrue()
        ->and($rate)->toBe(1.3215);
});

it("should show rate = 1 when currency is GBP", function () {
    $_GET['submit'] = 'true';
    $_GET['d'] = '2022-01';
    $_GET['c'] = 'GBP';

    require __DIR__.'/../../src/Submit.php';

    expect($result)->toBeTrue()
        ->and($rate)->toBe(1);
});