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
class IPAPIController implements ContainerInjectableInterface
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
            "ip/ipapi"
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
    public function checkActionGet() : array
    {
        $request = $this->di->get("request");
        $ip  = $request->getGet("ip", "");
        $userip = new IPCheck($ip);
        $ip4 = $userip->ipv4();
        $ip6 = $userip->ipv6();
        $userinput = $userip->getUserInput();
        $corrected = $userip->getCorrectedInput();
        $domain = $userip->getDomainName();
        $ipmsg = $userip->printIPMessage();
        $domainmsg = $userip->printDomainMessage();

        $myjson = [
            "ip4" => $ip4,
            "ip6" => $ip6,
            "userinput" => $userinput,
            "corrected" => $corrected,
            "domain" => $domain,
            "ipmsg" => $ipmsg,
            "domainmsg" => $domainmsg
        ];

        return [json_encode($myjson, JSON_UNESCAPED_UNICODE)];
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function checkActionPost() : array
    {
        $request = $this->di->get("request");
        $ip  = $request->getPost("ip", "");
        $userip = new IPCheck($ip);
        $ip4 = $userip->ipv4();
        $ip6 = $userip->ipv6();
        $userinput = $userip->getUserInput();
        $corrected = $userip->getCorrectedInput();
        $domain = $userip->getDomainName();
        $ipmsg = $userip->printIPMessage();
        $domainmsg = $userip->printDomainMessage();

        $myjson = [
            "ip4" => $ip4,
            "ip6" => $ip6,
            "userinput" => $userinput,
            "corrected" => $corrected,
            "domain" => $domain,
            "ipmsg" => $ipmsg,
            "domainmsg" => $domainmsg
        ];

        return [json_encode($myjson, JSON_UNESCAPED_UNICODE)];
    }
}
