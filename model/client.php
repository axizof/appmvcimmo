<?php

class client {
	
	// Objet PDO servant à la connexion à la base
	private $pdo;

	// Connexion à la base de données
	public function __construct() {
		$config = parse_ini_file("config.ini");
		
		try {
			$this->pdo = new \PDO("mysql:host=".$config["host"].";dbname=".$config["database"].";charset=utf8", $config["user"], $config["password"]);
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}

	// Verification login et mot de passe de l'utilisateur lors de la connexion
	public function connexion($login, $password)
	{
		$sql = "SELECT id_client, password FROM Client WHERE login_client = :login";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(":login", $login, PDO::PARAM_STR);
		$stmt->execute();
		$ligne = $stmt->fetch();
		if ($ligne !== false) {
			if (password_verify($password, $ligne["password"])) {
				$_SESSION["connexion"] = $ligne["id_client"];
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	// client déjà inscrit ?
	public function estDejaInscrit($login)
	{
		$sql = "SELECT COUNT(*) AS nombre FROM Client WHERE login_client = :login";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(":login", $login, PDO::PARAM_STR);
		if ($stmt->execute()) {
			$ligne = $stmt->fetch();
			if ($ligne["nombre"] == 0) {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}

	
	//Recupèrer toutes les infos du client
	public function getInfosClient($leclient){
		$sql = "SELECT * FROM Client WHERE id_client = :id_client";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id_client', $leclient, PDO::PARAM_INT);
		$req->execute();
		return $req->fetch();
	}

	//Inscrire le client
	public function inscrireClient($login, $password) {
		$sql = "INSERT INTO Client(login_client, password)
				VALUES(:login, :password)";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(":login", $login, PDO::PARAM_STR);
		$req->bindParam(":password", $password, PDO::PARAM_STR);
		return $req->execute();
	}

	//modification mdp client
}
?>