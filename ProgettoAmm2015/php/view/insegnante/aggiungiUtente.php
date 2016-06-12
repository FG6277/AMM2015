<h2>Aggiungi Studente</h2>
<div class="input-form" id="aggiungiStudente">
            <h3>Anagrafica Studente</h3>
                <form method="post" action="index.php?page=admin&subpage=home<?= $vd->scriviToken('?')?>">
                <input type="hidden" name="cmd" value="aggiungi_utente"/>
                <label for="id">ID Studente</label><br>
                <input type="text" name="id" id="id" />
                <br>
                <label for="nome">Nome</label><br>
                <input type="text" name="Nome" id="nome" />
                <br/>
                <label for="cognome">Cognome</label><br>
                <input type="text" name="Cognome" id="cognome" />
                <br/>
                <label for="datan">Data di nascita*</label><br>
                <input type="text" name="DataNascita" id="datan" />
                <br/>
                <label for="mail">Email</label><br>
                <input type="email" name="Email" id="mail" /> 
                <br/>
                <label for="telefono">Telefono</label><br>
                <input type="text" name="Telefono" id="telefono" />
                <br/>
                <label for="username">Username</label><br>
                <input type="text" name="username" id="username" />
                <br/>
                <label for="pass">Password</label><br>
                <input type="password" name="password" id="pass" />        
                <br><br>
                <input type="submit" value="Salva"/>
        <p>* Le date devono essere scritte nel formato (aaaa-mm-gg)</p>            
    </form>
</div>
