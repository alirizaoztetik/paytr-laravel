<?php

namespace PayTR\Enums;

enum System
{
    /**
     * support: CURL, HTTP
     */
    public const REQUEST_METHOD = ['Curl', 'Http'];

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
    public const API_TYPE = [0, 1, 2];

    /**
     * Array of parameters to generate the required hash for the IFRAME method
     */
    public const IFRAME_HASH_DATA = [
        'merchant_id',
        'user_ip',
        'merchant_oid',
        'email',
        'payment_amount',
        'user_basket',
        'no_installment',
        'max_installment',
        'currency',
        'test_mode'
    ];

    /**
     * Array of parameters to generate the required hash for the DIRECT method
     */
    public const DIRECT_HASH_DATA = [
        'merchant_id',
        'user_ip',
        'merchant_oid',
        'email',
        'payment_amount',
        'payment_type',
        'installment_count',
        'currency',
        'test_mode',
        'non_3d'
    ];

    /**
     * Array of parameters to generate the required hash for the LINK method
     */
    public const LINK_HASH_DATA = [
        'name',
        'price',
        'currency',
        'max_installment',
        'link_type',
        'lang'
    ];
}
