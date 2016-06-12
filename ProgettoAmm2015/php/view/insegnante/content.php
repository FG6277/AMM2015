<?php
switch ($vd->getSottoPagina()) {
    case 'sicurezza':
        include 'impostazioniSicurezza.php';
        break;
        
    case 'corsi':
        include 'corsi.php';
        break;
    
    case 'corsi_modifica':
        include 'modificaCorsi.php';
        break;
    
    case 'lista_iscritti':
        include 'listaIscritti.php';
        break;
   
    case 'aggiungi_iscrizione':
        include 'aggiungiIscrizione.php';
        break;
    
    case 'aggiungi_corso':
        include 'aggiungiCorso.php';
        break;
    
    case 'aggiungi_utente':
        include 'aggiungiUtente.php';
        break;
       
    default:
?>
        <h2 id="benvenuto"><strong> Welcome <?= $user->getNome() ?> <?= $user->getCognome() ?> !</strong></h2>
        <article class="contenuto">
        <h3>Impostazioni</h3>
        <ul>
            <li id="aggiungiS"><a href="index.php?page=admin&subpage=aggiungi_utente<?= $vd->scriviToken('?')?>"><strong>Aggiungi uno Studente</strong></a></li>
            <li id="aggiungiI"><a href="index.php?page=admin&subpage=aggiungi_iscrizione<?= $vd->scriviToken('?')?>"><strong>Iscrivi uno Studente</strong></a></li>
            <li id="aggiungiC"><a href="index.php?page=admin&subpage=aggiungi_corso<?= $vd->scriviToken('?')?>"><strong>Aggiungi un Corso</strong></a></li>
            <li id="corsi"><a href="index.php?page=admin&subpage=corsi<?= $vd->scriviToken('?')?>"><strong>I Tuoi Corsi</strong></a></li>
            <li id="iscritti"><a href="index.php?page=admin&subpage=lista_iscritti<?= $vd->scriviToken('?')?>"><strong>Iscritti</strong></a></li>
            <li id="sicurezza"><a href="index.php?page=admin&subpage=sicurezza<?= $vd->scriviToken('?')?>"><strong>Impostazioni di Sicurezza</strong></a></li>     
        </ul>
        </article>
        <article class="profilo">
        <h3>Profilo</h3>
        <form class="input-form" method="post" action="index.php?page=admin&subpage=profilo<?= $vd->scriviToken('?')?>">
        <input type="hidden" name="cmd" value="dati_personali"/>
        <label for="datan"><strong> Data di nascita: </strong></label><br>
        <input type="text" name="DataNascita" id="datan" value="<?= $user->getDataNascita() ?>"/>
        <br/>
        <label for="cod"><strong>Codice Fiscale:</strong></label><br>
        <input type="text" name="CodiceFiscale" id="cod" value="<?= $user->getCodiceFiscale() ?>"/>
        <br/>
        <label for="email"><strong>Email:</strong></label><br>
        <input type="text" name="Email" id="email" value="<?= $user->getEmail() ?>"/>
        <br/>
        <input type="submit" value="Salva"/>
        </form>
        </article>
        <?php
        break;
}
?>
