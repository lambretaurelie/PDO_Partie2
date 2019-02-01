<?php

class patients {

    public $id = 0;
    public $lastname = '';
    public $firstname = '';
    public $birthdate = '00/00/0000';
    public $mail = '';
    public $phone = '0000000000';
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
     * la méthode sert a créer un nouveau patients 
     * @return array
     */
    public function addPatient() {
// On insert les données du patient à l'aide de la requête INSERT INTO et le nom des champs de la table
// $result array avec le if  sert a éviter l'affichage de l'erreur dans le navigateur ainsi l'utilisateur ne le voie pas
        $result = array();
        $query = 'INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES (:lastname, :firstname, :birthdate, :phone, :mail)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryResult->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryResult->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        if (is_object($queryResult)) {
            $result = $queryResult->execute();
        }
        return $result;
    }

    /**
     * la méthode sert a créer la liste des patients
     * @return array
     */
    public function getPatientsList() {
        $result = array();
        $query = 'SELECT `id`,`lastname`,`firstname`,DATE_FORMAT(`birthdate`,\'%d/%m/%Y\') AS `birthdate`,`phone`,`mail` FROM `patients` ORDER BY `lastname` ASC';
        $Resultquery = $this->db->query($query);
        if (is_object($Resultquery)) {
            $result = $Resultquery->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * la méthode sert a selectionner les informations d'un patient dans la liste des patients
     * @param type $id
     * @return type
     */
    //methode pour recuperer le profil d'un patient suivant l'id
    public function profilPatient() {
        $return = FALSE;
        $isOk = FALSE;
        $query = 'SELECT `id`,`lastname`,`firstname`,DATE_FORMAT(`birthdate`,\'%d/%m/%Y\') AS `birthdate`,`phone`,`mail` FROM `patients` WHERE `id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
//si la requete c'est bien executé alors on rempli $returnArray avec un objet         
        if ($queryResult->execute()) {
            $return = $queryResult->fetch(PDO::FETCH_OBJ);
        }
//si $return est un objet alors on hydrate       
        if (is_object($return)) {
            $this->lastname = $return->lastname;
            $this->firstname = $return->firstname;
            $this->birthdate = $return->birthdate;
            $this->phone = $return->phone;
            $this->id = $return->id;
            $this->mail = $return->mail;
            $isOk = TRUE;
        }
        return $isOk;
    }

    /**
     * methode pour modifier le profil d'un patient
     * @return type
     */
    public function profilUpdate() {
        $query = 'UPDATE `patients` SET `lastname`=:lastname, `firstname`=:firstname, `birthdate`=:birthdate, `phone`=:phone, `mail`=:mail WHERE `id`= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryResult->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryResult->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * la méthode sert a afficher la liste des rendez-vous d'un patient
     * @return type
     */
    public function selectAppointments() {
        $result = array();
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS date, 
                  DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS hour,                        
                  `appointments`.`id`, 
                  `patients`.`lastname`,
                  `patients`.`firstname`   
                  FROM `patients`
                  LEFT JOIN `appointments` 
                  ON `patients`.`id`=`appointments`.`idPatients`';
        $Resultquery = $this->db->query($query);
        if (is_object($Resultquery)) {
            $result = $Resultquery->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function getPatientsAndAppointmentsDelete() {
        $result = array();
        $query = 'DELETE FROM patients WHERE id= :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }
    /**
     * la méthode sert a rechercher un patient
     * @return ARRAY
     */
    public function PatientsSearch($search) {
        // On utilise un LIKE qui nous permettra d'afficher la liste selon un critère non précis
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `phone`, `mail` FROM `patients` WHERE `lastname` LIKE :search ORDER BY `lastname`';
        $result = $this->db->prepare($query);
        // nous attribuons au marqueur nominatif search la valeur de $search
        $result->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        $result->execute();
        $resultList = $result->fetchAll(PDO::FETCH_OBJ);
        return $resultList;
    }

}

?>
