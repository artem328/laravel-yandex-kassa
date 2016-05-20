<?php
namespace Artem328\LaravelYandexKassa;

use Illuminate\Routing\Controller;

class YandexKassaController extends Controller
{
    public function test()
    {
        echo \Route::getCurrentRoute()->getUri();
    }
}