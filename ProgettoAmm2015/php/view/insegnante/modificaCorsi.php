<h2>Modifica Corso N. <?= $mod_corso->getCodice() ?></h2>
<div class="input-form" id="modificaCorsi">
    <form method="post" action="index.php?page=admin&subpage=corsi_modifica<?= $vd->scriviToken('?')?>">
        <input type="hidden" name="corso" value="<?= $mod_corso->getCodice() ?>"/>
        <label for="nomeCorso">Nome</label><br>
        <input type="text" name="nomeCorso" id="nomeCorso" value="<?= $mod_corso->getNome() ?>"/>
        <br/>
        <label for="descrizione">Descrizione</label><br>
        <input type="text" name="descrizione" id="descrizione" value="<?= $mod_corso->getDescrizione() ?>"/>
        <br/>
        <label for="durata">Durata</label><br>
        <input type="text" name="durata" id="durata" value="<?= $mod_corso->getDurata() ?>"/>
        <br/>
        <label for="orario">Orario Lezioni</label><br>
        <input type="text" name="orario" id="orario" value="<?= $mod_corso->getOrario() ?>"/>
        <br/>
        <label for="NMax">Partecipanti Massimi</label><br>
        <input type="text" name="NMax" id="NMax" value="<?= $mod_corso->getNMax() ?>"/>
        <br/>
        <label for="prezzo">Prezzo</label><br>
        <input type="text" name="prezzo" id="prezzo" value="<?= $mod_corso->getPrezzo() ?>"/>
        <br/>
        <div class="save">
            <button type="submit" name="cmd" value="salva">Salva</button>
        </div>
    </form>
</div>