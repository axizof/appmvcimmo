<?php

class commercial {
	
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

	public function getInfosCommercial($leCommercial){
		$sql = "SELECT * FROM Commercial WHERE id_commercial = :id_comm";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id_comm', $leCommercial, PDO::PARAM_INT);
		$req->execute();
		return $req->fetch();
	}

	public function calculDate($reqInfos = null)
	{
		$dateAjoutTimestamp = strtotime($reqInfos['DateCreation']);
		$dateActuelle = time();
		$difference = $dateActuelle - $dateAjoutTimestamp;

		$minutes = floor($difference / 60);
		$heures = floor($difference / (60 * 60));
		$jours = floor($difference / (60 * 60 * 24));
		$mois = floor($difference / (60 * 60 * 24 * 30));
		$annees = floor($difference / (60 * 60 * 24 * 365));

		if ($annees > 0) {
			if ($annees == 1) {
				$tempsEcoule = "1 an";
			} else {
				$tempsEcoule = "$annees ans";
			}
			if ($mois > 0) {
				$tempsEcoule .= " " . ($mois % 12) . " mois";
			}
		} elseif ($mois > 0) {
			if ($mois == 1) {
				$tempsEcoule = "1 mois";
			} else {
				$tempsEcoule = "$mois mois";
			}
			if ($jours > 0) {
				$tempsEcoule .= " " . ($jours % 30) . " jours";
			}
		} elseif ($jours > 0) {
			if ($jours == 1) {
				$tempsEcoule = "1 jour";
			} else {
				$tempsEcoule = "$jours jours";
			}
		} elseif ($heures > 0) {
			if ($heures == 1) {
				$tempsEcoule = "1 heure";
			} else {
				$tempsEcoule = "$heures heures";
			}
		} else {
			if ($minutes <= 1) {
				$tempsEcoule = "1 minute";
			} else {
				$tempsEcoule = "$minutes minutes";
			}
		}

		$reqInfos['DateAjoutDiff'] = $tempsEcoule;
		return $reqInfos;
	}

	public function getInfosCommercialFromLogement($idLog){
		$sql = "SELECT Logements.id_commercial As id_commercial, Commercial.nom_commercial As nom_commercial, Commercial.prenom_commercial As prenom_commercial, Commercial.DateCreation As DateCreation, Commercial.pp As pp FROM `Commercial` INNER JOIN Logements on Commercial.id_commercial = Logements.id_commercial WHERE id_logement = :id";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id', $idLog, PDO::PARAM_INT);
		$req->execute();
		return $this->calculDate($req->fetch());
	}

	public function estDejaInscrit($login)
	{
		$sql = "SELECT COUNT(*) AS nombre FROM Commercial WHERE login_commercial = :login";
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

	public function inscrireCommercial($login, $nom ,$prenom,$password) {
		$sql = "INSERT INTO Commercial(login_commercial,nom_commercial,prenom_commercial,hashed_password)
				VALUES(:login,:nom,:prenom,:password)";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(":login", $login, PDO::PARAM_STR);
		$req->bindParam(":nom", $nom, PDO::PARAM_STR);
		$req->bindParam(":prenom", $prenom, PDO::PARAM_STR);
		$req->bindParam(":password", $password, PDO::PARAM_STR);
		return $req->execute();
	}
	public function connexion($login, $password){
		$sql = "SELECT id_commercial, hashed_password FROM Commercial WHERE login_commercial = :login";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(":login", $login, PDO::PARAM_STR);
		$stmt->execute();
		$ligne = $stmt->fetch();
		if($ligne != false){
			if(password_verify($password, $ligne["hashed_password"])){
				$_SESSION["connexion_commercial"] = $ligne["id_commercial"];
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
}
?>