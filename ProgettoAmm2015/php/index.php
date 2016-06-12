<?php
 
/*inclusione dei controller*/
 include_once 'controller/BaseController.php';
 include_once 'controller/ControlloUtente.php';
 include_once 'controller/ControlloInsegnante.php';

 date_default_timezone_set("Europe/Rome");
 
 FrontController::dispatch($_REQUEST);
 
 /*Gestione del punto unico di accesso*/
 class FrontController {
     
    public static function dispatch(&$request) {
        // Inizio Sessione
        session_start();
        if (isset($request["page"])) {

            switch ($request["page"]) {
                //la pagina di login è comune all'utente e all'insegnante
                case 'login':
                    //viene gestita dal controllo principale (BaseController)
                    $controllo = new BaseController();
                    $controllo->gestioneInput($request);
                    break;
                
                //la pagina dell'utente è accessibile solo agli studenti
                case 'utente':
                    //viene gestita dal controllo dell'utente (ControlloUtente)
                    $controllo = new ControlloUtente();
                    if (isset($_SESSION[BaseController::ruolo]) && $_SESSION[BaseController::ruolo] != User::Utente) {}
                    $controllo->gestioneInput($request);
                    break;
               
                 //la pagina dell'admin è accessibile solo agli insegnanti
                case 'admin':
                    //viene gestita dal controllo dell'insegnante (ControlloInsegnante)
                    $controllo = new ControlloInsegnante();
                    if (isset($_SESSION[BaseController::ruolo]) && $_SESSION[BaseController::ruolo] != User::Insegnante) {}
                    $controllo->gestioneInput($request);
                    break;
                
                // se la pagina e' inesistente mandiamo un messaggio di errore
                default:
                    echo 'La pagina a cui si cerca di accedere &egrave; inesistente';
                    break;
           }
        } 
        
        else {echo 'Non riesco ad accedere alla pagina!';}
    }
 }
?>


