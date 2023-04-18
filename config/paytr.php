<?php

use PayTR\Enums\Currency;

return [

    /**
     * API Account Info
     */
    'merchant_id'   => env('PAYTR_MERCANT_ID', "PAYTR_MERCANT_ID"),
    'merchant_key'  => env('PAYTR_MERCANT_KEY', "PAYTR_MERCANT_KEY"),
    'merchant_salt' => env('PAYTR_MERCANT_SALT', "PAYTR_MERCANT_SALT"),

    /**
     * Number of installments
     * support: 0, 2, 3, 4, 5, 6, 7, 8, 9, 10,11,12
     */
    'max_installment' => 0,

    /**
     * If you don't want to be paid in installments, do "1" if you only offer one shot.
     * support: 0, 1
     */
    'no_installment' => 0,

    /**
     * Test can be sent as "1" for action while store is in live mode
     * support: 0, 1
     */
    'test_mode' => 1,

    /**
     * Return an error: If incorrect or incomplete information is sent to PayTR, "1"
     * must be sent to return an error message from the system.
     * support: 0, 1
     */
    'debug_on' => 1,

    /**
     * can be sent to take "1" action
     * support: 0, 1
     */
    'non_3d' => 0,

    /**
     * Language to be used on pages during checkout
     */
    'lang' => 'tr',

    /**
     * Success URL to be used on during checkout
     */
    'merchant_ok_url' => env('PAYTR_OK_URL', "PAYTR_OK_URL"),

    /**
     * Fail URL to be used on during checkout
     */
    'merchant_fail_url' => env('PAYTR_FAIL_URL', "PAYTR_FAIL_URL"),

    /**
     * Process timeout period - in minutes
     */
    'timeout_limit' => 30,

    /**
     * Sets the payment to be received through the API
     */
    'currency' => Currency::TL,

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
    'api_type' => 2,

    /**
     * API URL
     */
    'api_url' => env('PAYTR_API_URL', "PAYTR_API_URL"),


];
