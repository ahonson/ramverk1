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
    public function indexActionGet() : object
    {
        $page = $this->di->get("page");
        $data = [
            "ip" => "127.0.0.1"
        ];

        $page->add(
            "ip/index",
            $data
        );

        return $page->render([
            "title" => "My IP",
        ]);
    }

    public function newpageActionGet() : object
    {
        $session = $this->di->get("session");
        $page = $this->di->get("page");
        $page->add(
            "ip/newpage",
            [
                "currentip" => $session->get("userip"),
                "mount" => "ip/newpage"
            ]
        );

        return $page->render([
            "title" => "My new IP",
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
        // echo "MOST";
        // die("VÉGE");
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $session = $this->di->get("session");

        $userip = $request->getPost("userip");
        $session->set("userip", $userip);

        return $response->redirect("ip/newpage");
    }
}
