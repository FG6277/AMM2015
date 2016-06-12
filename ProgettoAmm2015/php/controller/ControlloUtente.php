<?php

include_once 'BaseController.php';

class ControlloUtente extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function gestioneInput(&$request) {

        $vd = new ViewDescriptor();

        $vd->setPagina($request['page']);

        $this->setImpostaToken($vd, $request);

        if (!$this->loggedIn()) {
            
            $this->showLogin($vd);
        } 
        else {
            $user = UserFactory::instance()->cercaUtentePerId($_SESSION[BaseController::user], $_SESSION[BaseController::ruolo]);
            $corsiCodice;
                    
            if (isset($request["subpage"])) {
                //switch sottopagine
                switch ($request["subpage"]) {
                   
                    // impostazioni di sicurezza
                    case 'sicurezza':
                        $vd->setSottoPagina('sicurezza');
                        //funzionalità ajax
                        $vd->addScript("../ajax/jquery-2.1.4.min.js");
                        $vd->addScript("../ajax/Validazione.js");
                        break;
                    
                    //lista di tutti i corsi della scuola
                    case 'listaCorsi':
                        $lista = CorsiFactory::instance()->listaCorsi();
                        $vd->setSottoPagina('listaCorsi');
                        break;
                    
                    // lista corsi seguiti dall'utente
                    case 'corsiSeguiti':
                        $corsi = CorsiFactory::instance()->corsiPerUtente($user);
                        $vd->setSottoPagina('corsiSeguiti');
                        break;
                    
                    default:
                        $vd->setSottoPagina('home');
                        break;
                }
            }
            
            if (isset($request["cmd"])) {
                //switch commandi
                switch ($request["cmd"]) {

                    case 'logout':
                        $this->logout($vd);
                        break;

                    case 'cambia_sicurezza':
                        if (isset($_POST['salva']) && $_POST['salva'] == "Salva") {
                            include_once basename(__DIR__) . '../../../ajax/Sicurezza.php';
                            $users = new Sicurezza();
                            unset($_POST['salva']);
                            $aggiornaSicurezza = $users->aggiornaSicurezza($user, $_POST);
                            if($aggiornaSicurezza !== true) {
                                echo "$aggiornaSicurezza";
                            }
                        }
                        
                        $this->showHomeUtente($vd);
                        break;
                    
                    // aggiorno i dati personali dell'utente
                    case 'dati_personali': 
                        $this->aggiornaUtente($user, $request);
                        $this->showHomeUtente($vd);
                        break;

                    default : $this->showLogin($vd);
                         
                }
            } else {
                    $user = UserFactory::instance()->cercaUtentePerId($_SESSION[BaseController::user], $_SESSION[BaseController::ruolo]);
                    $this->showHomeUtente($vd);
                }
        }
        require basename(__DIR__) . '/../view/master.php';
    }
    
    /*Aggiorno i dati personali dell'utente*/
    protected function aggiornaUtente($user, &$request) {

        if (isset($request['DataNascita'])) {
            $user->setDataNascita($request['DataNascita']);
        }
        
        if (isset($request['Telefono'])) {
            $user->setTelefono($request['Telefono']);
        }
        
        if (isset($request['Email'])) {
            $user->setEmail($request['Email']);
        }
        
        UserFactory::instance()->salva($user);
        
    }
    
}

?>
