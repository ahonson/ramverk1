<?php
/**
 * Configuration file for DI container.
 */
return [
    "services" => [
        "curl" => [
            "shared" => true,
            "callback" => function () {
                $url = new \arts19\Curl\Curl();
                return $url;
            }
        ],
    ],
];
