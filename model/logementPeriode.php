<?php

class logementPeriode
{

	private $pdo;

	public function __construct()
	{
		$config = parse_ini_file("config.ini");

		try {
			$this->pdo = new \PDO("mysql:host=" . $config["host"] . ";dbname=" . $config["database"] . ";charset=utf8", $config["user"], $config["password"]);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function infoLogementPeriode($id_logement)
{
    $sql = "SELECT IF(date_debut <= CURDATE(), prix_location, (SELECT prix_location FROM LogementPeriode WHERE id_logement = :id AND date_debut > CURDATE() ORDER BY date_debut ASC LIMIT 1)) 
	AS prix_location FROM LogementPeriode WHERE id_logement = :id ORDER BY date_debut DESC LIMIT 1"; 
    $req = $this->pdo->prepare($sql);
    $req->bindParam(':id', $id_logement, PDO::PARAM_INT);
    $req->execute();
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    return !empty($result) ? (int)$result[0]['prix_location'] : null;
}	

	public function getPrix($id_logement){
		$sql = "SELECT prix_location FROM LogementPeriode WHERE id_logement = :id";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id', $id_logement, PDO::PARAM_INT);
		$req->execute();
		return $req->fetch();
	}


	public function GetPeriodesLogement2($id_logement) {
        $periodesQuery = $this->pdo->prepare("SELECT date_debut, date_fin FROM LogementPeriode WHERE id_logement = :id");
        $periodesQuery->bindParam(':id', $id_logement, PDO::PARAM_INT);
        $periodesQuery->execute();
        $periodes = $periodesQuery->fetchAll(PDO::FETCH_ASSOC);
    
        $joursPeriodes = [];
        foreach ($periodes as $periode) {
            $start = new DateTime($periode['date_debut']);
            $end = new DateTime($periode['date_fin']);
    
            $interval = new DateInterval('P1D');
            $dateRange = new DatePeriod($start, $interval, $end->modify('+1 day'));
    
            foreach ($dateRange as $date) {
                $dateString = $date->format('Y-m-d');
                $joursPeriodes[] = $dateString;
            }
        }
    
        return $joursPeriodes;
    }
    public function GetPeriodesListComplete($id_logement) {
        $sql = "SELECT * FROM LogementPeriode WHERE id_logement = :id";
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id', $id_logement, PDO::PARAM_INT);
		$req->execute();
		return $req->fetchAll();
    }
    public function modifierPrixPeriode($id_periode, $nouveau_prix) {
        $sql = "UPDATE LogementPeriode SET prix_location = :nouveau_prix WHERE id_periode = :id_periode";
        $req = $this->pdo->prepare($sql);
        $req->bindParam(':nouveau_prix', $nouveau_prix, PDO::PARAM_STR);
        $req->bindParam(':id_periode', $id_periode, PDO::PARAM_INT);
        $req->execute();
        return true;
    }

    public function supprimerPeriodeEtReservations($id_periode) {
        $sql_reservations = "DELETE FROM Reservation WHERE id_logement = (SELECT id_logement FROM LogementPeriode WHERE id_periode = :id_periode)
            AND (date_debut_demande BETWEEN (SELECT date_debut FROM LogementPeriode WHERE id_periode = :id_periode) 
            AND (SELECT date_fin FROM LogementPeriode WHERE id_periode = :id_periode)
            OR date_fin_demande BETWEEN (SELECT date_debut FROM LogementPeriode WHERE id_periode = :id_periode) 
            AND (SELECT date_fin FROM LogementPeriode WHERE id_periode = :id_periode))";
        
        $req_reservations = $this->pdo->prepare($sql_reservations);
        $req_reservations->bindParam(':id_periode', $id_periode, PDO::PARAM_INT);
        $req_reservations->execute();
    
        $sql_periode = "DELETE FROM LogementPeriode WHERE id_periode = :id_periode";
        $req_periode = $this->pdo->prepare($sql_periode);
        $req_periode->bindParam(':id_periode', $id_periode, PDO::PARAM_INT);
        $req_periode->execute();
        return true;
    }

    public function ajouterPeriodeLogement($idLogement, $premiereDate, $autreDate, $prixPeriode) {
        $sql = "SELECT * FROM LogementPeriode 
                WHERE id_logement = :idLogement 
                AND NOT (date_fin < :premiereDate OR date_debut > :autreDate)";
    
        $req = $this->pdo->prepare($sql);
        $req->bindParam(':idLogement', $idLogement, PDO::PARAM_INT);
        $req->bindParam(':premiereDate', $premiereDate);
        $req->bindParam(':autreDate', $autreDate);
        $req->execute();
        $existingPeriods = $req->fetchAll();
    
        if (count($existingPeriods) > 0) {
            return "Une période pour ce logement existe déjà pendant la période spécifiée.";
        } else {
            $sqlInsert = "INSERT INTO LogementPeriode (id_logement, date_debut, date_fin, prix_location) 
                          VALUES (:idLogement, :premiereDate, :autreDate, :prixPeriode)";
    
            $reqInsert = $this->pdo->prepare($sqlInsert);
            $reqInsert->bindParam(':idLogement', $idLogement, PDO::PARAM_INT);
            $reqInsert->bindParam(':premiereDate', $premiereDate);
            $reqInsert->bindParam(':autreDate', $autreDate);
            $reqInsert->bindParam(':prixPeriode', $prixPeriode);
    
            if ($reqInsert->execute()) {
                return "La période du $premiereDate au $autreDate a été ajoutée avec succès pour le logement $idLogement.";
            } else {
                return "Une erreur est survenue lors de l'ajout de la période pour le logement $idLogement.";
            }
        }
    }
}
