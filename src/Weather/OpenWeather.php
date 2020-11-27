<?php

namespace arts19\Weather;

/**
  * A class for OpenWeatherMap.
  *
  * @SuppressWarnings(PHPMD)
  */
class OpenWeather
{
    /**
     * Constructor to initiate an OpenWeather object,
     *
     * @param string $userinput
     *
     */

    public function __construct(string $weatherkey, string $lat, string $long)
    {
        $this->weatherkey = $weatherkey;
        $this->lat = $lat;
        $this->long = $long;
    }

    public function currentweather() : array
    {
        $ch = curl_init();
        $url = "https://api.openweathermap.org/data/2.5/weather?lat=" . $this->lat . "&lon=" . $this->long . "&appid=" . $this->weatherkey . "&units=metric&lang=se";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $apiresponse = curl_exec($ch);

        $jsonresp = json_decode($apiresponse, JSON_UNESCAPED_UNICODE);
        return $jsonresp;
    }

    public function forecast() : array
    {
        $ch = curl_init();
        $url = "https://api.openweathermap.org/data/2.5/onecall?lat=" . $this->lat . "&lon=" . $this->long . "&exclude=minutely,hourly&appid=" . $this->weatherkey . "&units=metric&lang=se";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $apiresponse = curl_exec($ch);

        $jsonresp = json_decode($apiresponse, JSON_UNESCAPED_UNICODE);
        return $jsonresp;
    }

    public function historicweather() : array
    {
        $days = $this->generateTimestamps();
        $result = [];
        $mh = curl_multi_init();
        for ($i = 0; $i < count($days); $i++) {
            $ch = curl_init();
            $url = "https://api.openweathermap.org/data/2.5/onecall/timemachine?lat=" . $this->lat . "&lon=" . $this->long .  "&dt=" . $days[$i]. "&appid=" . $this->weatherkey . "&units=metric&lang=se";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $apiresponse = curl_exec($ch);
            $jsonresp = json_decode($apiresponse, JSON_UNESCAPED_UNICODE);
            $result[] = $jsonresp;
            curl_close ($ch);
        }
        return $result;
    }

    private function generateTimestamps($timestamp = null) : array
    {
        if (!$timestamp) {
            $timestamp = time();
        }
        $day = 60*60*24;
        $result = array();
        for ($i = 0; $i < 5; $i++) {
            $timestamp -= $day;
            array_push($result, $timestamp);
        }
        return $result;
    }
}
