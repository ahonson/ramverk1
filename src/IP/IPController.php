<?php

namespace Anax\Controller;
namespace arts19\IP;

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
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IPController implements ContainerInjectableInterface
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
    public function indexAction() : object
    {
        $page = $this->di->get("page");
        $data = [
            "mount" => "ip/",
            "player" => "Erik"
        ];

        $page->add(
            "ip/index",
            $data
        );

        return $page->render([
            "title" => "My IP",
        ]);
    }

    public function newpageAction() : object
    {
        $page = $this->di->get("page");
        $page->add(
            "ip/newpage",
            [
                "mount" => "ip/newpage"
            ]
        );

        return $page->render([
            "title" => "My new IP",
        ]);
    }


    public function redirectpageAction() : object
    {
        $response = $this->di->get("response");

        return $response->redirect("ip");
    }
}
