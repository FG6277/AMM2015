<h2>Iscrizione Studente</h2>
<div class="input-form" id="aggiungiIscrizione">
                <form method="post" action="index.php?page=admin&subpage=home<?= $vd->scriviToken('?')?>">
                <input type="hidden" name="cmd" value="aggiungi_iscrizione"/>
                <label for="codicei">Numero Iscrizione</label><br>
                <input type="text" name="CodiceI" id="codicei" /> 
                <br>
                <label for="id">ID Studente</label><br>
                <input type="text" name="id" id="id" />
                <br>
                <label for="datai">Data iscrizione*</label><br>
                <input type="text" name="DataIscrizione" id="datai" /> 
                <br/><br>
                <label for="corso">Codice Corso</label><br>
                <select name="CodiceCorso" id="corso">
                <?= $c = 0; foreach($corsi as $corso) { ?>
                    <option value="<?= $corso->getCodice() ?>"> <?= $corso->getNome() ?></option>    
                <?= $c++; } ?>    
                </select>
        <br/><br/>
        <input type="submit" value="Salva"/>
        <p>* Le date devono essere scritte nel formato (aaaa-mm-gg)</p>            
    </form>
</div>

