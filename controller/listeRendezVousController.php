<?php

$appointments = new appointments();
//on appel la méthode grâce a $appointments qui se trouve dans ma classe et qui me retourne un tableau stocké dans $appointmentsList
$isDelete = FALSE;
if (!empty($_GET['idDelete'])) {
    $appointments->id = htmlspecialchars($_GET['idDelete']);
    if ($appointments->getAppointmentsDeleteById()) {
        $isDelete = TRUE;
    }
}
$appointmentsList = $appointments->getAppointmentsList();
?>
