<?php

namespace Anax\Controller;

namespace arts19\Weather;

// use Anax\Commons\AppInjectableInterface;
// use Anax\Commons\AppInjectableTrait;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Route\Exception\NotFoundException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD)
 */
class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");

        $page->add(
            "weather/index"
        );

        return $page->render([
            "title" => "Weather",
        ]);
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexActionPost() : object
    {
        $response = $this->di->get("response");
        $request = $this->di->get("request");
        $userip = $request->getPost("userip");
        $longitud = $request->getPost("longitud");
        $latitud = $request->getPost("latitud");
        $ip = $this->di->get("ip");
        if ($ip->validip($userip)) {
            echo $userip . " is valid";
        } else {
            echo $userip . " is invalid";
        }
        die();
        return $response->redirect("ip");
    }
}
