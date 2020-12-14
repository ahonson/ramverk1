<?php

namespace artes\Book\HTMLForm;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Testclass.
 */
class DeleteFormTest extends TestCase
{
    // Create the di container.
    protected $di;

    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        // Use a different cache dir for unit test
        $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $this->di = $di;
    }

    /**
     * Test the route "callbackSubmit".
     */
    // public function testCallbackSubmit()
    // {
    //     // Setup the controller
    //     $controller = new CreateForm($this->di);
    //     // $controller->setDI($this->di);
    //
    //     // Test the controller action
    //     $res = $controller->callbackSubmit();
    //     $this->assertTrue($res);
    // }

    /**
     * Test the route "index".
     */
    public function testCallbackSuccess()
    {
        // Setup the controller
        $controller = new DeleteForm($this->di);
        // $controller->setDI($this->di);

        // Test the controller action
        $res = $controller->callbackSuccess();
        $this->assertNull($res);
    }
}
