<h2>Corsi per<br>
<?= $user->getNome() ?> <?= $user->getCognome() ?>
</h2>

<?php if (count($corsi) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrizione corso</th>
                <th>Durata</th>
                <th>Partecipanti massimi</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($corsi as $corso) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?>>
                    <td><?= $corso->getNome() ?></td>
                    <td><?= $corso->getDescrizione() ?></td>
                    <td><?= $corso->getDurata() ?></td>
                    <td><?= $corso->getNMax() ?></td>
                    <td>
                        <a id="modifica" href="index.php?page=admin&subpage=corsi_modifica&corso=<?= $corso->getCodice() ?><?= $vd->scriviToken('&') ?>" title="Modifica corso">Modifica</a>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <p class="messaggio">Nessun corso presente</p>
<?php } ?>

