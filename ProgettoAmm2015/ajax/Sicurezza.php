<?php

class Sicurezza {
    
   public function __construct() {
        
    }

    public function controlloUsername($username) {

        if (strlen($username) < 5) {
            return "L'username deve contentere minimo 5 caratteri!";
            
        } else if (strlen($username) > 8) {
            return "L'username deve contentere massimo 8 caratteri!";
        }

        if (!ctype_alnum($username)) {
            return "E' necessario utilizzare caratteri alfanumerici!";
        }
        return true;
    }

    public function controlloPassword($password) {

        if (strlen($password) < 8) {
            return "La password deve contentere minimo 8 caratteri!";
        } else if (strlen($password) > 16) {
            return "La password deve contentere massimo 16 caratteri!";
        }

        if (!preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $password)) {
            return "Password non valida! Assicurarsi di aver inserito almeno un lettera maiuscola, una minuscola e un numero.";
        }
     
        return true;
    }

    public function aggiornaSicurezza($user, $post) {
        
        foreach ($post as $key => $value) {
            ${$key} = $value;
        }

        $controlloUsername = $this->controlloUsername($username);
        if ($controlloUsername !== true) {
            return $controlloUsername;
        }

        $controlloPassword = $this->controlloPassword($password);
        if ($controlloPassword !== true) {
            return $controlloPassword;
        }
        
        $user->setUsername($username);
        $user->setPassword($password);
        
        if (UserFactory::instance()->salva($user) != 1) {
                echo '<p class="messaggio">Salvataggio fallito</p>';
        }
        
        return  true;
    }
}

?>
