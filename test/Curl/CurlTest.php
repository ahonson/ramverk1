<?php

namespace arts19\Curl;

use PHPUnit\Framework\TestCase;

/**
  * A class for validating weather parameters.
  *
  * @SuppressWarnings(PHPMD)
  */
class CurlTest extends TestCase
{
    public function testCurl()
    {
        $mycurl = new Curl();
        $url = "https://rem.dbwebb.se/api/users/1";
        $res = $mycurl->curl($url);
        $this->assertIsArray($res);
    }
}
