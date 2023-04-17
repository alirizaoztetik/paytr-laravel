<?php

namespace PayTR;

use Illuminate\Support\Arr;
use PayTR\Request\Curl;

class Request
{
    public function call(array $data, string $url)
    {
        $result = Curl::request($data, $url);

        if($result->status != "success"){
            throw new \Error(__METHOD__ . '(): ' . $result->reason . __FILE__ .' on line ' . __LINE__);
        }

        if($this->config->getApiType() == 2){
            $result->javascript_file_url = 'https://www.paytr.com/js/iframeResizer.min.js';
            $result->iframe_code = '<iframe src="https://www.paytr.com/odeme/guvenli/'.$result->token.'" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe>';
            $result->script = "<script>iFrameResize({},'#paytriframe');</script>";
        }

        return $result;
    }
}
