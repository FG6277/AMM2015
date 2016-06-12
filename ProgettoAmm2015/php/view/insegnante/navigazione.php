<nav id="navigazioneI">
    <a class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>" href="index.php?page=admin&subpage=home<?= $vd->scriviToken('?')?>">Home</a>
    <a class="<?= $vd->getSottoPagina() == 'sicurezza' ? 'current_page_item' : '' ?>" href="index.php?page=admin&subpage=sicurezza<?= $vd->scriviToken('?')?>">Sicurezza</a>
    <a class="<?= $vd->getSottoPagina() == 'corsi' ? 'current_page_item' : '' ?>" href="index.php?page=admin&subpage=corsi<?= $vd->scriviToken('?')?>">Corsi</a>
    <a class="<?= strpos($vd->getSottoPagina(),'lista_iscritti') !== false ? 'current_page_item' : '' ?>" href="index.php?page=admin&subpage=lista_iscritti<?= $vd->scriviToken('?')?>">Lista iscritti</a>
    <a class="<?= strpos($vd->getSottoPagina(),'aggiungi_utente') !== false ? 'current_page_item' : '' ?>" href="index.php?page=admin&subpage=aggiungi_utente<?= $vd->scriviToken('?')?>">Aggiungi uno Studente</a>
    <a class="<?= strpos($vd->getSottoPagina(),'aggiungi_iscrizione') !== false ? 'current_page_item' : '' ?>" href="index.php?page=admin&subpage=aggiungi_iscrizione<?= $vd->scriviToken('?')?>">Iscrivi uno Studente</a>
    <a class="<?= strpos($vd->getSottoPagina(),'aggiungi_corso') !== false ? 'current_page_item' : '' ?>" href="index.php?page=admin&subpage=aggiungi_corso<?= $vd->scriviToken('?')?>">Aggiungi un Corso</a>
    <a href="#segnalibro">Contatti</a>
    <a class="logout" href="index.php?page=admin&cmd=logout">Logout</a> 
</nav>
