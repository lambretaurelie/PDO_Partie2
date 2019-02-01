<?php
include 'template/header.php';
include 'model/patient.php';
include 'model/appointments.php';
include 'controller/ajoutRendezVousController.php';
?>
<body> 
    <div class="container-fluid">
        <div id="backgroundAcc" >
            <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h1 class="titleAcc">Ajouter un rendez-Vous</h1>
                    </div>
                    <form method="POST" action="ajout-rendezvous.php" class="form">
                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <h1>Bonjour, Veuillez remplir le formulaire suivant.</h1>
                                </div>
                            </div>
                            <?php if ($isSuccess) { ?>
                                <p class="text-success">Votre rendez-vous a bien été prises en compte</p>
                                <?php
                            }
                            if ($isError) {
                                ?>
                                <p class="text-danger">Désolé, votre rendez-vous n'a pu être enregistré !</p>
                                <?php
                            }
                            ?>
                            <fieldset>
                                <legend>Prise de rendez-vous</legend>
                                <label for="idLastname"> Nom et prénom du patient : </label>
                                <select name="idLastname" id="idLastname">
                                    <option value="" disabled selected>Choix du patient</option>
                                    <?php foreach ($patientsList as $patientDetail) { ?>
                                        <option value = "<?= $patientDetail->id ?>"><?= $patientDetail->lastname . ' ' . $patientDetail->firstname ?></option>
                                    <?php } ?>
                                </select>
                                   <p class="text-danger"><?= isset($formError['idLastname']) ? $formError['idLastname'] : '' ?></p>
                                <p><label for="date"> Date du rendez-vous : </label><input type="date" id="date" name="date" min="Date" value="<?= isset($date) ? $date : '' ?>"/></p>
                                <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p> 
                                <p><label for="hour">Veuillez choisir une heure de rendez-vous (heures d'ouverture 09:00 à 18:00) : </label><input id="hour" type="time" name="hour" min="09:00" max="18:00" value="<?= isset($hour) ? $hour : '' ?>"/></p>
                            </fieldset>
                            <div>
                                <div class="nav-item">
                                    <input type="submit" class="valid" value="Valider" name="submit"/></a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include 'template/footer.php';
?>
</html>

