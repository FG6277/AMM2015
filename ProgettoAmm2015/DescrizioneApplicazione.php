<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Descrizione dell'applicazione</title>
        <link href="css/layout1.css" rel="stylesheet" type="text/css" media="screen"> 
    </head>
    <body>
        <div id="pagina">
        <header>
            <h1>Become International Scuola di Lingue</h1>
            <h2>Descrizione dell'Applicazione</h2>
        </header>
        
        <article>
        <p> L'applicazione gestisce le iscrizioni ai corsi di una scuola di lingue: <br>
        </p>
            <ol>
                <li>Ogni corso è tenuto da un insegnante madrelingua</li>
                <li>Ogni corso ha un numero massimo di partecipanti</li>
                <li>Le iscrizioni ai corsi vengono effettuate dagli insegnanti</li>
                <li>Nuovi corsi possono essere aggiunti dagli insegnanti</li>
            </ol>
        </article>
        <article>
        <p>
            L'applicazione ha due ruoli: <b> utente</b> e <b> insegnante</b>.
            <br>
            Il ruolo <b>utente</b> rappresenta uno studente della scuola. Autenticandosi con questo ruolo è possibile:<br>
        </p>
       
            <ol>
                <li>Accedere al profilo personale e modificarne i dati</li>
                <li>Accedere alle impostazioni di sicurezza (password e username) e modificarle</li>
                <li>Visualizzare le informazioni relative ai corsi seguiti dall'utente autenticato e non.</li>
            </ol>
        
        <p>
            Il ruolo <b>insegnante</b> rappresenta un insegnante madrelingua che insegna uno o piu' corsi.
            Autenticandosi con questo ruolo è possibile:<br>
        </p>
        
            <ol>
                 <li>Accedere al profilo personale e modificarne i dati</li>
                 <li>Accedere alle impostazioni di sicurezza (password e username) e modificarle</li>
                 <li>Accedere ai corsi gestiti dall'insegnante autenticato e modificarne gli attributi.</li>
                 <li>Accedere alla lista degli iscritti ai corsi tenuti dall'insegnante autenticato</li>
                 <li>Aggiungere un corso (transazione).</li>
                 <li>Aggiungere un utente e iscriverlo ad uno dei corsi tenuti dall'insegnante autenticato (transazione).</li>
            </ol>
        </article>

        
        <p>
            Si può passare da un ruolo all'altro attraverso <b> logout </b> e sucessivo <b> login</b>.
        </p>
        <br>
        
        <h3>Requisiti soddisfatti</h3>
        
            <ol>
                <li>Utilizzo di HTML e CSS</li>
                <li>Utilizzo di PHP e MySQL</li>
                <li>Utilizzo del pattern MVC</li>
                <li>Due ruoli (utente e insegnante)</li>
                <li>Funzionalità Ajax (per la validazione nella modifica delle credenziali di accesso)</li>
                <li>Utilizzo di codice JS anche per lo slider di immagini presente nella pagina di login</li>
                <li>Transazioni:
                    <ul> 
                        <li>aggiunta di uno studente</li>  
                        <li>iscrizione di uno studente ad un corso</li>
                        <li>aggiunta di un nuovo corso </li>
                    </ul>
            </ol>
        <br>
        
        <h3>Credenziali di autenticazione</h3>
            <ul>
                <li>Per il ruolo utente:
                    <ul>
                        <li> username: std01</li>
                        <li> password: Progetto2015</li>
                    </ul>
                <li>Per il ruolo insegnante:
                    <ul>
                        <li> username: tchr01</li>
                        <li> password: Progetto2015</li>
                    </ul>
            </ul>
        <br>
        <h3> Link utili</h3>
        <p> <strong> Homepage</strong> </p>
        <ul>
            <li> <a href="http://spano.sc.unica.it/amm2015/gerinaFederica/ProgettoAmm2015/php/index.php?page=login" target="_blank">http://spano.sc.unica.it/amm2015/gerinaFederica/ProgettoAmm2015/php/index.php?page=login</a></li>
        </ul>
        
        <p> <strong> Repository GIT</strong> </p>
        <ul>
            <li><a href="https://github.com/FG6277/AMM2015/blob/master/ProgettoAmm2015" target="_blank">https://github.com/FG6277/AMM2015/blob/master/ProgettoAmm2015</a></li>
        </ul>
        </div>
    </body>
</html>