<?php
/**
 * IP API controller.
 */
return [
    "routes" => [
        [
            "info" => "Väder - API",
            "mount" => "weatherapi",
            "handler" => "\arts19\Weather\WeatherAPIController",
        ],
    ]
];
