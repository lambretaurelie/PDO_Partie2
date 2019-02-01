<?php

class appointments {

    public $id = 0;
    public $dateHour = '0000-00-00 00:00:00 ';
    public $idPatients = 0;
    private $db;

    public function __construct() {
//protection contre l'erreur
//si il n'y a pas d'erreur
        try {
            $this->db = new PDO('mysql:host=hospital;dbname=hospitalE2N;charset=utf8', 'lambret', 'GORDONroxie');
//si il y a une erreur
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    /**
     * la méthode sert a créer un nouveau rdv 
     * @return array
     */
    public function getAddAppointments() {
// On insert les données du patient à l'aide de la requête INSERT INTO et le nom des champs de la table
        $query = 'INSERT INTO `appointments` (`dateHour`,`idPatients`) VALUES (:dateHour, :idPatients)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryResult->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * Cette méthode sert à verifier que le rendez vous n'est pas déja pris
     * @return type
     */
    public function checkFreeAppointment() {
        $result = FALSE;
        $query = 'SELECT COUNT(`id`) AS `takenAppointment` FROM `appointments` WHERE `dateHour`=:dateHour AND `idPatients`=:idPatients';
        $freeAppointment = $this->db->prepare($query);
        $freeAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $freeAppointment->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        if ($freeAppointment->execute()) {
            $resultObject = $freeAppointment->fetch(PDO::FETCH_OBJ);
            $result = $resultObject->takenAppointment;
        }
        return $result;
    }

    /**
     * la méthode sert à créer la liste des rendez-vous, l'id du patient est remplacé par son nom et prénom grace a 
     * la jointure des deux tables
     * @return type
     */
    public function getAppointmentsList() {
        $result = array();
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS date, 
                  DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS hour,                        
                  `appointments`.`id`, 
                  `patients`.`lastname`,
                  `patients`.`firstname`   
                  FROM `appointments`
                  LEFT JOIN `patients` 
                  ON `appointments`.`idPatients`=`patients`.`id`
                ORDER BY `appointments`.`dateHour`';
        $Resultquery = $this->db->query($query);
        if (is_object($Resultquery)) {
            $result = $Resultquery->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * la méthode sert a selectionner les informations d'un rendez-vous dans la liste des rendez-vous
     * @param type $id
     * @return type
     */
    public function getAppointmentById() {
        $return = FALSE;
        $isOk = FALSE;
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`,
                  DATE_FORMAT(`appointments`.`dateHour`, "%Y-%m-%d") AS dateUS,
                  DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`,                        
                 `appointments`.`id`,
                 `appointments`.`idPatients`,
                  `patients`.`lastname`,
                  `patients`.`firstname`,     
                  `patients`.`phone`   
                  FROM `appointments`
                  LEFT JOIN `patients` 
                  ON `appointments`.`idPatients`=`patients`.`id`
                  WHERE `appointments`.`id` = :idAppointment';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':idAppointment', $this->id, PDO::PARAM_INT);
//si la requete c'est bien executé alors on rempli $returnArray avec un objet         
        if ($queryResult->execute()) {
            $return = $queryResult->fetch(PDO::FETCH_OBJ);
        }
//si $return est un objet alors on hydrate       
        if (is_object($return)) {
            $this->date = $return->date;
            $this->hour = $return->hour;
            $this->dateUS = $return->dateUS;
            $this->lastname = $return->lastname;
            $this->firstname = $return->firstname;
            $this->phone = $return->phone;
            $this->idPatients = $return->idPatients;
            $this->id = $return->id;
            $isOk = TRUE;
        }
        return $isOk;
    }

    /**
     * methode pour modifier le rendez-vous
     * @return type
     */
    public function getAppointmentUpdate() {
        $query = 'UPDATE `appointments` SET `dateHour`=:dateHour, `idPatients`=:idPatients WHERE `id`=:idAppointment';
        $queryResult = $this->db->prepare($query);
// on attribue les valeurs via bindValue et on recupère les attributs de la classe via $this
        $queryResult->bindValue(':idAppointment', $this->id, PDO::PARAM_INT);
        $queryResult->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryResult->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * methode pour filtrer les rendez-vous en fonction des patients
     * @return type
     */
    public function getAppointmentsByIdPatient() {
        $result = array();
        $query = 'SELECT id, DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS date, 
                  DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS hour,                        
                 `idPatients` FROM `appointments` WHERE `appointments`.`idPatients`=:idPatient';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':idPatient', $this->idPatient, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * methode pour supprimer un RDV en fonction de l'Id
     * @return type
     */
    public function getAppointmentsDeleteById() {
        
        $query = 'DELETE FROM `appointments`
                  WHERE `id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $result = $queryResult->execute();
            
        return $result;
    }
}
?>

