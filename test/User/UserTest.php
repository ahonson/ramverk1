<?php

namespace artes\User;

use Anax\DI\DIFactoryConfig;
use Anax\Response\ResponseUtility;
use PHPUnit\Framework\TestCase;
use Anax\DatabaseQueryBuilder\DatabaseQueryBuilder;

/**
  * A class for validating weather parameters.
  *
  * @SuppressWarnings(PHPMD)
  */
class UserTest extends TestCase
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
     * User
     */
    public function testSetPassword()
    {
        $user = new User();
        $res = $user->setPassword("pass123");
        $this->assertNull($res);
    }


    public function testVerifyPassword()
    {
        $user = new User();
        $dbqb = new DatabaseQueryBuilder();
        $dbqb->setOption("dsn", "sqlite:" . ANAX_INSTALL_PATH . "/data/db.sqlite");
        $dbqb->setDefaultsFromConfiguration();
        $user->setDb($dbqb);
        $res = $user->verifyPassword("Sara", "pass123");
        $this->assertFalse($res);
    }
}
