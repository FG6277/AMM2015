<?php

include_once 'User.php';
include_once 'Utente.php';
include_once 'Insegnante.php';
include_once 'Corso.php';
include_once 'Iscrizione.php';
include_once 'UserFactory.php';
include_once 'IscrizioneFactory.php';


class CorsiFactory {
    
    private static $singleton;

    private function __constructor() {
        
    }

    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new CorsiFactory();
        }

        return self::$singleton;
    }

    public function &corsiPerUtente(User $utente) {
        
        $corsi = array();
        
        $query = "SELECT Utenti.password Utenti_password,
                         Utenti.username Utenti_username, 
                         Utenti.id Utenti_id, 
                         Utenti.Cognome Utenti_Cognome, 
                         Utenti.Nome Utenti_Nome, 
                         Utenti.DataNascita Utenti_DataNascita, 
                         Utenti.Telefono Utenti_Telefono, 
                         Utenti.Email Utenti_Email,
                         
                         Iscrizioni.CodiceI Iscrizioni_CodiceI, 
                         Iscrizioni.DataIscrizione Iscrizioni_DataIscrizione, 
                         
                         Corsi.Nome Corsi_Nome, 
                         Corsi.Descrizione Corsi_Descrizione, 
                         Corsi.NMax Corsi_NMax, 
                         Corsi.Durata Corsi_Durata, 
                         Corsi.Prezzo Corsi_Prezzo, 
                         Corsi.OrarioLezioni Corsi_OrarioLezioni,
                         Corsi.Codice Corsi_Codice 
                  
                  FROM Corsi JOIN Iscrizioni ON Iscrizioni.CodiceCorso = Corsi.Codice
                  JOIN Utenti ON Iscrizioni.idUtente = Utenti.id
                  WHERE Utenti.id = ? GROUP BY Corsi.Nome";

        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log(" Impossibile inizializzare il database");
            $mysqli->close();
            return $corsi;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("Impossibile inizializzare il prepared statement");
            $mysqli->close();
            return $corsi;
        }
        
        if (!$stmt->bind_param('i', $utente->getId())) {
            error_log("Impossibile effettuare il binding in input");
            $mysqli->close();
            return $null;
        }
        
        $corsi = self::caricaCorsiUtente($stmt);
        foreach($corsi as $corso){
            self::caricaIscritti($corso);
        }
        
        $mysqli->close();
        return $corsi;
    }
    
    public function &caricaCorsiUtente(mysqli_stmt $stmt) {
        $corsi = array();
        if (!$stmt->execute()) {
            error_log("Impossibile eseguire lo statement");
            return $null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['Utenti_password'],
                $row['Utenti_username'],
                $row['Utenti_id'],
                $row['Utenti_Cognome'],
                $row['Utenti_Nome'],
                $row['Utenti_DataNascita'],
                $row['Utenti_Telefono'],
                $row['Utenti_Email'],
                $row['Iscrizioni_CodiceI'],
                $row['Iscrizioni_DataIscrizione'],
                $row['Corsi_Nome'],
                $row['Corsi_Descrizione'],
                $row['Corsi_NMax'], 
                $row['Corsi_Durata'],
                $row['Corsi_Prezzo'],
                $row['Corsi_OrarioLezioni'],
                $row['Corsi_Codice']);
                
        if (!$bind) {
            error_log("Impossibile effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $corsi[] = self::crea($row);
        }

        $stmt->close();

        return $corsi;
    }
    
    public function &corsiPerInsegnante(Insegnante $insegnante) {
        
        $corsi = array();
        
        $query = "SELECT Insegnanti.password Insegnanti_password, 
                         Insegnanti.username Insegnanti_username, 
                         Insegnanti.id Insegnanti_id, 
                         Insegnanti.Cognome Insegnanti_Cognome, 
                         Insegnanti.Nome Insegnanti_Nome, 
                         Insegnanti.DataNascita Insegnanti_DataNascita, 
                         Insegnanti.CodiceFiscale Insegnanti_CodiceFiscale, 
                         Insegnanti.Email Insegnanti_Email,  
                         
                         Iscrizioni.CodiceI Iscrizioni_CodiceI, 
                         Iscrizioni.DataIscrizione Iscrizioni_DataIscrizione, 
                         
                         Corsi.Nome Corsi_Nome, 
                         Corsi.Descrizione Corsi_Descrizione, 
                         Corsi.NMax Corsi_NMax, 
                         Corsi.Durata Corsi_Durata,
                         Corsi.Prezzo Corsi_Prezzo,
                         Corsi.OrarioLezioni Corsi_OrarioLezioni,
                         Corsi.Codice Corsi_Codice
                         
            FROM Corsi JOIN Insegnanti ON Corsi.idInsegnante = Insegnanti.id
            JOIN Iscrizioni ON Corsi.Codice = Iscrizioni.CodiceCorso
            
            WHERE Insegnanti.id = ? GROUP BY Corsi.Nome";

        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("Impossibile inizializzare il database");
            $mysqli->close();
            return $corsi;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("Impossibile inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $insegnante->getId())) {
            error_log("Impossibile effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $corsi =  self::caricaCorsiInsegnante($stmt);
        foreach($corsi as $corso){
            self::caricaIscritti($corso);
        }
        
        $mysqli->close();
        return $corsi;
    }
    
    public function &caricaCorsiInsegnante(mysqli_stmt $stmt) {
        $corsi = array();
        if (!$stmt->execute()) {
            error_log("Impossibile eseguire lo statement");
            return $null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['Insegnanti_password'],
                $row['Insegnanti_username'],
                $row['Insegnanti_id'],
                $row['Insegnanti_Cognome'],
                $row['Insegnanti_Nome'],
                $row['Insegnanti_DataNascita'],
                $row['Insegnanti_CodiceFiscale'],
                $row['Insegnanti_Email'],
                $row['Iscrizioni_CodiceI'],
                $row['Iscrizioni_DataIscrizione'],
                $row['Corsi_Nome'],
                $row['Corsi_Descrizione'],
                $row['Corsi_NMax'], 
                $row['Corsi_Durata'],
                $row['Corsi_Prezzo'],
                $row['Corsi_OrarioLezioni'],
                $row['Corsi_Codice']);
                
        if (!$bind) {
            error_log("Impossibile effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $corsi[] = self::crea($row);
        }

        $stmt->close();

        return $corsi;
    }
    
    public function &listaCorsi(){
       $lista = array();
       
       $query="SELECT Corsi.Nome Corsi_Nome,
                      Corsi.Descrizione Corsi_Descrizione,
                      Corsi.NMax Corsi_NMax,
                      Corsi.Durata Corsi_Durata,
                      Corsi.Prezzo Corsi_Prezzo,
                      Corsi.OrarioLezioni Corsi_OrarioLezioni,
                      Corsi.Codice Corsi_Codice
               FROM Corsi";
       
        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("Impossibile inizializzare il database");
            $mysqli->close();
            return $lista;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("Impossibile inizializzare il prepared statement");
            $mysqli->close();
            return $lista;
        }
        
        if (!$stmt->execute()) {
            error_log("Impossibile eseguire lo statement");
            return null;
        }

        $row = array();
        $bind = $stmt->bind_result(
                $row['Corsi_Nome'],
                $row['Corsi_Descrizione'],
                $row['Corsi_NMax'], 
                $row['Corsi_Durata'],
                $row['Corsi_Prezzo'],
                $row['Corsi_OrarioLezioni'],
                $row['Corsi_Codice']);
                
        if (!$bind) {
            error_log("Impossibile effettuare il binding in output");
            return null;
        }

        while ($stmt->fetch()) {
            $lista[] = self::crea($row);
        }

        $stmt->close();

        return $lista;
    }

    public function caricaIscritti(Corso $corso){
        
        
        $query = "SELECT Utenti.id studenti_id,
                         Utenti.Nome studenti_Nome,
                         Utenti.Cognome Utenti_Cognome,
                         Utenti.DataNascita Utenti_DataNascita,
                         Utenti.Telefono Utenti_Telefono,
                         Utenti.Email Utenti_Email,
                         Utenti.username Utenti_username,
                         Utenti.password Utenti_password,
            
                         Corsi.Codice Corsi_Codice,
                         Corsi.Nome Corsi_Nome
            
                 FROM Corsi JOIN Iscrizioni ON Corsi.Codice = Iscrizioni.CodiceCorso
                 JOIN Utenti ON Iscrizioni.idUtente = Utenti.id
            
                 WHERE Corsi.Codice = ?";
       
        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("Impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("Impossibile inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('i', $corso->getCodice())) {
            error_log("Impossibile effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        
        if (!$stmt->execute()) {
            error_log("Impossibile eseguire lo statement");
            $mysqli->close();
            return null;
        }

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
                $row['Corsi_Codice'],
                $row['Corsi_Nome']);
        if (!$bind) {
            error_log("Impossibile effettuare il binding in output");
            $mysqli->close();
            return null;
        }

        while ($stmt->fetch()) {
            $corso->iscrivi(UserFactory::instance()->creaUtente($row));
        }
        
        $mysqli->close();
        $stmt->close();
        
    }
    
    public function cercaCorsoPerCodice($corsoCodice){
        $corsi = array();
        
        $query = "
               SELECT Insegnanti.password Insegnanti_password, 
                      Insegnanti.username Insegnanti_username, 
                      Insegnanti.id Insegnanti_id, 
                      Insegnanti.Cognome Insegnanti_Cognome, 
                      Insegnanti.Nome Insegnanti_Nome, 
                      Insegnanti.DataNascita Insegnanti_DataNascita, 
                      Insegnanti.CodiceFiscale Insegnanti_CodiceFiscale, 
                      Insegnanti.Email Insegnanti_Email, 
                      
                      Iscrizioni.CodiceI Iscrizioni_CodiceI,
                      Iscrizioni.DataIscrizione Iscrizioni_DataIscrizione, 
                      
                      Corsi.Nome Corsi_Nome, 
                      Corsi.Descrizione Corsi_Descrizione, 
                      Corsi.NMax Corsi_NMax, 
                      Corsi.Durata Corsi_Durata,
                      Corsi.Prezzo Corsi_Prezzo,
                      Corsi.OrarioLezioni Corsi_OrarioLezioni,
                      Corsi.Codice Corsi_Codice 
               
               FROM Corsi JOIN Iscrizioni ON Corsi.Codice = Iscrizioni.CodiceCorso
               JOIN Insegnanti ON Corsi.idInsegnante = Insegnanti.id
               
               WHERE Corsi.Codice = ?";
        

        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("Impossibile inizializzare il database");
            $mysqli->close();
            return $corsi;
        }
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("Impossibile inizializzare il prepared statement");
            $mysqli->close();
            return $corsi;
        }

        
        if (!$stmt->bind_param('i', $corsoCodice)) {
            error_log("Impossibile effettuare il binding in input");
            $mysqli->close();
            return $corsi;
        }

        $corsi =  self::caricaCorsiInsegnante($stmt);
        
        foreach($corsi as $corso){
            self::caricaIscritti($corso);
        }
        
        if(count($corsi > 0)){
            $mysqli->close();
            return $corsi[0];
        }else{
            $mysqli->close();
            return null;
        }
    }
    
    public function crea($row) {
        $corso = new Corso();
        
        $corso->setDescrizione($row['Corsi_Descrizione']);
        $corso->setDurata($row['Corsi_Durata']);
        $corso->setCodice($row['Corsi_Codice']);
        $corso->setNMax($row['Corsi_NMax']);
        $corso->setPrezzo($row['Corsi_Prezzo']);
        $corso->setOrario($row['Corsi_OrarioLezioni']);
        $corso->setNome($row['Corsi_Nome']);
        
        return $corso;
    }
    
    public function salva(Corso $corso){
         $query = "update Corsi set 
                    Nome = ?,
                    Descrizione = ?,
                    Durata = ?,
                    OrarioLezioni = ?,
                    NMax = ?,
                    Prezzo = ?
                    where Codice = ?";
         
        return $this->modificaDataBase($corso, $query);
        
    }

    private function modificaDataBase(Corso $corso, $query){
        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("Impossibile inizializzare il database");
            return 0;
        }

        $stmt = $mysqli->stmt_init();
       
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("Impossibile inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->bind_param('ssssisi', 
                $corso->getNome(),
                $corso->getDescrizione(),
                $corso->getDurata(),
                $corso->getOrario(),
                $corso->getNMax(),
                $corso->getPrezzo(),
                $corso->getCodice()))
        {
            error_log("Impossibile effettuare il binding in input");
            $mysqli->close();
            return 0;
        }

        if (!$stmt->execute()) {
            error_log("Impossibile eseguire lo statement");
            $mysqli->close();
            return 0;
        }

        $mysqli->close();
        return $stmt->affected_rows;
    }

    public function addCorso( &$utente, &$request){
        
        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("Impossibile inizializzare il database");
            $mysqli->close();
            return false;
        }
        
        $stmt = $mysqli->stmt_init();
        
        $aggiungi_corso = "insert into Corsi values (default, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt->prepare($aggiungi_corso);
        if (!$stmt) {
            error_log("Impossibile inizializzare il prepared statement");
            $mysqli->close();
            return false;
        }
        
        
      $cont=0;        
        
        if (isset($request['Nome'])) {
            $nome = $request['Nome'];
            if ($request['Nome'] !== ""){$cont++;}
        }
       
        if (isset($request['Descrizione'])) {
            $descrizione = $request['Descrizione']; 
            if ($request['Descrizione'] !== ""){$cont++;}
        }

        if (isset($request['Durata'])) {
            $durata = $request['Durata'];
            if ($request['Durata'] !== ""){$cont++;}
        }
          
        if (isset($request['OrarioLezioni'])) {
            $orario = $request['OrarioLezioni'];
            if ($request['OrarioLezioni'] !== ""){$cont++;}
        }
        
        if (isset($request['NMax'])) {
            $nmax = $request['NMax'];
            if ($request['NMax'] !== ""){$cont++;}
        }
      
        if (isset($request['Prezzo'])) {
            $prezzo = $request['Prezzo'];
            if ($request['Prezzo'] !== ""){$cont++;}
        }
        
        
        if ($cont < 6) { 
            echo ' Compila tutti i campi';
            $mysqli->close();
            return false;
        }
        
        if (!$stmt->bind_param('ssssisi', $nome, $descrizione, $durata, $orario, $nmax, $prezzo, $utente->getId())){ 
            error_log("Impossibile effettuare il binding in input");
            $mysqli->close();
            return false;
        } 
        
        //inizio transazione
        $mysqli->autocommit(false);
          
        if (!$stmt->execute()) {
            error_log("Impossibile eseguire lo statement");
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

