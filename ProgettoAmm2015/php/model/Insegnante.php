<?php

include_once 'User.php';

class Insegnante extends User {

    private $codiceFiscale;
    
    public function __construct() {
        parent::__construct();
        $this->setRuolo(User::Insegnante);
    }

    public function getCodiceFiscale() {
        return $this->codiceFiscale;
    }

    public function setCodiceFiscale($codiceFiscale) {
       $this->codiceFiscale = $codiceFiscale;
    }

}

?>