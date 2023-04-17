<?php

namespace PayTR;

use Illuminate\Support\Arr;

class Config
{
    /**
     * API Account Info
     */
    private $merchant_id = 0;
    private $merchant_key = 0;
    private $merchant_salt = 0;

    /**
     * Number of installments
     * support: 0, 2, 3, 4, 5, 6, 7, 8, 9, 10,11,12
     */
    private $max_installment = 0;

    /**
     * If you don't want to be paid in installments, do "1" if you only offer one shot.
     * support: 0, 1
     */
    private $no_installment = 0;

    /**
     * Test can be sent as "1" for action while store is in live mode
     * support: 0, 1
     */
    private $test_mode = 0;

    /**
     * Return an error: If incorrect or incomplete information is sent to PayTR, "1"
     * must be sent to return an error message from the system.
     * support: 0, 1
     */
    private $debug_on = 0;

    /**
     * can be sent to take "1" action
     * support: 0, 1
     */
    private $non_3d = 0;

    /**
     * Language to be used on pages during checkout
     */
    private $lang = "";

    /**
     * Success URL to be used on during checkout
     */
    private $merchant_ok_url = "";

    /**
     * Fail URL to be used on during checkout
     */
    private $merchant_fail_url = "";

    /**
     * Fail URL to be used on during checkout
     */
    private $timeout_limit = 0;

     /**
     * Sets the payment to be received through the API
     */
    private $currency = "";

    /**
     * PayTR offers us 3 different payment methods,
     * you can shape these adjustments according to the numbers above.
     * The document URLs of the required payment method are as follows.
     *
     * 0 => https://dev.paytr.com/direkt-api
     * 1 => https://dev.paytr.com/link-api
     * 2 => https://dev.paytr.com/iframe-api
     *
     * default payment method is iFrame (2)
     *
     * support: 0 => direct, 1 => link, 2 => iFrame
     */
    private $api_type = 2;

    /**
    * Used for additional personalized settings
    */
    private $custom_config;

    /**
    * API URL
    */
    private $api_url;


    public function __construct()
    {
        $this->merchant_id = config("paytr.merchant_id");
        $this->merchant_key = config("paytr.merchant_key");
        $this->merchant_salt = config("paytr.merchant_salt");
        $this->max_installment = config("paytr.max_installment");
        $this->no_installment = config("paytr.no_installment");
        $this->test_mode = config("paytr.test_mode");
        $this->debug_on = config("paytr.debug_on");
        $this->non_3d = config("paytr.non_3d");
        $this->lang = config("paytr.lang");
        $this->merchant_ok_url = config("paytr.merchant_ok_url");
        $this->merchant_fail_url = config("paytr.merchant_fail_url");
        $this->timeout_limit = config("paytr.timeout_limit");
        $this->currency = config("paytr.currency");
        $this->api_type = config("paytr.api_type");
        $this->custom_config = null;
        $this->api_url = config("paytr.api_url");
    }

    public function getMerchantId(): int
    {
        return $this->merchant_id;
    }

    public function getMerchantKey(): string
    {
        return $this->merchant_key;
    }

    public function getMerchantSalt(): string
    {
        return $this->merchant_salt;
    }

    public function getMaxInstallment(): int
    {
        return $this->max_installment;
    }

    public function getNoInstallment(): int
    {
        return $this->no_installment;
    }

    public function getTestMode(): int
    {
        return $this->test_mode;
    }

    public function getDebugOn(): int
    {
        return $this->debug_on;
    }

    public function getNon3D(): int
    {
        return $this->non_3d;
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function getMerchantOkUrl(): string
    {
        return $this->merchant_ok_url;
    }

    public function getMerchantFailUrl(): string
    {
        return $this->merchant_fail_url;
    }

    public function getTimeoutLimit(): int
    {
        return $this->timeout_limit;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getApiType(): int
    {
        return $this->api_type;
    }

    public function getApiUrl(): string
    {
        return $this->api_url;
    }

    public function setMerchantId(int $merchantId)
    {
        $this->merchant_id = $merchantId;

        return $this;
    }

    public function setMerchantKey(string $merchantKey)
    {
        $this->merchant_key = $merchantKey;

        return $this;
    }

    public function setMerchantSalt(string $merchantSalt)
    {
        $this->merchant_salt = $merchantSalt;

        return $this;
    }

    public function setMaxInstallment(int $maxInstallment)
    {
        $this->max_installment = $maxInstallment;

        return $this;
    }

    public function setNoInstallment(int $noInstallment)
    {
        $this->no_installment = $noInstallment;

        return $this;
    }

    public function setTestMode(int $testMode)
    {
        $this->test_mode = $testMode;

        return $this;
    }

    public function setDebugOn(int $debugOn)
    {
        $this->debug_on = $debugOn;

        return $this;
    }

    public function setNon3D(int $non3D)
    {
        $this->non_3d = $non3D;

        return $this;
    }

    public function setLang(string $lang)
    {
        $this->lang = $lang;

        return $this;
    }

    public function setMerchantOkUrl(string $merchantOkUrl)
    {
        $this->merchant_ok_url = $merchantOkUrl;

        return $this;
    }

    public function setMerchantFailUrl(string $merchantFailUrl)
    {
        $this->merchant_fail_url = $merchantFailUrl;

        return $this;
    }

    public function setTimeoutLimit(int $timeoutLimit)
    {
        $this->timeout_limit = $timeoutLimit;

        return $this;
    }

    public function setCurrency(string $currency)
    {
        $this->currency = $currency;

        return $this;
    }

    public function setApiType(string $apiType)
    {
        $this->api_type = $apiType;

        return $this;
    }

    public function setCustomConfig(array $customConfig)
    {
        $this->custom_config = $customConfig;

        return $this;
    }

    public function setApiUrl(string $apiUrl)
    {
        $this->api_url = $apiUrl;

        return $this;
    }

    public function toArray()
    {
        $data = Arr::except(get_object_vars($this), [
            'api_url'
            , 'custom_config'
            , 'api_type'
            , 'merchant_key'
            , 'merchant_salt'
        ]);

        return $data;
    }
}
