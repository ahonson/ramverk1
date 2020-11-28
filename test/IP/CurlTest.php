<?php

namespace arts19\Curl;

use PHPUnit\Framework\TestCase;

/**
 * testing for Curl
 * @SuppressWarnings(PHPMD)
 */
class CurlTest extends TestCase
{
    /**
     * IPGeotag
     */
    public function testCurl()
    {
        $curl = new Curl();
        $url = "http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipapi/check?ip=8.8.8.8";
        $res = $curl->curl($url);
        $this->assertIsArray($res);
    }
}
