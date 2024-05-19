<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '1024M');
error_reporting(E_ALL);

// Test de connexion à la base
$config = parse_ini_file("config.ini");
try {
	$pdo = new \PDO("mysql:host=".$config["host"].";dbname=".$config["database"].";charset=utf8", $config["user"], $config["password"]);
} catch (Exception $e) {
	echo "<h1>Erreur de connexion à la base de données :</h1>";
	echo $e->getMessage();
	exit;
}

// Chargement des fichiers MVC
require("controleur/controleur.php");
require("view/view.php");
require("model/client.php");
require("model/commercial.php");
require("model/equipement.php");
require("model/logementPeriode.php");
require("model/logements.php");
require("model/photos.php");
require("model/piece.php");
require("model/reservation.php");

// Routes
if(isset($_GET["action"])) {
	switch($_GET["action"]) {
		case "accueil":
			(new controleur)->accueil();
			break;
		case "connexion":
			(new controleur)->connexion();
			break;
		case "inscription":
			(new controleur)->inscription();
			break;
		case "deconnexion":
			(new controleur)->deconnexion();
			break;
		case "loginProprio":
			(new controleur)->loginProprio();
			break;
		case "signupProprio":
			(new controleur)->signupProprio();
			break;
		case "profil":
			(new controleur)->profil();
			break;
		case "rechercherLogement":
			(new controleur)->rechercherLogement();
			break;
		case "location":
			(new controleur)->location();
			break;
		case "process_paiement":
			if(isset($_GET['log_id'])){
			(new controleur)->process_paiement($_GET['log_id']);
			}else{
				(new controleur)->erreur404();
			}
			break;
		case "mesAnnonces":
			(new controleur)->mesAnnonces();
			break;
		case "mesReservations":
			(new controleur)->mesReservations();
			break;
		case "modifierAnnonce":
			(new controleur)->modifierAnnonce();
			break;
		
		case "modifierPeriodeLogement":
			(new controleur)->modifierPeriodeLogement($_GET["id"]);
			break;
		case "seepolitique":
			(new controleur)->seepolitique();
			break;
		case "LesDemandes":
			(new controleur)->LesDemandes();
			break;


		// Route par défaut : erreur 404
		default:
			(new controleur)->erreur404();
			break;
	}
} else {
	// Pas d'action précisée = afficher l'accueil
	(new controleur)->accueil();
}
