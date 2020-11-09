<?php

namespace Anax\View;

?>

<h1>Another page</h1>

<p>Here is the result.</p>

<!-- <?= $currentip ?> -->

<?php

$newip6 = [];
if ($currentip) {
    $mymy = explode(":", $currentip);
    $missing = 8 - count($mymy); // IPv6 has eight 16bit blocks
    // var_dump($mymy);
    for ($i=0; $i < count($mymy); $i++) {
        // echo "This is my number: " . str_pad($mymy[$i], 4, "0", STR_PAD_LEFT) . "<br>";
        array_push($newip6, str_pad($mymy[$i], 4, "0", STR_PAD_LEFT));
        if ($mymy[$i] === "") {
            for ($j=0; $j < $missing; $j++) {
                array_push($newip6, str_pad($mymy[$i], 4, "0", STR_PAD_LEFT));
            }
        }
    }
    $newip6str = implode(":", $newip6);
} else {
    $newip6str = "";
}

$ipv4 = "/^(([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])$/";

$ipv6 = "/^(([0-9]|[a-f]|[A-F]){4}:){7}([0-9]|[a-f]|[A-F]){4}$/";
$pattern = "/[a-z]/";

echo "Den inmatade strängen ($currentip) validerar ";

if (preg_match($ipv4, $currentip)) {
    echo "enligt IPv4.<br>";
    // if (gethostbyaddr($currentip)) {
    if (gethostbyaddr($currentip) !== $currentip) {
        echo "Det tillhörande domännamnet är " . gethostbyaddr($currentip);
    } else {
        echo "Men inget domännamn har hittats.";
    }
} elseif (preg_match($ipv6, $newip6str)) {
    echo "enligt IPv6.<br>";
    // if (gethostbyaddr($currentip)) {
    if (gethostbyaddr($currentip) !== $currentip) {
        echo "Det tillhörande domännamnet är " . gethostbyaddr($currentip);
    } else {
        echo "Men inget domännamn har hittats.";
    }
} else {
    echo "inte så det finns inget domännamn att visa.";
}

 ?>
