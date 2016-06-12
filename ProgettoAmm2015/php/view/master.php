<?php
include_once 'ViewDescriptor.php';
?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8">
            <title><?= $vd->getTitolo() ?></title>
            <meta name="description" content="Pagina master per la gestione login dei due ruoli">
            <link href="../css/layout.css" rel="stylesheet" type="text/css" media="screen"> 
            <?php
            foreach ($vd->getScripts() as $script) {
                ?>
                <script type="text/javascript" src="<?= $script ?>"></script>
                <?php
            }
            ?>
        </head>
        <body>
            <div id="pagina">
                <header>
                    <div id="header">
                        
                        <div id="logo">
                            <h1></h1>
                        </div>
                        
                        <select class="menu">
                            <?php
                            $Menu1 = $vd->getMenu();
                            require "$Menu1";
                            ?>
                        </select>
                        
                        <div id="menu">
                            <?php
                            $menu = $vd->getMenu();
                            require "$menu";
                            ?>
                        </div>
                    </div>                    
                </header>
                                    
                <div id="nav">
                    <?php
                     $nav = $vd->getNav();
                     require "$nav";
                     ?>   
                </div>
                <div id="sidebar2">
                    <?php
                    $right = $vd->getRightBar();
                    require "$right";
                    ?>
                </div>
                <div id="content">
                    <?php
                    $content = $vd->getContent();
                    require "$content";
                    ?>
                </div>
                <footer>
                    <div id="footer">
                        <hr/>
                        <p><strong>Become International Academy - Scuola di Lingue</strong></p>
                            <br/><br/>
                                <a id ="segnalibro">
                                <p id="contatti">
                                    <b> Sede: </b> Via Dante 25, Cagliari<br/>
                                    <b> Tel: </b>  0781 456 432 <br/>
                                    <b> Cell: </b> 123 4589 678 <br/>
                                    <b> E-mail: </b> biacademy@gmail.com <br/>
                                </p>
                                </a>
                                <p id="social">
                                    <b>Facebook: </b><a href='https://www.facebook.com' target="_blank">www.facebook.com</a><br/>
                                    <b> Twitter: </b><a href='https://www.twitter.com' target="_blank">www.twitter.com</a><br/><br/>
                                </p>
                    </div>
                </footer>
            </div>
        </body>
    </html>
 


