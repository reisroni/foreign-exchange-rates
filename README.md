[![Minimum PHP version: 8.1.0](https://img.shields.io/badge/php-8.1.0%2B-blue.svg?label=PHP)](https://www.php.net/)

Exchange Rates from HMRC
========================

Check the foreign exchange monthly rates from HMRC.

[HM Revenue & Customs](https://www.gov.uk/government/collections/exchange-rates-for-customs-and-vat)

----

## Getting Started

These instructions will get you a copy of the project up and running on your local machine. 

### Prerequisites/Requirements

- [PHP 8.1 or greater](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- Web-server (Apache or Nginx)
- Or an **AMP** solution stack like [XAMPP](https://www.apachefriends.org/)

### Running

- Go to the web-server document root directory, for example: `/opt/lampp/htdocs` or `/var/www`:

```shell
cd /opt/lampp/htdocs
```

- Clone the project:

```shell
git clone https://git_url/foreign-exchange-rates.git
```

Or Download the latest archive and unzip it.

- Run:

```shell
composer install
```

- Launch in a browser the web-server corresponding URL (e.g. `http://localhost/public/index.php`)

## Tests

The project ships with unit and integration tests using [Pest](https://pestphp.com/).

- Run the _unit tests_ throuh composer by running:

```shell
composer test:unit
```

- Run the _integration tests_ throuh composer by running:

```shell
composer test:integration
```

- See the _code coverage_ throuh composer by running (XDebug required):

```shell
composer test:coverage
```

The included `composer.json` file, has all the above scripts.

## Built With

* [Bootstrap](https://getbootstrap.com/) - Frontend toolkit

## Author

* **Roni Reis (Rallien IT)**