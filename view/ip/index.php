<?php

namespace Anax\View;

?>

<h1>IP validator</h1>

<p>Den här sidan som är byggd med hjälp av en kontrollerklass (di-style) visar om den inmatade IP-adressen validerar eller ej och enligt vilket format. Även det tillhörande domännamnet visas (om det finns).</p>

<form class="" action="" method="post">
    <label for="">Mata in en IP-adress enligt IPv4 eller IPv6: </label><br><br>
    <input size="40" type="text" name="userip" value="" autofocus><br><br>
    <input type="submit" name="save" value="Validera">
</form>

<h2>IP-API</h2>
<p>Förkortade IPv6-adresser omvandlas till det långa formatet ("corrected") innan valideringen utförs.</p>

<h3>GET</h3>
<pre></pre>
<p><strong>Exempel1</strong></p>
<a href="http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipapi?ip=8.8.8.8">http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipapi?ip=8.8.8.8</a>
<p><strong>Resultat</strong></p>
<pre>{
    "ip4":true,
    "ip6":false,
    "userinput":"8.8.8.8",
    "corrected":"8.8.8.8",
    "domain":"dns.google",
    "ipmsg":"Den inmatade strängen (8.8.8.8) validerar enligt IPv4.",
    "domainmsg":"Det tillhörande domännamnet är dns.google."
}</pre>

<p><strong>Exempel2</strong></p>
<a href="http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipapi?ip=345.213.12.23">http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipapi?ip=345.213.12.23</a>
<p><strong>Resultat</strong></p>
<pre>{
    "ip4":false,
    "ip6":false,
    "userinput":"345.213.12.23",
    "corrected":"345.213.12.23",
    "domain":"",
    "ipmsg":"Den inmatade strängen (345.213.12.23) validerar inte.",
    "domainmsg":"Det finns inget domännamn att visa."
}</pre>

<h3>POST</h3>
<p><strong>Exempel1</strong></p>
<p>Body: {"ip": "2012::456:567:23"}</p>
<p><strong>Resultat</strong></p>
<pre>{
    "ip4":false,
    "ip6":true,
    "userinput":"2012::456:567:23",
    "corrected":"2012:0000:0000:0000:0000:0456:0567:0023",
    "domain":"",
    "ipmsg":"Den inmatade strängen (2012::456:567:23) validerar enligt IPv6.",
    "domainmsg":"Men inget domännamn har hittats"
}</pre>

<p><strong>Egna exempel</strong></p>
<form class="" action="ipapi" method="post">
    <input size="40" type="text" name="ip" value="2012::456:567:23" autofocus><br><br>
    <input type="submit" name="save" value="Testa">
</form>
