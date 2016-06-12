<nav id="navigazione">
    <a class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : ''?>" href="index.php?page=admin&subpage=home<?= $vd->scriviToken('?')?>">Home</a>
    <a class="<?= $vd->getSottoPagina() == 'sicurezza' ? 'current_page_item' : '' ?>" href="index.php?page=utente&subpage=sicurezza<?= $vd->scriviToken('?')?>">Sicurezza</a>
    <a class="<?= $vd->getSottoPagina() == 'corsiSeguiti' ? 'current_page_item' : '' ?>" href="index.php?page=utente&subpage=corsiSeguiti<?= $vd->scriviToken('?')?>">Corsi seguiti</a>
    <a class="<?= $vd->getSottoPagina() == 'listaCorsi' ? 'current_page_item' : '' ?>"href="index.php?page=utente&subpage=listaCorsi<?= $vd->scriviToken('?')?>">Lista Corsi</a>
    <a href="#segnalibro">Contatti</a>
    <a class="logout" href="index.php?page=admin&cmd=logout">Logout</a> 
</nav>

