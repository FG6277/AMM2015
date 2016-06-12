<?php

include_once basename(__DIR__) . '/../view/ViewDescriptor.php';
include_once basename(__DIR__) . '/../model/UserFactory.php';

class BaseController {

    const user = 'user';
    const ruolo = 'ruolo';
    const nessuno = '_nessuno';
    
    public function __construct() {}
    
    /*Gestione input*/
    public function gestioneInput(&$request) {
      
        $vd = new ViewDescriptor();
        
        $vd->setPagina($request['page']);

        $this->setImpostaToken($vd, $request);
        
        if (isset($request["cmd"])) {
            switch ($request["cmd"]) {
                //Mi trovo nella pagina del login
                case 'index.php?page=login':
                    $this->showLogin($vd);
                    //credenziali
                    $username = isset($request['user']) ? $request['user'] : '';
                    $password = isset($request['password']) ? $request['password'] : '';
                    //login
                    $this->login($vd, $username, $password);
                
                    //inizializzazione dell'utente che ha effettuato il login
                    if($this->loggedIn()) {
                        $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::ruolo]);
                    }
                    
                    break;
                default : $this->showLogin($vd);
            }
        } else {
            if ($this->loggedIn()) {
                $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::ruolo]);
                $this->showHomeUtente($vd);
            } else {
             
                $this->showLogin($vd);
            }
        }
        
     require basename(__DIR__) . '/../view/master.php';
    }
    
    /*Mostra la pagina dell'utente o la pagina dell'amministratore, a seconda del ruolo impostato*/
    protected function showHomeUtente($vd) {
        
        $user = UserFactory::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::ruolo]);
        switch ($user->getRuolo()) {
            // se il ruolo è "utente"
            case User::Utente:
                // mostro la pagina dell'utente
                $this->showUtente($vd);
                break;
            // se il ruolo è "insegnante"
            case User::Insegnante:
                // mostro la pagina dell'insegnante
                $this->showInsegnante($vd);
                break;
        }
    }
    
    /*Mostra la pagina dell'utente (Funzione chiamata da showHomeUtente)*/
    protected function showUtente($vd) {
        $vd->setTitolo(" Utente ");
        $vd->setMenu(basename(__DIR__) . '/../view/utente/menu.php');
        $vd->setNav(basename(__DIR__) . '/../view/utente/navigazione.php');
        $vd->setRightBar(basename(__DIR__) . '/../view/utente/rightBar.php');
        $vd->setContent(basename(__DIR__) . '/../view/utente/content.php');
    }

    /*Mostra la pagina dell'insegnante (Funzione chiamata da showHomeUtente)*/
    protected function showInsegnante($vd) {
        $vd->setTitolo(" Insegnante ");
        $vd->setMenu(basename(__DIR__) . '/../view/insegnante/menu.php');
        $vd->setNav(basename(__DIR__) . '/../view/insegnante/navigazione.php');
        $vd->setRightBar(basename(__DIR__) . '/../view/insegnante/rightBar.php');
        $vd->setContent(basename(__DIR__) . '/../view/insegnante/content.php');
    }
    
    /*Mostra la pagina di login*/
    protected function showLogin($vd) {
        $vd->setTitolo("Scuola di Lingue Login");
        $vd->setMenu(basename(__DIR__) . '/../view/login/menu.php');
        $vd->setNav(basename(__DIR__) . '/../view/login/navigazione.php');
        $vd->setRightBar(basename(__DIR__) . '/../view/login/rightBar.php');
        $vd->setContent(basename(__DIR__) . '/../view/login/content.php');       
    }
    
    /*Verifica che le credenziali $password e $username siano associate ad un utente esistente*/
    protected function login($vd, $username, $password) {
        
        $user = UserFactory::instance()->caricaUtente($username, $password);
        if (isset($user) && $user->esiste()) {
            $_SESSION[self::user] = $user->getId();
            $_SESSION[self::ruolo] = $user->getRuolo();
            $this->showHomeUtente($vd);
        } else {
            // utente inesistente, mostro la pagina di login
            echo '<p class="error">Utente sconosciuto o password errata</p>';
            $this->showLogin($vd);
        }
    }
    
    /*Controllo sessione attiva*/
    protected function loggedIn() {
        return isset($_SESSION) && array_key_exists(self::user, $_SESSION);
    }
    
    /*Funzione che termina la sessione*/
    protected function logout($vd) {

        $_SESSION = array();
        if (session_id() != '' || isset($_COOKIE[session_name()])) {
            
            setcookie(session_name(), '', time() - 2592000, '/');
        }
        session_destroy();
        
        // sessione terminata, mostro pagina login
        $this->showLogin($vd);
    }
    
    /*Funzione che imposta il token*/
    protected function setImpostaToken(ViewDescriptor $vd, &$request) {

        if (array_key_exists('_nessuno', $request)) {
            $vd->setImpostaToken($request['_nessuno']);
        }
    }
}

?>


