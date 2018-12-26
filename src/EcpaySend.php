<?php

namespace Kevin50406418\Ecpay;

class EcpaySend extends \ECPay_Send
{
    /**
     * @param string $paymentButton
     * @param string $target
     * @param array $arParameters
     * @param array $arExtend
     * @param string $HashKey
     * @param string $HashIV
     * @param string $ServiceURL
     *
     * @return string
     */
    static function CheckOutString($paymentButton = 'Submit', $target = "_self", $arParameters = [], $arExtend = [], $HashKey = '', $HashIV = '', $ServiceURL = '')
    {
        $arParameters = self::process($arParameters, $arExtend);
        //產生檢查碼
        $szCheckMacValue = \ECPay_CheckMacValue::generate($arParameters, $HashKey, $HashIV, $arParameters[ 'EncryptType' ]);

        $parameters = array_merge($arParameters, ['CheckMacValue' => $szCheckMacValue]);

        return view('ecpay::send', compact('ServiceURL', 'parameters'));
    }
}