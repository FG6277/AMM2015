<?php

include_once 'User.php';
include_once 'Corso.php';

class Iscrizione {

    private $dataIscrizione;
    private $codice_i;   
    private $corso;
   
    public function __construct() {
        
    }
    
    public function setCorso(Corso $corso) {
        $this->corso = $corso;
    }
    
    public function getCorso() {
        return $this->corso;
    }
   
    public function getId() {
        return $this->codice_i;
    }
    
    public function setId($codice_i) {
        $valore = filter_var($codice_i, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($valore)) {
            return false;
        }
        $this->codice_i = $valore;
        return true;
    }
    
    public function getDataIscrizione() {
        return $this->dataIscrizione;
    }

    public function setDataIscrizione($dataIscrizione) {
        $this->dataIscrizione = $dataIscrizione;
        return true;
    }

}

?>

