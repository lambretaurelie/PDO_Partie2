<?php
include 'template/header.php';
include 'model/patient.php';
include 'controller/ajoutPatientController.php';
?>
<body> 
    <div class="container-fluid">
        <div id="backgroundAcc">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h1 class="titleAcc">Ajouter un patient</h1>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form method="POST" action="ajout-patient.php" class="form">
                        <fieldset>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <h1>Bonjour, Veuillez remplir le formulaire suivant.</h1>
                                </div>
                            </div>
                            <?php if ($isSuccess) { ?>
                                <p class="text-success">Vos données ont bien été prises en compte</p>
                                <?php
                            }
                            if ($isError) {
                                ?>
                                <p class="text-danger">Désolé, le patient n'a pu être enregistré !</p>
                                <?php
                            }
                            ?>
                            <fieldset>
                                <legend>Informations personnelles</legend>
                                <p>
                                    <label for="lastname"> Nom : </label><input type="text" placeholder="Nom" id="lastname" name="lastname" value="<?= isset($lastname) ? $lastname : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['lastname']) ? $formError['lastname'] : '' ?></p> 
                                <label for="firstname">Prénom : </label><input type="text" placeholder="Prénomom" id="firstname" name="firstname" value="<?= isset($firstname) ? $firstname : '' ?>"/>
                                <p class="text-danger"><?= isset($formError['firstname']) ? $formError['firstname'] : '' ?></p> 
                                </p>
                                <p>
                                    <label for="birthdate">Date de Naissance : </label><input type="date" id="birthdate" name="birthdate" value="<?= isset($birthdate) ? $birthdate : '' ?>"/>                                                                                              
                                <p class="text-danger"><?= isset($formError['birthdate']) ? $formError['birthdate'] : '' ?></p> 
                                </p>
                            </fieldset>
                            <fieldset>
                                <legend>Coordonnées</legend>
                                <p>
                                    <label for="mail">Adresse Mail : </label><input type="email" id="mail" placeholder="ex : adresse@hotmail.fr" name="mail" value="<?= isset($mail) ? $mail : '' ?> "/>  
                                <p class="text-danger"><?= isset($formError['mail']) ? $formError['mail'] : '' ?></p> 
                                <label for="phone">Numero De Telephone : </label><input type="tel" data-country="FR" id="phone" placeholder="00 00 00 00 00" name="phone" value="<?= isset($phone) ? $phone : '' ?> "/>
                                <p class="text-danger"><?= isset($formError['phone']) ? $formError['phone'] : '' ?></p> 
                                </p>
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


