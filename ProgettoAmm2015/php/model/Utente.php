<?php

include_once 'User.php';

class Utente extends User {

    private $telefono;

    public function __construct() {
   
        parent::__construct();
        $this->setRuolo(User::Utente);  
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;           
    }
    
}

?>
