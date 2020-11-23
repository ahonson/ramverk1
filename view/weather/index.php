<?php

namespace Anax\View;

?>

<h1>Vädertjänst med historik och prognos</h1>

<p>Donnerwetter</p>

<p><a href="weatherapi">Klicka här för att komma till Väder-API:et.</a></p>

<h3>Mata in en IP-adress enligt</h3>
<form class="" action="" method="post">
    <label for="userip">IPv4 eller IPv6: </label><br>
    <input size="40" type="text" name="userip" value="" autofocus><br><br>
    <input type="submit" name="save" value="Sök på IP"><br><br>
</form>

<h3>Mata in geografiska koordinater</h3>
<form class="" action="" method="post">
    <label for="longitud">Longitud: </label><br>
    <input size="20" type="text" name="longitud" value="" autofocus><br><br>
    <label for="latitud">Latitud: </label><br>
    <input size="20" type="text" name="latitud" value="" autofocus><br><br>
    <input type="submit" name="save" value="Sök på koordinater">
</form>
