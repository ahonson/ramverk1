<?php

namespace arts19\IP;

use PHPUnit\Framework\TestCase;

/**
 * testing for IPGeotag
 * @SuppressWarnings(PHPMD)
 */
class IPGeotagTest extends TestCase
{
    /**
     * IPGeotag
     */
    public function testGetmap()
    {
        include(__DIR__ . '/../../config/api/ipstack.php');
        $geoip = new IPGeotag($apikey);
        $res = $geoip->getmap("567");
        $this->assertIsString($res);
    }

    /**
     * IPGeotag
     */
    public function testPrintmap()
    {
        include(__DIR__ . '/../../config/api/ipstack.php');
        $geoip = new IPGeotag($apikey);
        $res = $geoip->printmap("34.5", "19.5");
        $this->assertIsString($res);
    }


    /**
     * IPGeotag
     */
    public function testcheckuserip()
    {
        include(__DIR__ . '/../../config/api/ipstack.php');
        $geoip = new IPGeotag($apikey);
        $res = $geoip->checkuserip();
        $this->assertIsArray($res);
    }

    /**
     * IPGeotag
     */
    public function testparseJson()
    {
        include(__DIR__ . '/../../config/api/ipstack.php');
        $geoip = new IPGeotag($apikey);
        $res = $geoip->parseJson("94.21.49.200", "location", "capital");
        $this->assertIsString($res);
    }

    /**
     * IPGeotag
     */
    public function testcheckinputip()
    {
        include(__DIR__ . '/../../config/api/ipstack.php');
        $geoip = new IPGeotag($apikey);
        $res = $geoip->checkinputip("694.21.49.200");
        $this->assertIsString($res);
    }
}
