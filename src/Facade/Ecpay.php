<?php

namespace Kevin50406418\Ecpay\Facade;

class Ecpay extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ecpay';
    }
}