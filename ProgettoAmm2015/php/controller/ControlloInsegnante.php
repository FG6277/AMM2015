<?php

include_once 'BaseController.php';
include_once basename(__DIR__) . '/../model/CorsiFactory.php';

class ControlloInsegnante extends BaseController {

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
                    
                    // corsi tenuti dall'insegnante
                    case 'corsi':
                        $corsi = CorsiFactory::instance()->corsiPerInsegnante($user);
                        $vd->setSottoPagina('corsi');
                        break;
                    
                    // modifica dati di un corso
                    case 'corsi_modifica':
                        $corsi = CorsiFactory::instance()->corsiPerInsegnante($user);
                        $mod_corso = $this->getCorso($request);
                        if (!isset($mod_corso)) {
                            $vd->setSottoPagina('corsi');
                        } else {
                            $vd->setSottoPagina('corsi_modifica');
                        }
                        break;
                    
                    // iscritti ai corsi tenuti dall'insegnante
                    case 'lista_iscritti':
                        $corsi = CorsiFactory::instance()->corsiPerInsegnante($user);
                        $vd->setSottoPagina('lista_iscritti');
                        break;
                    
                    // aggiungo un'iscrizione
                    case 'aggiungi_iscrizione': 
                        $corsi = CorsiFactory::instance()->corsiPerInsegnante($user);
                        $vd->setSottoPagina('aggiungi_iscrizione');                
                        break;
                    
                    case 'aggiungi_utente': 
                        $vd->setSottoPagina('aggiungi_utente');                
                        break;
                    
                    case 'aggiungi_corso': 
                        $vd->setSottoPagina('aggiungi_corso');                
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

                    // cambio username e password
                    case 'cambia_sicurezza':
                        if (isset($_POST['salva']) && $_POST['salva'] == "Salva") {
                            include_once basename(__DIR__) . '../../../ajax/Sicurezza.php';
                            $users = new Sicurezza();
                            unset($_POST['salva']);
                            // aggiorno la sicurezza
                            $aggiornaSicurezza = $users->aggiornaSicurezza($user, $_POST);
                            // stampo a video eventuali errori
                            if($aggiornaSicurezza !== true) {
                                echo "$aggiornaSicurezza";
                            }
                        }
                        
                        $this->showHomeUtente($vd);
                        break;
                    
                        // aggiorno i dati personali dell'utente
                    case 'dati_personali': 
                        $this->aggiornaInsegnante($user, $request);
                        $this->showHomeUtente($vd);
                        
                        break;
                    
                    // aggiungo un utente e lo iscrivo ad un corso
                    case 'aggiungi_iscrizione':
                        $corsi = CorsiFactory::instance()->corsiPerInsegnante($user);
                        IscrizioneFactory::instance()->addIscrizione($request);
                        $this->showHomeUtente($vd);
                        break;
                    
                     // aggiungo un utente e lo iscrivo ad un corso
                    case 'aggiungi_corsi':
                        CorsiFactory::instance()->addCorso($user,$request);
                        $this->showHomeUtente($vd);
                        break;
                    
                    case 'aggiungi_utente':
                        UserFactory::instance()->addUtente($request);
                        $this->showHomeUtente($vd);
                        break;
                    
                    // modifico i dati di un corso
                    case 'modifica':
                        $corsi = CorsiFactory::instance()->corsiPerInsegnante($user);
                        if (isset($request['corso'])) {
                            $valore = filter_var($request['corso'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                            if (isset($valore)) {
                                $mod_corso = $this->cercaCorsoPerCodice($valore, $corsi);
                            }
                        }
                        $this->showHomeUtente($vd);
                        break;
                    
                    // salvataggio
                    case 'salva':
                        if (isset($request['corso'])) {
                            $valore = filter_var($request['corso'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                            if (isset($valore)) {
                                $mod_corso = $this->cercaCorsoPerCodice($valore, $corsi);
                                $this->aggiornaCorso($mod_corso, $request);
                                if (CorsiFactory::instance()->salva($mod_corso) != 1) {
                                   echo '<p class="messaggio">Impossibile modificare il corso</p>';
                                }
                            }
                        } else {
                           echo '<p class="messaggio">Specificare corso</p>';
                        }
                        
                        $this->showHomeUtente($vd);
                        break;
                    
                    default:
                        $this->showHomeUtente($vd);
                        break;
                }// fine switch comando
            } else {
                $user = UserFactory::instance()->cercaUtentePerId($_SESSION[BaseController::user], $_SESSION[BaseController::ruolo]);
                $this->showHomeUtente($vd);
            }
        }
        
        require basename(__DIR__) . '/../view/master.php';
    }
    
    /*Aggiorna i dati di un insegnante*/
    protected function aggiornaInsegnante($user, &$request) {
         
        if (isset($request['DataNascita'])) {
            $user->setDataNascita($request['DataNascita']);
        }
        
        if (isset($request['CodiceFiscale'])) {
            $user->setCodiceFiscale($request['CodiceFiscale']);
        }

        if (isset($request['Email'])) {
            $user->setEmail($request['Email']);
        }

        UserFactory::instance()->salva($user);
        
    }
    
    /*Aggiorno i dati di un corso*/
    private function aggiornaCorso($mod_corso, &$request) {
        
        if (isset($request['nomeCorso'])) {
            $mod_corso->setNome($request['nomeCorso']);
        }

        if (isset($request['descrizione'])) {
            $mod_corso->setDescrizione($request['descrizione']);
        }

        if (isset($request['durata'])) {
            $mod_corso->setDurata($request['durata']);
        }

        if (isset($request['NMax'])) {
            $mod_corso->setNMax($request['NMax']);
        }

        if (isset($request['prezzo'])) {
            $mod_corso->setPrezzo($request['prezzo']);
        }

        if (isset($request['orario'])) {
            $mod_corso->setOrario($request['orario']);
        }
    }
    
    /*Ricerca di un corso*/
    private function getCorso(&$request) {
        if (isset($request['corso'])) {
            $corso_codice = filter_var($request['corso'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
            $corso = CorsiFactory::instance()->cercaCorsoPerCodice($corso_codice);
            if ($corso == null) {
                echo '<p class="messaggio">Corso non corretto</p>';
            }
            return $corso;
        } else {
            return null;
        }
    }
    
    /*Ricerca un corso dato il codice*/
    private function cercaCorsoPerCodice($codice, &$corsi) {
        foreach ($corsi as $corso) {
            if ($corso->getCodice() == $codice) {
                return $corso;
            }
        }
        return null;
    }
}
?>




