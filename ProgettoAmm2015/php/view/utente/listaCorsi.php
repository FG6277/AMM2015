<h2>Lista Corsi</h2>

<?php if (count($lista) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrizione corso</th>
                <th>Durata</th>
                <th>Orario Lezioni</th>
                <th>Prezzo</th>
                <th>Partecipanti massimi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($lista as $corso) {
                ?>
                <tr <?= $i % 2 == 0 ? 'class="alt-row"' : '' ?>>
                    <td><?= $corso->getNome() ?></td>
                    <td><?= $corso->getDescrizione() ?></td>
                    <td><?= $corso->getDurata() ?></td>
                    <td><?= $corso->getOrario() ?></td>
                    <td><?= $corso->getPrezzo() ?></td>
                    <td><?= $corso->getNMax() ?></td>
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
