<?php
include 'template/header.php';
include 'model/patient.php';
include 'controller/listePatientController.php';
?>
<body>
    <div class="container-fluid">
        <div class="backgroundPatientList">
            <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <form class="form-inline my-2 my-lg-0 search displayOK">
                        <input class="form-control mr-sm-2 inputSearch" ng-model="Category" type="search" placeholder="Rechercher">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                    </form>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <h1 class="titlePatientList">Liste des patients</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <table class="table table-hover table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Détail</th>
                                    <th scope="col">Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($patientsList as $patient) { ?>
                                    <tr>
                                        <td><?= $patient->id ?></td>
                                        <td><?= $patient->lastname ?></td>
                                        <td><?= $patient->firstname ?></td>
                                        <td><a class= "valid" href="profil-patient.php?id=<?= $patient->id ?>" name="valid"> Voir le detail</a></td>
                                        <td><a class="btn btn-danger" href="liste-patient.php?delete=<?= $patient->id ?>" id="delete" name="delecte"> Supprimer</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
                        <a class= "valid" href="ajout-patient.php" name="submit"> Création d'un patient</a>
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
