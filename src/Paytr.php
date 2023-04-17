<?php

namespace PayTR;

use Illuminate\Support\Arr;
use PayTR\Enums\System;
use PayTR\Request;

class Paytr extends Request
{

   /**
     * @param config array optional
     * set this config and requestMethod data.
     */
    public $config;

    /**
     * @param hashData array required
     * It is required for the creation of paytr_token, it depends on the api type.
     */
    public $hash_data;

    /**
     * @param token array required
     * Used for token required for api initialization
     */
    public $token;


    public function __construct(object $config)
    {
        $this->config = $config;
    }

    public function setHashStr(array $hash_data)
    {
        if($this->config->getApiType() == 0){
            foreach(System::DIRECT_HASH_DATA as $parameter) {
                if(!array_key_exists($parameter, $hash_data)){
                    throw new \InvalidArgumentException(__METHOD__ . '(): missing parameter ( '. $parameter .' ). '. __FILE__ .' on line ' . __LINE__);
                }
            }
        }

        if($this->config->getApiType() == 1){
            foreach(System::LINK_HASH_DATA as $parameter) {
                if(!array_key_exists($parameter, $hash_data)){
                    throw new \InvalidArgumentException(__METHOD__ . '(): missing parameter ( '. $parameter .' ). '. __FILE__ .' on line ' . __LINE__);
                }
            }
        }

        if($this->config->getApiType() == 2){
            foreach(System::IFRAME_HASH_DATA as $parameter) {
                if(!array_key_exists($parameter, $hash_data)){
                    throw new \InvalidArgumentException(__METHOD__ . '(): missing parameter ( '. $parameter .' ). '. __FILE__ .' on line ' . __LINE__);
                }
            }
        }

        $this->hash_data = collect($hash_data)->implode('');

        return $this;
    }

    public function getToken()
    {
        $hash = $this->hash_data . $this->config->getMerchantSalt();
        $key = $this->config->getMerchantKey();

        $this->token = base64_encode(hash_hmac('sha256', $hash, $key, true));

        return $this;
    }
}
