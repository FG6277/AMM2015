<?php
switch ($vd->getSottoPagina()) {
    case 'sicurezza':
        include_once 'impostazioniSicurezza.php';
        break;
    
    case 'corsiSeguiti':
        include_once 'corsiSeguiti.php';
        break;
    
    case 'listaCorsi':
        include_once 'listaCorsi.php';
        break;
    
    default:
        
?>
        <h2 id="benvenuto"><strong> Welcome <?= $user->getNome() ?> <?= $user->getCognome() ?> !</strong></h2>
        <article class="contenuto">
        <h3>Impostazioni</h3>
        <ul class="contenuto">
            <li id="corsi"><a href="index.php?page=utente&subpage=corsiSeguiti<?= $vd->scriviToken('?')?>"><strong>Corsi Seguiti</strong></a></li>
            <li id="lista"><a href="index.php?page=utente&subpage=listaCorsi<?= $vd->scriviToken('?')?>"><strong>Lista Corsi</strong></a></li>
            <li id="sicurezza"><a href="index.php?page=utente&subpage=sicurezza<?= $vd->scriviToken('?')?>"><strong>Impostazioni di Sicurezza</strong></a></li>
        </ul>
        </article>
        <article class="profilo">
        <h3>Profilo</h3>
        <form class="input-form" method="post" action="index.php?page=utente&subpage=profilo<?= $vd->scriviToken('?')?>">
               <input type="hidden" name="cmd" value="dati_personali"/>
               
               <label for="datan"><strong> Data di nascita: </strong></label><br>
               <input type="text" name="DataNascita" id="datan" value="<?= $user->getDataNascita() ?>"/>
               <br>
               <label for="tel"><strong>Telefono:</strong></label><br>
               <input type="text" name="Telefono" id="tel" value="<?= $user->getTelefono() ?>"/>
               <br/>
               <label for="email"><strong>Email:</strong></label><br>
               <input type="text" name="E-Mail" id="email" value="<?= $user->getEmail() ?>"/>
               <br/>
               <input type="submit" value="Salva"/>
        </form>
        </article>
        <?php
        break;
}
?>


