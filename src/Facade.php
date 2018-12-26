<?php
namespace Kevin50406418\Ecpay;

class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return Ecpay::class;
    }
}