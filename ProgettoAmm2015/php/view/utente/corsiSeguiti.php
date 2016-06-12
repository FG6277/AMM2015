<h2>Corsi Seguiti</h2>

<?php if (count($corsi) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th>Nome Corso</th>
                <th>Descrizione</th>
                <th>Durata Corso</th>
                <th>Orario Lezioni</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $k = 0;
            foreach ($corsi as $corso) {
                    ?>
                    <tr <?= $k % 2 == 0 ? 'class="alt-row"' : '' ?>>
                        <td><?= $corso->getNome() ?></td>
                        <td><?= $corso->getDescrizione() ?></td>
                        <td><?= $corso->getDurata() ?></td>
                        <td><?= $corso->getOrario() ?></td> 
                    </tr>
                    <?php
                    $k++;
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <p class="messaggio"> Nessun corso presente </p>
<?php } ?>

