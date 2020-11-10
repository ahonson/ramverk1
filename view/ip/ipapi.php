<h1>IP-API</h1>
<p>Det här är ett API som validerar IP-adresser, både enligt IPv4 och IPv6, och letar upp det tillhörande domännamnet. API:et klarar av både GET och POST anrop enligt specifikationen nedan.</p>
<p>Förkortade IPv6-adresser omvandlas till det långa formatet ("corrected") innan valideringen utförs.</p>

<h2>GET</h2>
<pre></pre>
<p><strong>Exempel1</strong>: GET /check?ip=8.8.8.8</p>
<a href="http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipapi/check?ip=8.8.8.8">http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipapi/check?ip=8.8.8.8</a>
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

<p><strong>Exempel2</strong>: GET /check?ip=345.213.12.23</p>
<a href="http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipapi/check?ip=345.213.12.23">http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ipapi/check?ip=345.213.12.23</a>
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

<h2>POST</h2>
<p><strong>Exempel1</strong>: POST /check</p>
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
<form class="" action="ipapi/check" method="post">
    <input size="40" type="text" name="ip" value="2012::456:567:23"><br><br>
    <input type="submit" name="save" value="Testa">
</form>
