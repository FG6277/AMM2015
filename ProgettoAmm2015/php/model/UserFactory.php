<?php

include_once 'Database.php';
include_once 'User.php';
include_once 'Utente.php';
include_once 'Insegnante.php';

class UserFactory {
    
    private static $singleton;

    private function __constructor() {
        
    }

    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new UserFactory();
        }

        return self::$singleton;
    }
    
    
    public function cercaUtentePerId($id, $ruolo) {
        
        $intval = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intval)) {
            return null;
        }
        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("Impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        switch ($ruolo) {
            // cerco prima su un utente
            case User::Utente:
                
                $query = "SELECT Utenti.id Utenti_id, 
                                 Utenti.Nome Utenti_Nome,
                                 Utenti.Cognome Utenti_Cognome, 
                                 Utenti.DataNascita Utenti_DataNascita, 
                                 Utenti.Telefono Utenti_Telefono, 
                                 Utenti.Email Utenti_Email,
                                 Utenti.username Utenti_username, 
                                 Utenti.password Utenti_password, 

                                 Corsi.Nome Corsi_Nome,
                                 Corsi.Descrizione Corsi_Descrizione, 
                                 Corsi.Durata Corsi_Durata, 
                                 Corsi.Prezzo Corsi_Prezzo,
                                 Corsi.NMax Corsi_NMax,
                                 Corsi.OrarioLezioni Corsi_OrarioLezioni,
                                 Corsi.Codice Corsi_Codice, 
                                 
                                 Iscrizioni.DataIscrizione Iscrizioni_DataIscrizione, 
                                 Iscrizioni.CodiceCorso Iscrizioni_CodiceCorso
                                 
                          FROM Corsi JOIN Iscrizioni ON Iscrizioni.CodiceCorso = Corsi.Codice
                          JOIN Utenti ON Utenti.id = Iscrizioni.idUtente
                          
                          WHERE Utenti.id = ?";
                
                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) {
                    error_log("Impossibile inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) {
                    error_log("Impossibile effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }
                
                return self::caricaUser($stmt);
                
                // cerco ora un insegnante
            case User::Insegnante:
                $query = "SELECT Insegnanti.id Insegnanti_id, 
                                 Insegnanti.Nome Insegnanti_Nome,
                                 Insegnanti.Cognome Insegnanti_Cognome, 
                                 Insegnanti.DataNascita Insegnanti_DataNascita,
                                 Insegnanti.CodiceFiscale Insegnanti_CodiceFiscale, 
                                 Insegnanti.Email Insegnanti_Email,
                                 Insegnanti.username Insegnanti_username, 
                                 Insegnanti.password Insegnanti_password, 
                                 
                                 Corsi.Nome Corsi_Nome,
                                 Corsi.Descrizione Corsi_Descrizione,
                                 Corsi.Durata Corsi_Durata,
                                 Corsi.Prezzo Corsi_Prezzo,
                                 Corsi.NMax Corsi_NMax,
                                 Corsi.OrarioLezioni Corsi_OrarioLezioni,
                                 Corsi.Codice Corsi_Codice, 
                                 
                                 Iscrizioni.DataIscrizione Iscrizioni_DataIscrizione,
                                 Iscrizioni.CodiceCorso Iscrizioni_CodiceCorso 
                                 
                          FROM Corsi JOIN Iscrizioni ON Iscrizioni.CodiceCorso = Corsi.Codice
                          JOIN Insegnanti ON Insegnanti.id = Corsi.idInsegnante
                          
                          WHERE Insegnanti.id = ?";

                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) {
                    error_log("Impossibile inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) {
                    error_log("Impossibile effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }
                
                $toRet =  self::caricaInsegnante($stmt);
                $mysqli->close();
                return $toRet;

            default: 
                return null;
        }
    }  
 
    private function caricaInsegnante(mysqli_stmt $stmt) {
        
        if (!$stmt->execute()) {
            error_log("Impossibile eseguire lo statement");
            return null;}
        
        $row = array();
        $bind = $stmt->bind_result($row['Insegnanti_id'],
                                   $row['Insegnanti_Nome'],
                                   $row['Insegnanti_Cognome'],
                                   $row['Insegnanti_DataNascita'],
                                   $row['Insegnanti_CodiceFiscale'],
                                   $row['Insegnanti_Email'],
                                   $row['Insegnanti_username'],
                                   $row['Insegnanti_password'],
                                   $row['Corsi_Nome'], 
                                   $row['Corsi_Descrizione'],
                                   $row['Corsi_Durata'],
                                   $row['Corsi_Prezzo'],
                                   $row['Corsi_NMax'],
                                   $row['Corsi_OrarioLezioni'],
                                   $row['Corsi_Codice'],
                                   $row['Iscrizioni_DataIscrizione'], 
                                   $row['Iscrizioni_CodiceCorso']);

        
        if (!$bind) {
            error_log("Impossibile effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaInsegnante($row);
    }

    private function caricaUser(mysqli_stmt $stmt) {

        if (!$stmt->execute()) {
            error_log("Impossibile eseguire lo statement");
            return null;}

        $row = array();
        $bind = $stmt->bind_result(
                $row['Utenti_id'],
                $row['Utenti_Nome'],
                $row['Utenti_Cognome'],
                $row['Utenti_DataNascita'],
                $row['Utenti_Telefono'],
                $row['Utenti_Email'],
                $row['Utenti_username'],
                $row['Utenti_password'],
                $row['Corsi_Nome'], 
                $row['Corsi_Descrizione'],
                $row['Corsi_Durata'],
                $row['Corsi_Prezzo'],
                $row['Corsi_NMax'],
                $row['Corsi_OrarioLezioni'],
                $row['Corsi_Codice'],
                $row['Iscrizioni_DataIscrizione'], 
                $row['Iscrizioni_CodiceCorso']
                 );
        
        if (!$bind) {
            error_log("Impossibile effettuare il binding in output");
            return null;
        }

        if (!$stmt->fetch()) {
            return null;
        }

        $stmt->close();

        return self::creaUtente($row);
    }
    
    public function caricaUtente($username, $password) {


        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("Impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        $query = "
            SELECT Utenti.id Utenti_id, 
                   Utenti.Nome Utenti_Nome, 
                   Utenti.Cognome Utenti_Cognome,
                   Utenti.DataNascita Utenti_DataNascita,  
                   Utenti.Telefono Utenti_Telefono,
                   Utenti.Email Utenti_Email,
                   Utenti.username Utenti_username, 
                   Utenti.password Utenti_password,
                   
                   Corsi.Nome Corsi_Nome, 
                   Corsi.Descrizione Corsi_Descrizione,
                   Corsi.Durata Corsi_Durata, 
                   Corsi.Prezzo Corsi_Prezzo,
                   Corsi.NMax Corsi_NMax, 
                   Corsi.OrarioLezioni Corsi_OrarioLezioni,
                   Corsi.Codice Corsi_Codice,
                   
                   Iscrizioni.DataIscrizione Iscrizioni_DataIscrizione, 
                   Iscrizioni.CodiceCorso Iscrizioni_CodiceCorso
                    
            FROM Corsi JOIN Iscrizioni on Iscrizioni.CodiceCorso = Corsi.Codice
                       JOIN Utenti on Utenti.id = Iscrizioni.idUtente
                       
            WHERE Utenti.username = ? and Utenti.password = ?";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("Impossibile inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt -> bind_param('ss', $username, $password)){
            error_log("Impossibile effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $utente = self::caricaUser($stmt);
        if (isset($utente)) {
            $mysqli->close();
            return $utente;
        }
        
        $query=
           "SELECT Insegnanti.id Insegnanti_id, 
                   Insegnanti.Nome Insegnanti_Nome, 
                   Insegnanti.Cognome Insegnanti_Cognome,
                   Insegnanti.DataNascita Insegnanti_DataNascita,
                   Insegnanti.CodiceFiscale Insegnanti_CodiceFiscale,
                   Insegnanti.Email Insegnanti_Email, 
                   Insegnanti.username Insegnanti_username,
                   Insegnanti.password Insegnanti_password,
                    
                   Corsi.Nome Corsi_Nome, 
                   Corsi.Descrizione Corsi_Descrizione,
                   Corsi.Durata Corsi_Durata, 
                   Corsi.Prezzo Corsi_Prezzo,
                   Corsi.NMax Corsi_NMax, 
                   Corsi.OrarioLezioni Corsi_OrarioLezioni,
                   Corsi.Codice Corsi_Codice,
                  
                   Iscrizioni.DataIscrizione Iscrizioni_DataIscrizione, 
                   Iscrizioni.CodiceCorso Iscrizioni_CodiceCorso
                  
            FROM Corsi JOIN Iscrizioni on Iscrizioni.CodiceCorso = Corsi.Codice
                       JOIN Insegnanti on Insegnanti.id = Corsi.idInsegnante
                       
            WHERE Insegnanti.username = ? and Insegnanti.password = ?";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("Impossibile inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('ss', $username, $password)) {
            error_log("Impossibile effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $insegnante = self::caricaInsegnante($stmt);
        if (isset($insegnante)) {
            $mysqli->close();
            return $insegnante;
        }
    }
    
    public function creaUtente($row) {
         
        $Utente = new Utente();
        $Utente->setRuolo(User::Utente);
        $Utente->setId($row['Utenti_id']);
        $Utente->setNome($row['Utenti_Nome']);
        $Utente->setCognome($row['Utenti_Cognome']);
        $Utente->setDataNascita($row['Utenti_DataNascita']);
        $Utente->setTelefono($row['Utenti_Telefono']);
        $Utente->setEmail($row['Utenti_Email']);
        $Utente->setUsername($row['Utenti_username']);
        $Utente->setPassword($row['Utenti_password']);
        
        return $Utente;
    }
    
    public function creaInsegnante($row) {
        
        $Insegnante = new Insegnante();
        $Insegnante->setRuolo(User::Insegnante);
        $Insegnante->setId($row['Insegnanti_id']);
        $Insegnante->setNome($row['Insegnanti_Nome']);
        $Insegnante->setCognome($row['Insegnanti_Cognome']);
        $Insegnante->setDataNascita($row['Insegnanti_DataNascita']);
        $Insegnante->setCodiceFiscale($row['Insegnanti_CodiceFiscale']);
        $Insegnante->setEmail($row['Insegnanti_Email']);
        $Insegnante->setUsername($row['Insegnanti_username']);
        $Insegnante->setPassword($row['Insegnanti_password']);
        
        return $Insegnante;
    }
    
    public function salva(User $user) {
        
        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("Impossibile inizializzare il database");
            $mysqli->close();
            return 0;
        }
        
        $stmt = $mysqli->stmt_init();
        $count = 0;
        switch ($user->getRuolo()) {
            case User::Utente:
                $count = $this->salvaUtente($user, $stmt);
                break;
            case User::Insegnante:

                $count = $this->salvaInsegnante($user, $stmt);
        }

        $stmt->close();
        $mysqli->close();
        return $count;
    }
    
    private function salvaUtente(Utente $utente, mysqli_stmt $stmt) {
         
        $query = "update Utenti set 
                    Nome = ?,
                    Cognome = ?,
                    DataNascita = ?,
                    Email = ?,
                    Telefono = ?,
                    username = ?,
                    password = ?
                    where Utenti.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("Impossibile  inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('isssssss', $utente->getId(), $utente->getNome(), $utente->getCognome(), $utente->getDataNascita(),
                                $utente->getEmail(), $utente->getTelefono(), $utente->getUsername(), $utente->getPassword())) {
            error_log("Impossibile effettuare il binding in input");
            return 0;
        }
           
       
        if (!$stmt->execute()) {
            error_log("Impossibile eseguire lo statement");
            return 0;
        }

        return $stmt->affected_rows;
    }
    
    private function salvaInsegnante(Insegnante $i, mysqli_stmt $stmt) {
        $query = " update Insegnanti set 
                    Nome = ?,
                    Cognome = ?,
                    CodiceFiscale = ?,
                    DataNascita = ?,
                    Email = ?,
                    username = ?,
                    password = ?
                    where Insegnanti.id = ?
                    ";
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("Impossibile inizializzare il prepared statement");
            return 0;
        }

        if (!$stmt->bind_param('sssssssi',
                $i->getNome(), 
                $i->getCognome(),
                $i->getCodiceFiscale(),
                $i->getDataNascita(),
                $i->getEmail(), 
                $i->getUsername(),
                $i->getPassword(), 
                $i->getId())) {
            error_log("Impossibile effettuare il binding in input");
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("Impossibile eseguire lo statement");
            return 0;
        }

        return $stmt->affected_rows;
    }
    
    public function addUtente(&$request){
        
        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("Impossibile inizializzare il database");
            $mysqli->close();
            return false;
        }
        
        $stmt = $mysqli->stmt_init();
        
        $aggiungi_utente = "insert into Utenti values (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt->prepare($aggiungi_utente);
        if (!$stmt) {
            error_log("Impossibile inizializzare il primo  prepared statement");
            $mysqli->close();
            return false;
        }
           
      $cont=0;
        
      if (isset($request['id'])) {
            $id = $request['id'];
            if ($request['id'] !== ""){ $cont++; }
        }
        
        if (isset($request['Nome'])) {
            $nome = $request['Nome'];
            if ($request['Nome'] !== ""){$cont++;}
        }
       
        if (isset($request['Cognome'])) {
            $cognome = $request['Cognome']; 
            if ($request['Cognome'] !== ""){$cont++;}
        }

        if (isset($request['DataNascita'])) {
            $dataNascita = $request['DataNascita'];
            if ($request['DataNascita'] !== ""){$cont++;}
        }
          
        if (isset($request['Email'])) {
            $email = $request['Email'];
            if ($request['Email'] !== ""){$cont++;}
        }
        
        if (isset($request['Telefono'])) {
            $telefono = $request['Telefono'];
            if ($request['Telefono'] !== ""){$cont++;}
        }
      
        if (isset($request['username'])) {
            $username = $request['username'];
            if ($request['username'] !== ""){$cont++;}
        }
        
        if (isset($request['password'])) {
            $password = $request['password'];
            if ($request['password'] !== ""){$cont++;}
        }
        
        
        if ($cont < 8) { 
            echo ' Compila tutti i campi';
            $mysqli->close();
            return false;
        }
        
        if (!$stmt->bind_param('isssssss', $id, $nome, $cognome, $dataNascita, $email, $telefono, $username, $password)){ 
            error_log("Impossibile effettuare il binding in input stmt1");
            $mysqli->close();
            return false;
        } 
        
        //inizio transazione
        $mysqli->autocommit(false);
          
        if (!$stmt->execute()) {
            error_log("Impossibile eseguire il primo statement");
            $mysqli->rollback();
            $mysqli->close();
            return false;
        }

        $mysqli->commit();
        $mysqli->autocommit(true);
        $mysqli->close();

        return true;
    }
      
}
?>
