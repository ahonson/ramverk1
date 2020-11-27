<?php

namespace arts19\Weather;

/**
  * A class for validating weather parameters.
  *
  * @SuppressWarnings(PHPMD)
  */
class ValidAPIWeather
{
    /**
     * Constructor to initiate an ValidWeather object,
     *
     * @param string $userinput
     *
     */

    public function __construct(object $userinput, object $ip)
    {
        $this->latitud = $userinput->getGet("lat", null);
        $this->longitud = $userinput->getGet("lon", null);
        $this->userip = $userinput->getGet("ip", null);
        $this->ip = $ip;
    }

    private function missinginput() : bool
    {
        if ($this->userip || ($this->latitud && $this->longitud)) {
            return false;
        }
        return true;
    }

    private function validip() : bool
    {
        return $this->ip->validip($this->userip);
    }

    private function validcoord() : bool
    {
        if (is_numeric($this->longitud) && is_numeric($this->latitud)) {
            if (abs($this->latitud) <= 90 && abs($this->longitud) <= 180) {
                return true;
            }
        }
        return false;
    }

    public function errormsg() : string
    {
        if ($this->missinginput()) {
            $msg = "Missing input. Try again";
        } elseif (!$this->validip() && !$this->validcoord()) {
            $msg = "Invalid query parameters. Try again";
        } else {
            $msg = "";
        }
        return $msg;
    }
}
