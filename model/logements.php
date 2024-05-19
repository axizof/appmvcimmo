<?php

class logements
{

	// Objet PDO servant à la connexion à la base
	private $pdo;

	// Connexion à la base de données
	public function __construct()
	{
		$config = parse_ini_file("config.ini");

		try {
			$this->pdo = new \PDO("mysql:host=" . $config["host"] . ";dbname=" . $config["database"] . ";charset=utf8", $config["user"], $config["password"]);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	public function calculDate($reqInfos = null)
	{
		$dateAjoutTimestamp = strtotime($reqInfos['DateAjout']);
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

		$reqInfos['DateAjoutDiff'] = "Disponible depuis " . $tempsEcoule;
		return $reqInfos;
	}

	//recup les infos d'un logement par son id
	public function getInfosLogement($id_logement)
	{
		$sql = "SELECT * FROM Logements WHERE id_logement = :id";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id', $id_logement, PDO::PARAM_INT);
		$req->execute();
		$newRes = $this->calculDate($req->fetch(PDO::FETCH_ASSOC));
		return $newRes;
	}


	public function ajouterLogement($nom, $nb_pieces, $rue, $cp, $ville, $id_commercial)
	{
		$sql = "INSERT INTO Logements (nom_logement, nb_pieces, rue_logement, cp_logement, ville_logement, id_commercial) 
				VALUES (:nom, :nb_pieces, :rue, :cp, :ville, :id_commercial)";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':nom', $nom, PDO::PARAM_STR);
		$req->bindParam(':nb_pieces', $nb_pieces, PDO::PARAM_INT);
		$req->bindParam(':rue', $rue, PDO::PARAM_STR);
		$req->bindParam(':cp', $cp, PDO::PARAM_STR);
		$req->bindParam(':ville', $ville, PDO::PARAM_STR);
		$req->bindParam(':id_commercial', $id_commercial, PDO::PARAM_INT);
		if ($req->execute()) {
		} else {
			return false;
		}
		return true;
	}


	public function afficherMesLogements($id_commercial)
	{
		$sql = "SELECT Logements.*,Photos.chemin_photo AS premiere_photo FROM Logements 
		INNER JOIN Photos ON Logements.id_logement = Photos.id_logement 
    	WHERE Logements.id_commercial = :idcomm AND Photos.id_equipement IS NULL 
        AND Photos.id_piece IS NULL GROUP BY Logements.id_logement";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':idcomm', $id_commercial, PDO::PARAM_INT);
		$req->execute();
		return $req->fetchAll();
	}


	public function rechercherLogementDisponible($date_debut = null, $date_fin = null, $cp_logement = null)
	{
		$sql = "SELECT * FROM Logements 
            INNER JOIN LogementPeriode ON LogementPeriode.id_logement = Logements.id_logement 
            WHERE 1";

		if ($date_debut !== null) {
			$sql .= " AND LogementPeriode.date_debut >= :date_debut";
		}

		if ($date_fin !== null) {
			$sql .= " AND LogementPeriode.date_debut <= :date_fin";
		}

		if ($cp_logement !== null) {
			$sql .= " AND Logements.cp_logement LIKE :cp_logement";
		}
		$sql .= " ORDER BY LogementPeriode.date_debut ASC";

		$req = $this->pdo->prepare($sql);

		if ($date_debut !== null) {
			$req->bindParam(':date_debut', $date_debut, PDO::PARAM_STR);
		}

		if ($date_fin !== null) {
			$req->bindParam(':date_fin', $date_fin, PDO::PARAM_STR);
		}

		if ($cp_logement !== null) {
			$req->bindValue(':cp_logement', '%' . $cp_logement . '%', PDO::PARAM_STR);
		}
		$req->execute();
		return $req->fetchAll();
	}

	public function modifierLogement($id, $nom, $nbpiece, $rue, $cp, $ville)
	{
		$sql = "UPDATE Logements SET nom_logement=:nom_logement, nb_pieces=:nb_pieces, rue_logement=:rue_logement, 
		        cp_logement=:cp_logement, ville_logement=:ville_logement WHERE id_log	ement=:id_logement";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id_logement', $id, PDO::PARAM_INT);
		$req->bindParam(':nom_logement', $nom, PDO::PARAM_STR);
		$req->bindParam(':nb_pieces', $nbpiece, PDO::PARAM_INT);
		$req->bindParam(':rue_logement', $rue, PDO::PARAM_STR);
		$req->bindParam(':cp_logement', $cp, PDO::PARAM_INT);
		$req->bindParam(':ville_logement', $ville, PDO::PARAM_STR);
		$req->execute();
	}
	public function updateLogementComm($idupdate, $name, $rue, $cp, $ville, $nb_pieces)
	{
		$sql = "UPDATE Logements SET nom_logement = :nom_logement, nb_pieces = :nb_pieces, rue_logement = :rue_logement, 
		        cp_logement = :cp_logement, ville_logement = :ville_logement WHERE id_logement = :id_logement";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id_logement', $idupdate, PDO::PARAM_INT);
		$req->bindParam(':nom_logement', $name, PDO::PARAM_STR);
		$req->bindParam(':nb_pieces', $nb_pieces, PDO::PARAM_INT);
		$req->bindParam(':rue_logement', $rue, PDO::PARAM_STR);
		$req->bindParam(':cp_logement', $cp, PDO::PARAM_STR);
		$req->bindParam(':ville_logement', $ville, PDO::PARAM_STR);
		$req->execute();
	}

	public function rechercherLogementDisponible2(
		$date_debut = null,
		$date_fin = null,
		$cp_logement = null,
		$nom_logement = null,
		$nb_pieces = null,
		$rue_logement = null,
		$ville_logement = null,
		$page = 1
	) {
		$limit = 10;
		$offset = ($page - 1) * $limit;
	
		$sql = "SELECT LP.id_logement AS id_logement, 
				(SELECT chemin_photo FROM Photos WHERE id_logement = LP.id_logement 
				AND id_equipement IS NULL AND id_piece IS NULL LIMIT 1) AS premiere_photo, 
				L.id_commercial AS id_commercial, L.nom_logement AS nom_logement, 
				L.DateAjout AS DateAjout, L.nb_pieces AS nombre_pieces, 
				L.rue_logement AS rue_logement, L.cp_logement AS cp_logement, 
				L.ville_logement AS ville_logement 
				FROM LogementPeriode LP JOIN Logements L ON LP.id_logement = L.id_logement ";
	
		$conditions = [];
		$params = [];
	
		if ($date_debut !== null && $date_fin !== null) {
			$conditions[] = "(LP.date_fin >= :date_fin OR LP.date_fin IS NULL) AND NOT EXISTS (
							 SELECT * FROM Reservation R WHERE R.id_logement = LP.id_logement 
							 AND R.accept = 1 AND R.date_fin_demande > :date_debut)";
			$params[':date_debut'] = $date_debut;
			$params[':date_fin'] = $date_fin;
		}
	
		if ($cp_logement !== null) {
			$conditions[] = "L.cp_logement LIKE :cp_logement";
			$params[':cp_logement'] = '%' . $cp_logement . '%';
		}
		if ($nom_logement  !== null) {
			$conditions[] = "L.nom_logement  LIKE :nom_logement ";
			$params[':nom_logement'] = '%' . $nom_logement  . '%';
		}
		if ($nb_pieces  !== null) {
			$conditions[] = "L.nb_pieces  LIKE :nb_pieces ";
			$params[':nb_pieces'] = '%' . $nb_pieces  . '%';
		}
		if ($rue_logement   !== null) {
			$conditions[] = "L.rue_logement  LIKE :rue_logement ";
			$params[':rue_logement'] = '%' . $rue_logement  . '%';
		}
		if ($ville_logement !== null) {
			$conditions[] = "L.ville_logement   LIKE :ville_logement  ";
			$params[':ville_logement '] = '%' . $ville_logement   . '%';
		}
	
	
		if (!empty($conditions)) {
			$sql .= " WHERE " . implode(" AND ", $conditions);
		}
	
		$sql .= " GROUP BY LP.id_logement ORDER BY L.DateAjout DESC LIMIT $limit OFFSET $offset";
	
		$req = $this->pdo->prepare($sql);
		$req->execute($params);
	
		return $req->fetchAll();
	}

	public function rechercherLogementDisponible2Count(
		$date_debut = null,
		$date_fin = null,
		$cp_logement = null,
		$nom_logement = null,
		$nb_pieces = null,
		$rue_logement = null,
		$ville_logement = null
	) {
		$sql = "SELECT COUNT(DISTINCT LP.id_logement) AS total_logements
				FROM LogementPeriode LP 
				JOIN Logements L ON LP.id_logement = L.id_logement ";
	
		$conditions = [];
		$params = [];
	
		if ($date_debut !== null && $date_fin !== null) {
			$conditions[] = "(LP.date_fin >= :date_fin OR LP.date_fin IS NULL) AND NOT EXISTS (
							 SELECT * FROM Reservation R WHERE R.id_logement = LP.id_logement 
							 AND R.accept = 1 AND R.date_fin_demande > :date_debut)";
			$params[':date_debut'] = $date_debut;
			$params[':date_fin'] = $date_fin;
		}
	
		if ($cp_logement !== null) {
			$conditions[] = "L.cp_logement LIKE :cp_logement";
			$params[':cp_logement'] = '%' . $cp_logement . '%';
		}
		if ($nom_logement  !== null) {
			$conditions[] = "L.nom_logement  LIKE :nom_logement ";
			$params[':nom_logement'] = '%' . $nom_logement  . '%';
		}
		if ($nb_pieces  !== null) {
			$conditions[] = "L.nb_pieces  LIKE :nb_pieces ";
			$params[':nb_pieces'] = '%' . $nb_pieces  . '%';
		}
		if ($rue_logement   !== null) {
			$conditions[] = "L.rue_logement  LIKE :rue_logement ";
			$params[':rue_logement'] = '%' . $rue_logement  . '%';
		}
		if ($ville_logement !== null) {
			$conditions[] = "L.ville_logement   LIKE :ville_logement  ";
			$params[':ville_logement '] = '%' . $ville_logement   . '%';
		}
	
		if (!empty($conditions)) {
			$sql .= " WHERE " . implode(" AND ", $conditions);
		}
	
		$req = $this->pdo->prepare($sql);
		$req->execute($params);
	
		return $req->fetchColumn();
	}


	public function GetLogementMain($datetype = null)
	{
		if ($datetype == 0 || $datetype == null) {
			$sql = "SELECT LP.id_logement AS id_logement, (SELECT chemin_photo FROM Photos WHERE id_logement = LP.id_logement AND id_equipement IS NULL AND id_piece IS NULL LIMIT 1) AS premiere_photo, L.id_commercial AS id_commercial, L.nom_logement AS nom_logement, L.DateAjout AS DateAjout, L.nb_pieces AS nombre_pieces, L.rue_logement AS rue_logement, L.cp_logement AS cp_logement, L.ville_logement AS ville_logement 
			FROM LogementPeriode LP JOIN Logements L ON LP.id_logement = L.id_logement 
			WHERE LP.id_logement IN (SELECT DISTINCT id_logement FROM LogementPeriode WHERE (date_fin >= CURDATE() OR date_fin IS NULL) 
			AND id_logement NOT IN (SELECT DISTINCT R.id_logement FROM Reservation R WHERE R.accept = 1 AND R.date_fin_demande > CURDATE() ) ) GROUP BY LP.id_logement LIMIT 18;";
			$req = $this->pdo->prepare($sql);
			$req->execute();
			$res = $req->fetchAll();
			return $res;
		} else {
			$sql = "SELECT LP.id_logement AS id_logement, (SELECT chemin_photo FROM Photos WHERE id_logement = LP.id_logement AND id_equipement IS NULL AND id_piece IS NULL LIMIT 1) AS premiere_photo, L.id_commercial AS id_commercial, L.nom_logement AS nom_logement, L.DateAjout AS DateAjout, L.nb_pieces AS nombre_pieces, L.rue_logement AS rue_logement, L.cp_logement AS cp_logement, L.ville_logement AS ville_logement 
			FROM LogementPeriode LP JOIN Logements L ON LP.id_logement = L.id_logement WHERE LP.id_logement IN (SELECT DISTINCT id_logement FROM LogementPeriode 
			WHERE (date_fin >= CURDATE() OR date_fin IS NULL) AND id_logement NOT IN (SELECT DISTINCT R.id_logement FROM Reservation R WHERE R.accept = 1 AND R.date_fin_demande > CURDATE() ) ) 
			GROUP BY LP.id_logement ORDER BY L.DateAjout DESC LIMIT 18 ;";
			$req = $this->pdo->prepare($sql);
			$req->execute();
			$res = $req->fetchAll();
			foreach ($res as &$logement) {
				$dateAjoutTimestamp = strtotime($logement['DateAjout']);
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

				$logement['DateAjout'] = "Disponible depuis " . $tempsEcoule;
			}

			return $res;
		}
	}
}
