<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css"/>
        <link rel="stylesheet" href="assets/css/style.css"/>
        <link rel="stylesheet" href="assets/font-awesome/css/all.css"/>
        <title>Hopital</title>
        <script src="assets/angularjs/angular.js"></script>

    </head>
    <body>
        <header>
            <div class="container-fluid">
                <div id="backgroundHeader" >
                    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex">
                                <img class="logo" src="assets/images/hopital1.jpg" alt="logo">
                                <h1 class="logoTitle">Hopital la Manu</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Début de nav bar-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id= "navbar">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ajout-patient.php">ajouter un patient</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="ajout-rendezvous.php">ajout un rendez-vous</a>
                        </li>
                    </ul>
                </div>
            </nav> 
            <!--Fin de nav bar-->
        </header>