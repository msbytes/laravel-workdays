Simple working days operations for Laravel
==============

* [Version Compatibility](#version-compatibility)
* [Installation](#installation)
* [Usage](#usage)
* [License](#license)

## Version Compatibility

 Laravel  | Workdays
:---------|:----------
 4.x.x    | 4.x.x

## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
    "require-dev": {
        "msbytes/laravel-workdays": "^4.0"
    }
}
```

And then run `composer install` from the terminal.

### Quick Installation

Above installation can also be simplified by using the following command:

    composer require --dev "msbytes/laravel-workdays=^4.0"


## Usage

To use this package you need to prepare `HolidayProvider` for your country.
It must implement `Msbytes\LaravelWorkdays\Contracts\HolidayProvider`. 
There is [PlHolidayProvider](src/Msbytes/LaravelWorkdays/PlHolidayProvider.php) for Poland as an example. 

Add workdays service provider to `app/config/app.php`.

```php
return array(
	...
	'providers' => array(
		...
		'Msbytes\LaravelWorkdays\LaravelWorkdaysServiceProvider'
	),
	...
);
```

Easiest way is to just use provided `Workdays` facade.

Before making any operation or if you want to change country you need to set holiday provider 
for service.

```
$provider = new YourHolidayProvider();
Workdays::setHolidayProvider($provider);
```

Start using it (these examples are using holidays provider for Poland)

```
$check = Workdays::isWorkingDay('2018-03-27'); // true
$deliveryDate = Workdays::addWorkingDays('2018-03-27', 4); // 2018-04-03
$pastOrders = Workdays::substractWorkingDays('2018-03-27', 7); // 2018-03-16
```

## License
[MIT License](LICENSE)