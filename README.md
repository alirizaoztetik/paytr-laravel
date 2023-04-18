## Licence
[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)

## Description 
PayTR integration for Laravel. <br>
This package is under development, first version only supports iFame payment screen.<br><br>
Thanks in advance for your contribution.
<br><br>
## Installation
`composer require turown/laravel-paytr`
<br><br>

Publish configuration and assets

`php artisan vendor:publish --tag="paytr"`
## Usage

To run this project you will need to add the following environment variables to your .env file

```
PAYTR_MERCANT_ID
PAYTR_MERCANT_KEY
PAYTR_MERCANT_SALT
PAYTR_API_URL
PAYTR_OK_URL
PAYTR_FAIL_URL
```

#### Configs

You can change or get the necessary settings in the [config](https://github.com/alirizaoztetik/paytr-laravel/blob/v1/config/paytr.php) file. This file is important

`use PayTR\Config;` <br>

You can easily access it with the help of it, you can perform operations as in the example.

The example below is the config that needs to be set for simple api triggering.

```php
$config = new Config();
$config->setMerchantId(00000)
       ->setMerchantKey("XXXXX")
       ->setMerchantSalt("XXXX")
       ->setApiType(2) // iFrame Type
       ->setApiUrl(ENV('PAYTR_API_URL') . 'odeme/api/get-token');
```
<br>

Next, we define the required array variable to generate the HASH DATA.

```php
 $hash_data = [
        "merchant_id"       => $config->getMerchantId(),
        "user_ip"           => request()->ip(),
        "merchant_oid"      => 1002945, //must be unique
        "email"             => "ali.riza.oztetik@gmail.com",
        "payment_amount"    => 999, //9.99 TL|EUR|USD vs. for 999;
        "user_basket"       => json_encode([
            ["Test Product", "9.99", 1] //(Product Name - Unit Price - Quantity)
        ]),
        "no_installment"    => $config->getNoInstallment(),
        "max_installment"   => $config->getMaxInstallment(),
        "currency"          => $config->getCurrency(),
        "test_mode"         => $config->getTestMode()
    ];
```

<br>

And we set the post data array and trigger the necessary

```php
 $post_data = [
        'user_name'         => "Ali Rıza Öztetik",
        'user_address'      => "test",
        'user_phone'        => "901111111111", //Need [+][country code][area code][phone number]
        'paytr_token'       => $paytr->setHashStr($hash_data)->getToken()->token,
        'debug_on'          => $config->getDebugOn(),
        'merchant_ok_url'   => $config->getMerchantOkUrl(),
        'merchant_fail_url' => $config->getMerchantFailUrl(),
        'timeout_limit'     => $config->getTimeoutLimit()
    ];

 $post_data = array_merge($post_data, $hash_data); //Absolutely 2 array data must be combined.
```

<br>

Then you can activate the PayTR class and operate with the call method.

`use PayTR\Paytr;` <br>
```php
$trigger = $paytr->call($post_data, $config->getApiUrl());
```

<br><br>

Using iFrame will return you success and a token after the transaction. In addition, I have included the necessary javascript codes for you.

```php
{
  +"status": "success"
  +"token": "090aab565210f757db0d9948ed4f58c8723a9f1de3beac1f651a90cdf9b2f678-324703229"
  +"javascript_file_url": "https://www.paytr.com/js/iframeResizer.min.js"
  +"iframe_code": "<iframe src="https://www.paytr.com/odeme/guvenli/090aab565210f757db0d9948ed4f58c8723a9f1de3beac1f651a90cdf9b2f678-324703229" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe>"
  +"script": "<script>iFrameResize({},'#paytriframe');</script>"
}
```

By including the script with the <b>"javascript_file_url"</b> in the return, you can print the <b>"iframe_code"</b> code wherever you want. Don't forget to include the <b>"script"</b> variable as well.

<br><br>

It's actually that simple!

A payment screen will then appear on your screen. After the transaction made on this screen, the API will return to you, all your successful or unsuccessful returns are specified in the settings;

`'merchant_ok_url' => $config->getMerchantOkUrl()`
`'merchant_fail_url' => $config->getMerchantFailUrl()`

This is why these settings are very important.
