<?php  ?>

<h1>IP validator</h1>

<p>Den här sidan som är byggd med hjälp av en kontrollerklass (di-style) visar om den inmatade IP-adressen validerar eller ej och enligt vilket format. Även det tillhörande domännamnet visas (om det finns).</p>

<form class="" action="ip/newpage" method="post">
    <label for="">Mata in en IP-adress enligt IP4 eller IP6: </label>
    <input type="text" name="" value=""><br>
</form>

<p><?= $player ?></p>
