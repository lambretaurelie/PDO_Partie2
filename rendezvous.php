<?php
include 'template/header.php';
include 'model/patient.php';
include 'model/appointments.php';
include 'controller/rendezVousController.php';
?>
<body>
    <div class="container-fluid">
        <div class="backgroundPatientList">
            <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <h1 class="titlePatientList">Détail du rendez-vous</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <?php
                        if ($isAppointments) {
                            ?>
                            <table class="table table-hover table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Prénom</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Heure</th>
                                        <th scope="col">Téléphone</th>
                                        <th scope="col">Détail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $appointments->id ?></td>
                                        <td><?= $appointments->lastname ?></td>
                                        <td><?= $appointments->firstname ?></td>
                                        <td><?= $appointments->date ?></td>
                                        <td><?= $appointments->hour ?></td>
                                        <td><?= $appointments->phone ?></td>
                                        <td><a class= "valid" href="rendezvous.php?id=<?= $appointments->id ?>" name="valid"> Modifier</a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php
                        } else {
                            ?>
                            <p>Le rendez-vous n'a pas été trouvé</p>
                        <?php } ?>

                        <form method="POST" action="rendezvous.php?id=<?= $appointments->id ?>">
                            <input type="submit" class= "valid"  name="modif" value="Modifier"/>
                        </form>
                        <?php
                        if (isset($_POST['modif'])) {
                            ?>
                            <form method="POST" action="rendezvous.php?id=<?= $appointments->id ?>" class="form">
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
                                            <?php foreach ($patientsList as $patientDetail) { ?>
                                             <!-- Si l'id du rdv existe et que l'id du patient est égale à l'id patient du rdv alors je rajoute l'attribut selected  -->
                                                <option value = "<?= $patientDetail->id ?>" <?= isset ($appointments->idPatients) && ($patientDetail->id == $appointments->idPatients) ? 'selected' : '' ?>><?= $patientDetail->lastname . ' ' . $patientDetail->firstname ?></option>
                                            <?php } ?>
                                        </select>
                                        <p><label for="date"> Date du rendez-vous : </label><input type="date" id="date" name="date" value="<?= $appointments->dateUS ?>"/></p>
                                        <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p> 
                                        <p><label for="hour">Veuillez choisir une heure de rendez-vous (heures d'ouverture 09:00 à 18:00) : </label><input id="hour" type="time" name="hour" min="09:00" max="18:00" value="<?= $appointments->hour ?>"/></p>
                                    </fieldset>
                                    <div>
                                        <div class="nav-item">
                                            <input type="submit" class="valid" value="Valider" name="submit"/>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
include 'template/footer.php';
?>
</html>

