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
    public function initAction() : object
    {
        $response = $this->di->get("response");
        $session = $this->di->get("session");
        $session->set("userip", null);
        return $response->redirect("ip");
    }

    private function getRealIpAddr(){
     if ( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
      // Check IP from internet.
      $ip = $_SERVER['HTTP_CLIENT_IP'];
     } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
      // Check IP is passed from proxy.
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
     } else {
      // Get IP address from remote address.
      $ip = $_SERVER['REMOTE_ADDR'];
     }
     return $ip;
    }

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
        // this loads $apikey
        include('../config/api/ipstack.php');
        $page = $this->di->get("page");
        $session = $this->di->get("session");

        // $ipaddress = $_SERVER['REMOTE_ADDR'];
        $ipaddress = $this->getRealIpAddr();
        $input = $session->get("userip") ? $session->get("userip") : "";

        $userip = new IPCheck($input);
        $ipmsg = $userip->printAllMessages();
        $inputgeotag = new IPGeotag($apikey);
        $inputgeoinfo = $inputgeotag->checkinputip($input);
        // $usergeoinfo = $inputgeotag->checkuserip();
        $iptotest = $input ? $input : $ipaddress;
        $usergeoinfo = $inputgeotag->checkdefaultip($iptotest);

        $data = [
            "usergeoinfo" => $usergeoinfo,
            "inputgeoinfo" => $inputgeoinfo,
            "ipmsg" => $ipmsg
        ];

        $page->add(
            "ip/index",
            $data
        );

        return $page->render([
            "title" => "My IP",
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
        $request = $this->di->get("request");
        $response = $this->di->get("response");
        $session = $this->di->get("session");

        $userip = $request->getPost("userip");
        $session->set("userip", $userip);

        return $response->redirect("ip");
    }
}
