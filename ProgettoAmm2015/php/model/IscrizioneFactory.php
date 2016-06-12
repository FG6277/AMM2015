<?php

include_once 'Iscrizione.php';
include_once 'Utente.php';
include_once 'Insegnante.php';
include_once 'User.php';
include_once 'Corso.php';
include_once 'UserFactory.php';
include_once 'CorsiFactory.php';

class IscrizioneFactory {

    private static $singleton;
    
    private function __constructor(){
    }
    
    
    public static function instance(){
        if(!isset(self::$singleton)){
            self::$singleton = new IscrizioneFactory();
        }
        
        return self::$singleton;
    
}
   
    public function addIscrizione(&$request){
        
        $mysqli = Database::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("Impossibile inizializzare il database");
            $mysqli->close();
            return false;
        }
        
        $stmt= $mysqli->stmt_init();
        
        $aggiungi_iscrizione = "insert into Iscrizioni values (?, ?, ?, ?)";
        
        
        $stmt->prepare($aggiungi_iscrizione);
        if (!$stmt) {
            error_log("Impossibile inizializzare il secondo prepared statement");
            $mysqli->close();
            return false;
        }
        
      $cont=0;
      
      if (isset($request['CodiceI'])) {
            $codiceI = $request['CodiceI'];
            if ($request['CodiceI'] !== ""){ $cont++; }
        }
        
      if (isset($request['id'])) {
            $id = $request['id'];
            if ($request['id'] !== ""){ $cont++; }
        }
        
        if (isset($request['DataIscrizione'])) {
            $dataIscrizione = $request['DataIscrizione'];
            if ($request['DataIscrizione'] !== ""){$cont++;}
        }

        if (isset($request['CodiceCorso'])) {
            $corso = $request['CodiceCorso'];
            if ($request['CodiceCorso'] !== ""){$cont++;}
        }
        
        
        if ($cont < 4) { 
            echo ' Compila tutti i campi';
            $mysqli->close();
            return false;
        }
        
        
        if (!$stmt->bind_param('isii', $codiceI, $dataIscrizione, $id, $corso)) {
            error_log("Impossibile effettuare il binding in input stmt2");
            $mysqli->close();
            return false;
        }
        
        //inizio transazione
        $mysqli->autocommit(false);
        
        if (!$stmt->execute()) {
            error_log("Impossibile eseguire il secondo statement");
            $mysqli->rollback();
            $mysqli->close();
            return false;
        }

        $mysqli->commit();
        $mysqli->autocommit(true);
        $mysqli->close();

        return true;
    }
     
    public function crea($row){
        
        $iscrizione = new Iscrizione();
        $iscrizione->setId($row['Iscrizioni_CodiceI']);
        $iscrizione->setDataIscrizione($row['Iscrizioni_DataIscrizione']);
        $iscrizione->setCorso(CorsiFactory::instance()->crea($row));
        
        return $iscrizione;
}
    
    
}
 

?>



