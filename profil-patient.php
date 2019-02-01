<?php
include 'template/header.php';
include 'model/patient.php';
include 'model/appointments.php';
include 'controller/profilPatientController.php';
?>
<div class="container-fluid">
    <div class="backgroundPatientajout">
        <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                    <h1 class="titlePatientList">Détail du patient</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                    <?php
                    if ($isPatient) {
                        ?>
                        <table class="table table-hover table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Date de Naissance</th>
                                    <th scope="col">Numéro de telephone</th>
                                    <th scope="col">Mail</th>
                                    <th scope="col">Liste rendez-vous</th>
                                    <th scope="col">Retour</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $patients->id ?></td>
                                    <td><?= $patients->lastname ?></td>
                                    <td><?= $patients->firstname ?></td>
                                    <td><?= $patients->birthdate ?></td>
                                    <td><?= $patients->phone ?></td>
                                    <td><?= $patients->mail ?></td>
                                    <td>                                    
                                        <table class="table-dark">
                                            <tbody>
                                                <?php foreach ($appointmentsByIdPatient AS $appointment) { ?>
                                                    <tr>
                                                        <td><?= $appointment->date ?></td>
                                                        <td><?= $appointment->hour ?></td>
                                                        <td><a href="rendezvous.php?idAppointment=<?= $appointment->id ?>"></a></td>                                        
                                                    <?php } ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td><a class= "valid" href="liste-patient.php">Retour</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        ?>
                        <p>Le patient n'a pas été trouvé</p>
                    <?php } ?>
                    <form method="POST" action="">
                        <input type="submit" class= "valid"  name="modif" value="Modifier"/>
                    </form>
                    <?php
                    if (isset($_POST['modif'])) {
                        ?>

                        <form method="POST" action="profil-patient.php?id=<?= $patients->id ?>" class="form">
                            <fieldset>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <h1>Bonjour, Veuillez remplir le formulaire suivant.</h1>
                                    </div>
                                </div>
                                <?php if ($isSuccess) { ?>
                                    <p class="text-success">Vos modifications ont bien été prises en compte</p>
                                    <?php
                                }
                                if ($isError) {
                                    ?>
                                    <p class="text-danger">Désolé, vos modifications n'ont pu être enregistré !</p>
                                    <?php
                                }
                                ?>
                                <fieldset>
                                    <legend>Informations personnelles</legend>
                                    <p><label for="lastname"> Nom : </label><input type="text" placeholder="Nom" id="lastname" name="lastname" value="<?= $patients->lastname ?>"/></p>
                                    <p class="text-danger"><?= isset($formError['lastname']) ? $formError['lastname'] : '' ?></p> 
                                    <p><label for="firstname">Prénom : </label><input type="text" placeholder="Prénomom" id="firstname" name="firstname" value="<?= $patients->firstname ?>"/></p>
                                    <p class="text-danger"><?= isset($formError['firstname']) ? $formError['firstname'] : '' ?></p> 
                                    <p><label for="birthdate">Date de Naissance : </label><input type="date" id="birthdate" name="birthdate" value="<?= $patients->birthdate ?>"/></p>                                                                                              
                                    <p class="text-danger"><?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?></p> 
                                </fieldset>
                                <fieldset>
                                    <legend>Coordonnées</legend>
                                    <p><label for="mail">Adresse Mail : </label><input type="email" id="mail" placeholder="ex : adresse@hotmail.fr" name="mail" value="<?= $patients->mail ?> "/></p>  
                                    <p class="text-danger"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></p> 
                                    <p><label for="phone">Numero De Telephone : </label><input type="tel" data-country="FR" id="phone" placeholder="00 00 00 00 00" name="phone" value="<?= $patients->phone ?> "/></p>
                                    <p class="text-danger"><?= isset($formError['phone']) ? $formError['phone'] : '' ?></p> 
                                </fieldset>
                                <div>
                                    <div class="nav-item">
                                        <input type="submit" value="Valider" name="submit" class="valid"/>
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