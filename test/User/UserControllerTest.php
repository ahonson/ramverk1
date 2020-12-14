<?php

namespace artes\User;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;

/**
 * Testclass.
 */
class UserControllerTest extends TestCase
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
     * Test the route "index".
     */
    public function testIndexActionGet()
    {
        // Setup the controller
        $controller = new UserController();
        $controller->setDI($this->di);

        // Test the controller action
        $res = $controller->indexActionGet();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "login".
     */
    public function testLoginAction()
    {
        // Setup the controller
        $controller = new UserController();
        $controller->setDI($this->di);

        // Test the controller action
        $res = $controller->loginAction();
        // $body = $res->getBody();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }

    /**
     * Test the route "create".
     */
    public function testCreateAction()
    {
        // Setup the controller
        $controller = new UserController();
        $controller->setDI($this->di);

        // Test the controller action
        $res = $controller->createAction();
        // $body = $res->getBody();
        $this->assertInstanceOf(ResponseUtility::class, $res);
    }
}
