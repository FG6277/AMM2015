<?php

class User {
    
    private $username;
    private $password;    
    private $nome;
    private $cognome; 
    private $ruolo;     
    private $dataNascita;
    private $id;
    private $email;

    const Insegnante = 1;   
    const Utente = 2;

    public function __construct() {
        
    }

    public function getUsername() {
        return $this->username;
    }
    
    public function setUsername($username) {
        if (!filter_var($username, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/[a-zA-Z]{5,}/')))) {
            return false;
        }
        $this->username = $username;
        return true;
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        return true;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
        return true;
    }

    public function getCognome() {
        return $this->cognome;
    }
    
    public function setCognome($cognome) {
        $this->cognome = $cognome;
        return true;
    }
    
    public function getRuolo() {
        return $this->ruolo;
    }

    public function setRuolo($ruolo) {
        switch ($ruolo) {
            case self::Insegnante:
                $this->ruolo = $ruolo;
                return true;
            case self::Utente:
                $this->ruolo = $ruolo;
                return true;
            default:
                return false;
        }
    }
    

    public function getDataNascita() {
        return $this->dataNascita;
    }
    

    public function setDataNascita($dataNascita) {
        $this->dataNascita = $dataNascita;
        return true;
    }

    public function getEmail() {
        return $this->email;
    }

   public function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        $this->email = $email;
        return true;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $valore = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(!isset($valore)){
            return false;
        }
        $this->id = $valore;
    }
    
   /*Controlla se utente/insegnante esite*/
   public function esiste() {
        return isset($this->ruolo);
    }
    
    
   /*Controlla se due utenti/insegnanti sono uguali*/
   public function equals(User $user) {

        return  $this->id == $user->id &&
                $this->nome == $user->nome &&
                $this->cognome == $user->cognome &&
                $this->ruolo == $user->ruolo;
    }

}

?>



