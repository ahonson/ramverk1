<?php

namespace Anax\Controller;

namespace arts19\Weather;

// use Anax\Commons\AppInjectableInterface;
// use Anax\Commons\AppInjectableTrait;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Route\Exception\NotFoundException;
use arts19\IP\IPGeotag;
// use arts19\IP\RealIP;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD)
 */
class WeatherAPIController implements ContainerInjectableInterface
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
            "weather/weatherapi"
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
    public function infoActionGet() : array
    {
        $ip = $this->di->get("ip");
        $request = $this->di->get("request");
        $userip  = $request->getGet("ip", "");
        $lon  = $request->getGet("lon", "");
        $lat  = $request->getGet("lat", "");
        $validator = new ValidAPIWeather($request, $ip);
        if ($validator->errormsg()) {
            $myjson = [
                "msg" => $validator->errormsg()
            ];
            return [json_encode($myjson, JSON_UNESCAPED_UNICODE)];
        }
        // this loads $apikey
        include(__DIR__ . '/../../config/api/ipstack.php');
        // this loads $weatherkey
        include(__DIR__ . '/../../config/api/openweather.php');
        $geotag = new IPGeotag($apikey);
        if ($userip) {
            $geoinfo = $geotag->checkdefaultip($userip);
            $lat = $geoinfo["latitude"];
            $lon = $geoinfo["longitude"];
        }

        $type  = $request->getGet("type", "");
        $openweather = new OpenWeather($weatherkey, $lat, $lon);
        if ($type === "historical") {
            $data = $openweather->historicweather();
        } elseif ($type === "forecast") {
            $data = $openweather->forecast();
        } else {
            $data = $openweather->currentweather();
        }
        return [json_encode($data, JSON_UNESCAPED_UNICODE)];
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function infoActionPost() : array
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

        // this loads $apikey
        include(__DIR__ . '/../../config/api/ipstack.php');
        $geoip = new IPGeotag($apikey);
        $continent = $geoip->parseJson($ip, "continent_name");
        $country = $geoip->parseJson($ip, "country_name");
        $city = $geoip->parseJson($ip, "city");
        $zip = $geoip->parseJson($ip, "zip");
        $language = $geoip->parseJson($ip, "location", "languages", "name");
        $latitude = $geoip->parseJson($ip, "latitude");
        $longitude = $geoip->parseJson($ip, "longitude");
        $map = $geoip->getmap($ip);

        $myjson = [
            "ip4" => $ip4,
            "ip6" => $ip6,
            "userinput" => $userinput,
            "corrected" => $corrected,
            "domain" => $domain,
            "ipmsg" => $ipmsg,
            "domainmsg" => $domainmsg,
            "continent" => $continent,
            "country" => $country,
            "city" => $city,
            "zip" => $zip,
            "language" => $language,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "map" => $map
        ];

        return [json_encode($myjson, JSON_UNESCAPED_UNICODE)];
    }
}
