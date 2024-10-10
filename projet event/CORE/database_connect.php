<?php
$serveur = "127.0.0.1";
$utilisateur = "root";
$mot_de_passe = "Hisauka17!";
$base_de_donnees = "projet_event";
$connexion =mysqli_connect($serveur,$utilisateur,$mot_de_passe,$base_de_donnees);

if (!$connexion) {
    die("La connexion à la base de données a échoué : ". mysqli_connect_error());
}


?>