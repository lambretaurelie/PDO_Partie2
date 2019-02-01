<?php 
//instanciation de l'objet patient.
//$patients devient une instance de la classe patients.
//la méthode magique construc est appelée automatiquement grâce au mot clé new.
$patients = new patients();
//on appel la méthode grâce a $patients qui se trouve dans ma classe et qui me retourne un tableau stocké dans $patientsList
$patientsList = $patients->getPatientsList();

if (isset($_GET['delete'])) {
    $deletePatient = new patients();
    $deletePatient->id = $_GET['delete'];
    $deletePatients = $deletePatient->getPatientsAndAppointmentsDelete();
    HEADER('location:liste-patient.php');
}
?>
