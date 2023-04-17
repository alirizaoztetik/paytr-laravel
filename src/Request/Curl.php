<?php

namespace PayTR\Request;


class Curl
{
    static public function request($data, $url)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);

        if(preg_match('/<\s?[^\>]*\/?\s?>/i', $result)){
            $error = explode('{"status":"failed","reason":"', $result);
            $error = explode('"}', $error[1]);
            throw new \Error(__METHOD__ . '(): An unexpected problem has occurred. (' . $error[0] . ') '. __FILE__ .' on line ' . __LINE__);
        }

        if(curl_errno($curl))
            throw new \Error(__METHOD__ . '(): ' . curl_error($curl) . __FILE__ .' on line ' . __LINE__);

        curl_close($curl);

        $result = json_decode($result);

        if(isset($result) && !is_object($result))
            throw new \Error(__METHOD__ . '(): ' . $result . ' ' . __FILE__ .' on line ' . __LINE__);

        $response = $result;

        return $response;
    }
}
