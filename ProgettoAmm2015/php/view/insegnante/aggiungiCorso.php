<h2>Aggiungi Corso</h2>
<div class="input-form" id="aggiungiCorso">
                <form method="post" action="index.php?page=admin&subpage=home<?= $vd->scriviToken('?')?>">
                <input type="hidden" name="cmd" value="aggiungi_corsi"/>
                <label for="nome">Nome</label><br>
                <input type="text" name="Nome" id="nome" />
                <br/>
                <label for="descrizione">Descrizione</label><br>
                <input type="text" name="Descrizione" id="descrizione" />
                <br/>
                <label for="durata">Durata</label><br>
                <input type="text" name="Durata" id="durata" />
                <br/>
                <label for="orario">Orario</label><br>
                <input type="text" name="OrarioLezioni" id="orario" /> 
                <br/>
                <label for="nmax">Partecipanti Massimi</label><br>
                <input type="text" name="NMax" id="nmax" />
                <br/>
                <label for="prezzo">Prezzo</label><br>
                <input type="text" name="Prezzo" id="prezzo" />
        <input type="submit" value="Salva"/>           
    </form>
</div>

