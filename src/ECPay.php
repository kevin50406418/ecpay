<?php

namespace Kevin50406418\Ecpay;

use Kevin50406418\Ecpay\EcpayFactory;

class Ecpay
{
    private $instance = null;

    //--------------------------------------------------------
    public function __construct()
    {
        $this->instance = new EcpayFactory();
        config('ecpay.TestMode') ? $this->setForTest() : $this->setForProd();
    }

    public function instance()
    {
        return $this->instance;
    }

    public function i()
    {
        return $this->instance;
    }

    private function setForTest()
    {
        $this->instance->ServiceURL  = 'https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5';
        $this->instance->HashKey     = '5294y06JbISpM5x9';
        $this->instance->HashIV      = 'v77hoKGq4kWxNNIS';
        $this->instance->MerchantID  = '2000132';
        $this->instance->EncryptType = 1;
    }

    private function setForProd()
    {
        $this->instance->ServiceURL  = config('ecpay.ServiceURL');
        $this->instance->HashKey     = config('ecpay.HashKey');
        $this->instance->HashIV      = config('ecpay.HashIV');
        $this->instance->MerchantID  = config('ecpay.MerchantID');
        $this->instance->EncryptType = config('ecpay.EncryptType');

    }
}