<?php

namespace Anax\Controller;

namespace artes\Weather;

// use Anax\Commons\AppInjectableInterface;
// use Anax\Commons\AppInjectableTrait;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Route\Exception\NotFoundException;
use artes\IP\IPGeotag;
use artes\IP\RealIP;

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
        $realip = new RealIP();
        $ipaddress = $realip->getRealIpAddr();
        $data = [
            "ip" => $ipaddress
        ];
        $page->add(
            "weather/weatherapi",
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
     * @return array
     */
    public function infoActionGet() : array
    {
        return $this->makeJSON();
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return array
     */
    public function infoActionPost() : array
    {
        return $this->makeJSON();
    }

    public function makeJSON()
    {
        $ip = $this->di->get("ip");
        $request = $this->di->get("request");
        $userip  = $request->getGet("ip", "") ?: $request->getPost("userip", "");
        $lon  = $request->getGet("lon", "") ?: $request->getPost("longitud", "");
        $lat  = $request->getGet("lat", "") ?: $request->getPost("latitud", "");
        $type  = $request->getGet("type", "") ?: $request->getPost("type", "");
        $validator = new ValidAPIWeather($request, $ip);
        if ($validator->errormsg()) {
            $myjson = [
                "msg" => $validator->errormsg()
            ];
            return [json_encode($myjson, JSON_UNESCAPED_UNICODE)];
        }
        $alldata = $this->generateData($userip, $lat, $lon, $type);
        $data = $alldata[0];
        if (!(($lat|| $alldata[1]) && ($lon || $alldata[2]))) {
            $msg = [
                "msg" => "No geodata could be detected."
            ];
            return [json_encode($msg, JSON_UNESCAPED_UNICODE)];
        }
        return [json_encode($data, JSON_UNESCAPED_UNICODE)];
    }

    private function generateData($userip, $lat, $lon, $type)
    {
        $ipkey = "";
        $weatherkey = "";
        // this loads $ipkey and $weatherkey
        include(ANAX_INSTALL_PATH . '/config/api/apikeys.php');
        $geotag = new IPGeotag($ipkey);
        if ($userip) {
            $geoinfo = $geotag->checkdefaultip($userip);
            $lat = $geoinfo["latitude"] ?? "";
            $lon = $geoinfo["longitude"] ?? "";
        }
        $data = $this->getWeather($weatherkey, $lat, $lon, $type);
        return [$data, $lat, $lon];
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return array
     */
    public function getWeather($weatherkey, $lat, $lon, $type) : array
    {
        $openweather = new OpenWeather($weatherkey, $lat, $lon);
        if ($type === "historical") {
            $data = $openweather->historicweather();
        } elseif ($type === "forecast") {
            $data = $openweather->forecast();
        } else {
            $data = $openweather->currentweather();
        }
        return $data;
    }
}
