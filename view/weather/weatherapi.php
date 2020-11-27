<h1>Väder-API</h1>
<p>Det här är ett API som presenterar väderinformation från <a href="https://openweathermap.org/">OpenWeatherMaps</a>. Användaren kan söka på giltiga IP-adresser (både IPv4 och IPv6) eller geografiska koordinater. API:et klarar av både GET och POST anrop enligt specifikationen nedan.</p>


<h2>GET</h2>
<p><strong>Exempel1</strong>: GET /info?</p>
<a href="http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weatherapi/info?">http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weatherapi/info?</a>
<p><strong>Resultat</strong></p>
<pre>{
    "msg":"Missing input. Try again"
}</pre>

<p><strong>Exempel2</strong>: GET /info?ip=345.456.43.2</p>
<a href="http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weatherapi/info?ip=345.456.43.2">http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weatherapi/info?ip=345.456.43.2</a>
<p><strong>Resultat</strong></p>
<pre>{
    "msg":"Invalid query parameters. Try again"
}</pre>

<p><strong>Exempel3</strong>: GET /info?ip=8.8.8.8</p>
<a href="http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weatherapi/info?ip=8.8.8.8">http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weatherapi/info?ip=8.8.8.8</a>
<p><strong>Resultat</strong></p>
<pre>{
    "coord":{
        "lon":-122.07,
        "lat":37.39
    },
    "weather":[
        {
            "id":801,
            "main":"Clouds",
            "description":"lätt molnighet",
            "icon":"02d"
        }
    ],
    "base":"stations",
    "main":{
        "temp":17.36,
        "feels_like":13.89,
        "temp_min":15.56,
        "temp_max":18.89,
        "pressure":1023,
        "humidity":20
    },
    "visibility":10000,
    "wind":{
        "speed":1.11,
        "deg":335
    },
    "clouds":{
        "all":20
    },
    "dt":1606511965,
    "sys":{
        "type":1,
        "id":5845,
        "country":"US",
        "sunrise":1606489252,
        "sunset":1606524708
    },
    "timezone":-28800,
    "id":5375480,
    "name":"Mountain View",
    "cod":200
}</pre>

<p><strong>Exempel4</strong>: GET /info?lat=47.95&lon=20.08</p>
<a href="http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weatherapi/info?lat=47.95&lon=20.08">http://www.student.bth.se/~arts19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weatherapi/info?lat=47.95&lon=20.08</a>
<p><strong>Resultat</strong></p>
<pre>{
    "coord":{
        "lon":20.08,
        "lat":47.95
    },
    "weather":[
        {
            "id":804,
            "main":"Clouds",
            "description":"mulet",
            "icon":"04n"
        }
    ],
    "base":"stations",
    "main":{
        "temp":0.56,
        "feels_like":-2.09,
        "temp_min":0.56,
        "temp_max":0.56,
        "pressure":1024,
        "humidity":92
    },
    "visibility":10000,
    "wind":{
        "speed":0.83,
        "deg":237
    },
    "clouds":{
        "all":92
    },
    "dt":1606512363,
    "sys":{
        "type":3,
        "id":2001376,
        "country":"HU",
        "sunrise":1606457016,
        "sunset":1606488696
    },
    "timezone":3600,
    "id":717758,
    "name":"Mátraderecske",
    "cod":200
}</pre>
