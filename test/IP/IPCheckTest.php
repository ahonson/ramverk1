<?php

namespace arts19\IP;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class IPCheckTest extends TestCase
{
    /**
     * IPCheck
     */
    public function testIpv6()
    {
        $ipcheck = new IPCheck("4::5");
        $res = $ipcheck->ipv6();
        $this->assertTrue($res);
    }

    /**
     * IPCheck
     */
    public function testPrintIPMessage()
    {
        $ipcheck = new IPCheck("4::5");
        $res = $ipcheck->printIPMessage();
        $this->assertIsString($res);
    }

    /**
     * IPCheck
     */
    public function testPrintDomainMessage()
    {
        $ipcheck = new IPCheck("4::5");
        $res = $ipcheck->printDomainMessage();
        $this->assertIsString($res);
    }

    /**
     * IPCheck
     */
    public function testSetDomainName()
    {
        $ipcheck = new IPCheck("2620:0:2d0:200::7");
        $res = $ipcheck->setDomainName();
        $this->assertNull($res);
    }
}
