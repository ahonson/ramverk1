<?php
/**
 * IP controller.
 */
return [
    "routes" => [
        [
            "info" => "Weather service",
            "mount" => "weather",
            "handler" => "\arts19\Weather\WeatherController",
        ],
    ]
];
