<?php
/**
 * Configuration file for DI container.
 */
return [
    "services" => [
        "ip" => [
            "shared" => true,
            "callback" => function () {
                $ip = new \arts19\IP\IP();
                return $ip;
            }
        ],
    ],
];
