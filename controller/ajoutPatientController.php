<?php

//Déclaration regex numéro de téléphone
$regexPhone = '/^[0-9]{10}$/';
//Déclaration regex nom et prénom
$regexName = "#([a-zA-Z_])$#";
//Déclaration regex date
$regexBirthdate = "/[0-9]{4}-[0-9]{2}-[0-9]{2}/";
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;
//si le submit est isset
if (isset($_POST['submit'])) {
    if (isset($_POST['lastname'])) {
        // Si $POST lastName extsite alors je declare ma varible $lastname
        // et je la verrifie avec ma regex.
        // si mon $_POST['lastname'] est différent de vide
//Nom du patient
        if (!empty($_POST['lastname'])) {
            // Si lastname ne respecte pas les conditions de ma regex alors je stock un message d'erreur
            // dont mon tableau formError
            if (preg_match($regexName, $_POST['lastname'])) {
                $lastname = htmlspecialchars($_POST['lastname']);
            } else {
                $formError['lastname'] = 'Votre nom est  invalide.';
            }
        } else {
            $formError['lastname'] = 'Erreur,merci de remplir le champ nom.';
        }
    }
//Prénom du patient
    if (isset($_POST['firstname'])) {
        if (!empty($_POST['firstname'])) {
            if (preg_match($regexName, $_POST['firstname'])) {
                $firstname = htmlspecialchars($_POST['firstname']);
            } else {
                $formError['firstname'] = 'Votre prénom est  invalide.';
            }
        } else {
            $formError['firstname'] = 'Erreur,merci de remplir le champ nom.';
        }
    }
//Date d'anniversaire
    if (isset($_POST['birthdate'])) {
        if (!empty($_POST['birthdate'])) {
            if (preg_match($regexBirthdate, $_POST['birthdate'])) {
                $birthdate = htmlspecialchars($_POST['birthdate']);
            } else {
                $formError['birthdate'] = 'Votre date de naissance est invalide.';
            }
        } else {
            $formError['birthdate'] = 'Erreur,merci de remplir le champ date de naissance.';
        }
    }
//Numéro de téléphone
    if (isset($_POST['phone'])) {
        if (!empty($_POST['phone'])) {
            if (preg_match($regexPhone, $_POST['phone'])) {
                $phone = htmlspecialchars($_POST['phone']);
            } else {
                $formError['phone'] = 'Votre numéro de téléphone est  invalide.';
            }
        } else {
            $formError['phone'] = 'Erreur,merci de remplir le champ numéro de téléphone.';
        }
    }
//adresse mail
    // Si mail ne respecte pas le filter_var alors je stock un message d'erreur
    // dont mon tableau formError
    //Emploi de la fonction PHP Filter_var pour valider l'adresse Email.
    if (isset($_POST['mail'])) {
        if (!empty($_POST['mail'])) {
            if (FILTER_VAR($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $mail = htmlspecialchars($_POST['mail']);
            } else {
                $formError['mail'] = 'Votre mail est  invalide.';
            }
        } else {
            $formError['mail'] = 'Erreur,merci de remplir le champ adresse mail.';
        }
    }
//fin vérification du formulaire

    if (count($formError) == 0) {
//Instenciation de l'objet patients. 
//$patients devient une instance de la classe patients.
//la methode magique construct est appelée automatiquement 
//grace au mot clé new.
        $patients = new patients();
        $patients->lastname = $lastname;
        $patients->firstname = $firstname;
        $patients->birthdate = $birthdate;
        $patients->mail = $mail;
        $patients->phone = $phone;

        if ($patients->addPatient()) {

            $isSuccess = TRUE;
        } else {
            $isError = TRUE;
        }
    }
}
?>