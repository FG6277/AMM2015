<h2>Lista iscritti ai corsi <br>
di <?= $user->getNome() ?> <?= $user->getCognome() ?> </h2>

<?php if (count($corsi) > 0) { ?>
    <table>
        <thead>
            <tr>
                <th>Corso</th>   
                <th>Numero iscritti</th> 
                <th>Iscritti</th>  
            </tr>
        </thead>
        <tbody>
            <?php
            $k = 0;
            foreach ($corsi as $corso) {
                
                    ?>
                    <tr <?= $k % 2 == 0 ? 'class="alt-row"' : '' ?>>
                        <td><?= $corso->getNome() ?></td>
                        <td><?= count($corso->getIscritti()) ?></td>
                        <?php if(count($corso->getIscritti()) != 0 ) {?>
                            <td>
                             <?php
                             foreach ($corso->getIscritti() as $utente) {
                                ?>
                                <?= $utente->getCognome() ?> <?= $utente->getNome()?>
                               <?php
                                echo "<br>" ?>
                                
                                <?php
                             }
                            ?>
                            </td>
                        <?php } 
                        else { ?>
                            <td> Nessuno </td>
                        <?php } ?>
                            
                    </tr>
                    <?php
                    $k++;    
            }
            ?>
        </tbody>
       
    </table>
<?php } else { ?>
    <p class="messaggio"> Nessun corso disponibile </p>
<?php } ?>


