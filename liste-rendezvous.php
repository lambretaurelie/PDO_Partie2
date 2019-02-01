<?php
include 'template/header.php';
include 'model/appointments.php';
include 'controller/listeRendezVousController.php';
?>
<body>
    <div class="container-fluid">
        <div class="backgroundPatientList">
            <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <h1 class="titlePatientList">Liste des rendez-vous</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <?php
                        if (isset($_GET['idDelete'])) {
                            if ($isDelete) {
                                ?>
                                <p>Le rendez-vous a bien été supprimé</p>
                                <?php } else {
                                ?>
                                <p>le rendez-vous n'a pas été supprimé</p>
                                <?php
                            }
                        }
                        ?>
                        <table class="table table-hover table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Heure</th>
                                    <th scope="col">Détail</th>
                                    <th scope="col">Effacer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appointmentsList as $appointments) { ?>
                                    <tr>
                                        <td><?= $appointments->id ?></td>
                                        <td><?= $appointments->lastname ?></td>
                                        <td><?= $appointments->firstname ?></td>
                                        <td><?= $appointments->date ?></td>
                                        <td><?= $appointments->hour ?></td>
                                        <td><a class= "valid" href="rendezvous.php?id=<?= $appointments->id ?>" name="valid"> Voir le detail</a></td>
                                        <td><a class="btn btn-danger" href="liste-rendezvous.php?idDelete=<?= $appointments->id ?>" id="delete" name="delecte"> Supprimer</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                        <a class= "valid" href="ajout-rendezvous.php" name="submit"> Création d'un rendez-vous</a>
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
