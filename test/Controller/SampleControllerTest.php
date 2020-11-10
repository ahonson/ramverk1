<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class SampleControllerTest extends TestCase
{
    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $controller = new SampleController();
        $controller->initialize();
        $res = $controller->indexAction();
        $this->assertContains("db is active", $res);
    }


    /**
     * Test the route "info".
     */
    public function testInfoActionGet()
    {
        $controller = new SampleController();
        $controller->initialize();
        $res = $controller->infoActionGet();
        $this->assertContains("db is active", $res);
    }


    /**
     * Test the route "dump-di".
     */
    public function testDumpDiActionGet()
    {
        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // Setup the controller
        $controller = new SampleController();
        $controller->setDI($di);
        $controller->initialize();

        // Do the test and assert it
        $res = $controller->dumpDiActionGet();
        $this->assertContains("di contains", $res);
        $this->assertContains("configuration", $res);
        $this->assertContains("request", $res);
        $this->assertContains("response", $res);
    }

    /**
     * Test the route "create action".
     */
    public function testCreateActionGet()
    {
        $controller = new SampleController();
        $controller->initialize();
        $res = $controller->createActionGet();
        $this->assertContains("db is active", $res);
    }

    /**
     * Test the route "create action".
     */
    public function testCreateActionPost()
    {
        $controller = new SampleController();
        $controller->initialize();
        $res = $controller->createActionPost();
        $this->assertContains("db is active", $res);
    }

    /**
     * Test the route "argument action".
     */
    public function testArgumentActionGet()
    {
        $controller = new SampleController();
        $controller->initialize();
        $res = $controller->argumentActionGet(12);
        $this->assertContains("got argument", $res);
    }

    /**
     * Test the route "default argument action".
     */
    public function testDefaultArgumentActionGet()
    {
        $controller = new SampleController();
        $controller->initialize();
        $res = $controller->defaultArgumentActionGet();
        $this->assertContains("got argument", $res);
    }

    /**
     * Test the route "typed argument action".
     */
    public function testTypedArgumentActionGet()
    {
        $controller = new SampleController();
        $controller->initialize();
        $res = $controller->typedArgumentActionGet("", 0);
        $this->assertContains("got string argument", $res);
    }

    /**
     * Test the route "variadic action".
     */
    public function testVariadicActionGet()
    {
        $controller = new SampleController();
        $controller->initialize();
        $res = $controller->variadicActionGet("", 0);
        $this->assertContains("arguments", $res);
    }

    /**
     * Test the route "catch all".
     */
    public function testCatchAllActionGet()
    {
        $controller = new SampleController();
        $controller->initialize();
        $res = $controller->catchAll("", 0);
        $this->assertNull($res);
    }
}
