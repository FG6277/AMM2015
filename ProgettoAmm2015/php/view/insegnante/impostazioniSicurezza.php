<h2>Impostazioni di Sicurezza</h2>
<div class="input-form" id="impostazioniSicurezza">
        <form id="form" method="post" action="index.php?page=admin&subpage=home<?= $vd->scriviToken('&')?>">
           <input type="hidden" name="cmd" value="cambia_sicurezza"/>
           <label for="usr">Nuovo Username</label><br>
           <input type="text" class="check" name="username" id="usr"/><br>
            <span id="username"></span>
            <br/>
            <label for="pw">Nuova Password</label><br>
            <input type="password" class="check" name="password" id="pw"/><br>
            <span id="password"></span>
            <br/>
            <input type="submit" id="submit" name="salva" value="Salva"/>
        </form>
</div>