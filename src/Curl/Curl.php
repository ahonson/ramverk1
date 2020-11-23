<?php

namespace arts19\Curl;

/**
  * A class for curl requests
  *
  * @SuppressWarnings(PHPMD)
  */
class Curl
{
    /**
     *
     * @param string $url
     *
     */

    public function curl($url) : array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $apiresponse = curl_exec($ch);

        $jsonresp = json_decode($apiresponse, JSON_UNESCAPED_UNICODE);
        return $jsonresp;
    }
}
