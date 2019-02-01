<?php

$patients = new patients();
//on appel la méthode grâce a $patients qui se trouve dans ma classe et qui me retourne un tableau stocké dans $patientsList
$patientsList = $patients->getPatientsList();
$appointments = new appointments();
//Déclaration regex nom et prénom
$regexName = '/^[a-zA-Z\- ]+$/';
//Déclaration regex date
$regexDate = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
$regexHour = '/(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;
if (isset($_POST['submit'])) {
    if (isset($_POST['idLastname'])) {
        $idPatients = htmlspecialchars($_POST['idLastname']);
    } else {
        $formError['patient'] = 'Veuillez selectioner un patient';
    }
//Date du rdv
    if (isset($_POST['date'])) {
        if (!empty($_POST['date'])) {
            if (preg_match($regexDate, $_POST['date'])) {
                $date = htmlspecialchars($_POST['date']);
            } else {
                $formError['date'] = 'Votre date de rendez-vous est invalide.';
            }
        } else {
            $formError['date'] = 'Erreur,merci de remplir le champ date de rendez-vous.';
        }
    }
//Heure du rdv
    if (isset($_POST['hour'])) {
        if (!empty($_POST['hour'])) {
            if (preg_match($regexHour, $_POST['hour'])) {
                $hour = htmlspecialchars($_POST['hour']);
            } else {
                $formError['hour'] = 'Votre heure de rendez-vous est invalide.';
            }
        } else {
            $formError['hour'] = 'Erreur,merci de remplir le champ heure de rendez-vous.';
        }
    }
//fin vérification du formulaire
    if (count($formError) == 0) {
        $appointments->dateHour = $date . ' ' . $hour;
        $appointments->idPatients = $idPatients;
        $checkAppointment = $appointments->checkFreeAppointment();
        if ($checkAppointment === '1') {
            $formError['checkAppointment'] = 'Ce rendez-vous n\'est pas disponible';
        } else if ($checkAppointment === '0') {
            $isSuccess = $appointments->getAddAppointments();
        } else {
            $formError['checkAppointment'] = 'Le devellopeur est en pause';
        }
    }
}
?>