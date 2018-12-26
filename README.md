## Laravel Ecpay
[![Latest Stable Version](https://poser.pugx.org/kevin50406418/ecpay/v/stable)](https://packagist.org/packages/kevin50406418/ecpay)
[![License](https://poser.pugx.org/kevin50406418/ecpay/license)](https://packagist.org/packages/kevin50406418/ecpay)
[![Latest Unstable Version](https://poser.pugx.org/kevin50406418/ecpay/v/unstable)](https://packagist.org/packages/kevin50406418/ecpay)
[![Total Downloads](https://poser.pugx.org/kevin50406418/ecpay/downloads)](https://packagist.org/packages/kevin50406418/ecpay)
[![Monthly Downloads](https://poser.pugx.org/kevin50406418/ecpay/d/monthly)](https://packagist.org/packages/kevin50406418/ecpay)

Laravel Ecpay 是 [綠界科技](https://www.ecpay.com.tw) 非官方套件

### Ecpay - Laravel 5 version
It is a fork from [ScottChayaa/Allpay](https://github.com/ScottChayaa/Allpay) package

#### Step 1 : 安裝套件
composer 命令安裝
```
composer require kevin50406418/ecpay
```
或者是新增 package 至 composer.json
```
"require": {
  "kevin50406418/ecpay": "^1.0.0"
},
```
然後更新安裝
```
composer update
```
或全新安裝
```
composer install
```

#### Step 2 : 註冊 ServiceProvider 和 Facade
增加 `config/app.php` 中的 `providers` 和 `aliases` 的參數，依需求加上  (Laravel 5.5 以上無須手動註冊)

```
'providers' => [
  // ...
  Kevin50406418\Ecpay\EcpayServiceProvider::class,
]

'aliases' => [
  // ...
  'Ecpay' => Kevin50406418\Ecpay\Facade\Ecpay::class,
]
```

#### Step 3 : 建立設定檔
執行下列命令，將 package 的 config 檔配置到你的專案中

```
php artisan vendor:publish --provider=Kevin50406418\Ecpay\EcpayServiceProvider
```

可至 config/ecpay.php 中查看 

預設是測試 Ecpay 設定
```php
return [
    'ServiceURL' => 'http://payment-stage.allpay.com.tw/Cashier/AioCheckOut',
    'HashKey'    => '5294y06JbISpM5x9',
    'HashIV'     => 'v77hoKGq4kWxNNIS',
    'MerchantID' => '2000132',
];
```

#### Step 4 : 在 .env 中加入下列設定
[MerchantID及HashKey、HashIV的取得](https://www.ecpay.com.tw/CascadeFAQ/CascadeFAQ_Qa?nID=1179)

```
#Ecpay
ECPAY_TEST_MODE=false
ECPAY_SERVICE_URL=https://payment.ecpay.com.tw/Cashier/AioCheckOut/V5
ECPAY_HASH_KEY=
ECPAY_HASH_IV=
ECPAY_MERCHANT_ID=
ECPAY_ENCRYPT_TYPE=1
```

---

### 使用
**產生訂單**
```php
use Ecpay;
```
```php
public function Demo()
{
    //Official Example : 
    //https://github.com/ECPay/ECPayAIO_PHP/blob/master/AioSDK/example/sample_All_CreateOrder.php
    
    //基本參數(請依系統規劃自行調整)
    Ecpay::i()->Send['ReturnURL']         = "http://www.ecpay.com.tw/receive.php" ;
    Ecpay::i()->Send['MerchantTradeNo']   = "Test".time() ;                //訂單編號
    Ecpay::i()->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');           //交易時間
    Ecpay::i()->Send['TotalAmount']       = 2000;                          //交易金額
    Ecpay::i()->Send['TradeDesc']         = "good to drink" ;              //交易描述
    Ecpay::i()->Send['ChoosePayment']     = \ECPay_PaymentMethod::ALL ;    //付款方式

    //訂單的商品資料
    Ecpay::i()->Send['Items'][] = [
        'Name' => "歐付寶黑芝麻豆漿",
        'Price' => (int)"2000",
        'Currency' => "元",
        'Quantity' => (int) "1",
        'URL' => "dedwed"
    ];

    //導向綠界
    return Ecpay::i()->CheckOutString();
}
```

**付款結果通知**

```php
public function PayReturn(Request $request)
{
    /* 取得回傳參數 */
    $arFeedback = Ecpay::i()->CheckOutFeedback($request->all());
    //...
}
```