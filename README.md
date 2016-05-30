# Laravel Yandex Kassa

Yandex Money integration with Laravel framework

## Introduction
Laravel Yandex Kassa Package is kind of integration helper with Laravel Framework.

## Installation
To install through composer, simply put the following in your `composer.json` file:

```json
{
    "require": {
        "artem328/laravel-yandex-kassa": "~1.0.*"
    }
}
```

And then run `composer install` from the terminal.

### Quick Installation

Above installation can also be simplify by using the following command:

    composer require "artem328/laravel-yandex-kassa=~1.0.*"

## Usage

### Service Provider
For using Laravel Yandex Kassa Package, you need to add service provider into `config/app.php` file:
```php
<?php
    return [
        //...
        'providers' => [
            //...
            Artem328\LaravelYandexKassa\YandexKassaServiceProvider::class,
        ],
        //...
    ];
```

### Alias
For resolving `YandexKassa` class instance you can add such line into `config/app.php` file:
```php
<?php
    return [
        //...
        'aliases' => [
            //...
            'YandexKassa' => Artem328\LaravelYandexKassa\Facades\YandexKassa::class,
        ],
        //...
    ];
```
and now call methods statically from `YandexKassa` class or you can use helper function `yandex_kassa()`

### Configs
Also you need to publish configs, and fill some required data as `sc_id`, `shop_id` and `shop_password`. To publish configs, run this command:

    php artisan vendor:publish --provider="Artem328\LaravelYandexKassa\YandexKassaServiceProvider" --tag="config"

Now config file `yandex_kassa.php` will be placed at your application config directory. In your application .env file you can set some options:
 * `test_mode` as `YANDEX_KASSA_TEST_MODE`
 * `shop_id` as `YANDEX_KASSA_SHOP_ID`
 * `sc_id` as `YANDEX_KASSA_SC_ID`
 * `shop_password` as `YANDEX_KASSA_SHOP_PASSWORD`

### Views
As default this package use bootstrap 3 form layout that should be included into your page. You can customize this form by publishing views. To do this, run this command:

    php artisan vendor:publish --provider="Artem328\LaravelYandexKassa\YandexKassaServiceProvider" --tag="view"

and default layouts will be placed at your resource directory under `views/vendor/yandex_kassa`. You can customize layouts now. Pay attention at form layout that should contain all required fields for Yandex Kassa work correctly.

### Languages
You can publish language files if you want customize payment names or form labels. Just run command:

    php artisan vendor:publish --provider="Artem328\LaravelYandexKassa\YandexKassaServiceProvider" --tag="lang"

Localization files will be placed to resource directory `lang/vendor/yandex_kassa`. If you need to add new locale files just create directory with locale name inside and copy files structure from existing locale folder, then change translation values.

#### Publish all resources
If you want to publish config, views and languages, just run this command:

    php artisan vender:publish --provider="Artem328\LaravelYandexKassa\YandexKassaServiceProvider"

### Show payment form
To show payment form in your layout just add this code:
```blade
@include('yandex_kassa::form')
```
Of course you can [customize form](#views) or create your own one and include it.

### Callback links
You can set callback links (checkOrder, paymentAviso etc) in config file at route section

### Payment Types
Payments types can be set in config file at payment types section. There is a link to documentation page with full list of payment types.

### Events
Yandex Kassa calls your application callbacks and waiting for response. You can customize response parameters by listening callback events. For example:
```php
<?php
    namespace App\Listeners;

    use App\Order;
    use Artem328\LaravelYandexKassa\Events\BeforePaymentAvisoResponse;

    class ChangeOrderStatusWhenPaymentSuccessful
    {
        /**
         * @param \Artem328\LaravelYandexKassa\Events\BeforePaymentAvisoResponse
         * @return void
         */
        public function handle(BeforePaymentAvisoResponse $event)
        {
            // if hash is valid we know that payment is successful
            // and we can change order status
            if ($event->request->isValidHash()) {
                $order = Order::find($event->request->get('orderNumber'));
                $order->setStatus('packing');
                $order->save();
            } else {
                // Logic on non valid hash
                // You don't need to set response code to 1
                // YandexKassaRequest do it automatically
            }
        }
    }
```

```php
<?php
    namespace App\Listeners;

    use App\Order;
    use Artem328\LaravelYandexKassa\Events\BeforeCheckOrderResponse;

    class CheckOrderRequisites
    {
        /**
         * @param \Artem328\LaravelYandexKassa\Events\BeforeCheckOrderResponse
         * @return array|null
         */
        public function handle(BeforeCheckOrderResponse $event)
        {
            // If you have some custom validation of payment form
            // You can change response parameters before controller
            // will show it
            if ($event->request->get('customField') != '1') {
                $event->responseParameters['code'] = 100;
                $event->responseParameters['message'] = 'Some checkbox was not checked';
                // You must to return response parameters array,
                // for apply changes
                return $event->responseParameters;
            }

            // If there's no parameters changes
            // just return null or empty array
            return null;
        }
    }
```

To listen events you should add some code to `app/Providers/EventServiceProvider.php`:
```php
<?php
    namespace App\Providers;

    //...
    use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

    class EventServiceProvider extends ServiceProvider
    {
        //...
        protected $listen = [
            'Artem328\LaravelYandexKassa\Events\BeforeCheckOrderResponse' => [
                'App\Listeners\CheckOrderRequisites',
                // You can add more than one listener and every
                // listener can return own parameters. Incoming
                // parameters WILL NOT extend. But response
                // parameters WILL override in listeners order
                // 'App\Listeneres\AddCheckOrderRecord',
            ],
            'Artem328\LaravelYandexKassa\Events\BeforePaymentAvisoResponse' => [
                'App\Listeners\ChangeOrderStatusWhenPaymentSuccessful',
            ]
        ];
        //...
    }
```

## Licence
MIT. See the [LICENCE](https://github.com/artem328/laravel-yandex-kassa/blob/master/LICENSE.md) file