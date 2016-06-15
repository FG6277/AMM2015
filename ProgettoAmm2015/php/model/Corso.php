<?php

include_once 'User.php';

class Corso {
    
    private $nome;
    private $descrizione;
    private $durata;
    private $nmax;
    private $codice;
    private $utente;
    private $iscritti;
    private $prezzo;
    private $orario;
    
    
    public function __construct() {
        $this->iscritti = array();
    }
    

    public function getCodice() {
        return $this->codice;
    }
    
    public function setCodice($codice) {
        $this->codice = $codice;
    }
    
    
    public function getPrezzo() {
        return $this->prezzo;
    }
    
    public function setPrezzo($prezzo) {
        $this->prezzo = $prezzo;
    }
    
    public function getOrario() {
        return $this->orario;
    }
    
    public function setOrario($orario) {
        $this->orario = $orario;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getDescrizione() {
        return $this->descrizione;
    }

    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;
    }

    public function getDurata() {
        return $this->durata;
    }
    
    public function setDurata($durata) {
        $this->durata = $durata;
    }

    public function getNMax() {
        return $this->nmax;
    }
    
    public function setNMax($nmax) {
        $this->nmax = $nmax;
    }
    
    /*Restituisce un utente iscritto al corso*/
    public function getUtente() {
        return $this->utente;
    }
    
    /*Setta l'utente come iscritto al corso*/
    public function setUtente(Utente $utente) {
        $this->utente = $utente;
    }
    
    
    /*Iscrive un utente al corso*/
    public function iscrivi(Utente $utente) {
        
        // l'iscrizione può avvenire se non si supera la capienza massima di iscritti
        if (count($this->iscritti) >= $this->nmax) {
            return false;
        }
        
        $this->iscritti[] = $utente;
        return true;
    }
      
    public function &getIscritti() {
        return $this->iscritti;
    }
    

}

?>



