<?php
namespace Kevin50406418\Ecpay\Facade;

use Illuminate\Support\Facades\Facade;

class Ecpay extends Facade {

	protected static function getFacadeAccessor() { return 'ecpay'; }

}