<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 21.05.2016
 * Time: 15:24
 */

namespace Artem328\LaravelYandexKassa\Facades;

use Illuminate\Support\Facades\Facade;

class YandexKassa extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'yandexkassa';
    }

}