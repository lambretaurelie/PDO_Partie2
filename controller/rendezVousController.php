<?php

$isAppointments = false;
$patients = new patients();
//on appel la méthode grâce a $patients qui se trouve dans ma classe et qui me retourne un tableau stocké dans $patientsList
$patientsList = $patients->getPatientsList();

$appointments = new appointments();
if (isset($_GET['id'])) {
    $appointments->id = htmlspecialchars($_GET['id']);
    $isAppointments = $appointments->getAppointmentById();
}
//Déclaration regex date
$regexDate = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
$regexHour = '/(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;
//si le submit est isset
if (isset($_POST['submit'])) {
    //Prénom du patient
    if (!empty($_POST['idLastname'])) {
        // Si lastname ne respecte pas les conditions de ma regex alors je stock un message d'erreur
        // dont mon tableau formError

        $idPatients = htmlspecialchars($_POST['idLastname']);
    } else {
        $formError['idLastname'] = 'Erreur,merci de remplir le champ nom.';
    }
//Date du rendez-vous
    if (!empty($_POST['date'])) {
        if (preg_match($regexDate, $_POST['date'])) {
            $date = htmlspecialchars($_POST['date']);
        } else {
            $formError['date'] = 'Votre date de rendez-vous est invalide.';
        }
    } else {
        $formError['date'] = 'Erreur,merci de remplir le champ date de rendez-vous.';
    }
//heure du rendez-vous
    if (!empty($_POST['hour'])) {
        if (preg_match($regexHour, $_POST['hour'])) {
            $hour = htmlspecialchars($_POST['hour']);
        } else {
            $formError['hour'] = 'Votre heure est  invalide.';
        }
    } else {
        $formError['hour'] = 'Erreur,merci de remplir le champ heure.';
    }

    //on verifie si il n'y a pas d'erreur alors on instancie la classe patients.
    if (count($formError) === 0) {
          $appointments = new appointments();
          $appointments->id = $_GET['id'];
          $appointments->idPatients = $idPatients;
          $appointments->dateHour = $date . ' ' . $hour;
          $appointments->getAppointmentUpdate();
          //sert a rediriger la page pour la réactualiser
          HEADER('location:liste-rendezvous.php');
      }
    }

?>


