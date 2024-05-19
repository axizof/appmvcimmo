<?php
class reservation {

    // Objet PDO servant à la connexion à la base
    private $pdo;

    // Connexion à la base de données
    public function __construct() {
        $config = parse_ini_file("config.ini");

        try {
            $this->pdo = new \PDO("mysql:host=".$config["host"].";dbname=".$config["database"].";charset=utf8", $config["user"], $config["password"]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }



    public function afficherReservationClient($idClient) {
        $sql = "SELECT 
                    Reservation.*, 
                    Logements.*, 
                    Photos.chemin_photo AS premiere_photo
                FROM Reservation 
                INNER JOIN Logements ON Reservation.id_logement = Logements.id_logement 
                LEFT JOIN Photos ON Logements.id_logement = Photos.id_logement 
                WHERE Reservation.id_client=:id_client 
                    AND Photos.id_equipement IS NULL 
                    AND Photos.id_piece IS NULL 
                GROUP BY Reservation.id_reservation";
    
        $req = $this->pdo->prepare($sql);
        $req->bindParam(':id_client', $idClient, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll();
    }

    public function GetReservationDisponible($id_logement) {

        $availablePeriodsQuery = $this->pdo->prepare("SELECT date_debut , date_fin  FROM LogementPeriode WHERE id_logement = :id");
        $availablePeriodsQuery->bindParam(':id', $id_logement, PDO::PARAM_INT);
        $availablePeriodsQuery->execute();
        $availablePeriods = $availablePeriodsQuery->fetchAll(PDO::FETCH_ASSOC);


        $reservedPeriodsQuery = $this->pdo->prepare("SELECT date_debut_demande, date_fin_demande FROM Reservation WHERE id_logement = :id AND accept = 1");
        $reservedPeriodsQuery->bindParam(':id', $id_logement, PDO::PARAM_INT);
        $reservedPeriodsQuery->execute();
        $reservedPeriods = $reservedPeriodsQuery->fetchAll(PDO::FETCH_ASSOC);


        $bookableRanges = [];
        foreach($availablePeriods as $availablePeriod) {
            $start = new DateTime($availablePeriod['date_debut']);
            $end = new DateTime($availablePeriod['date_fin']);


            $interval = new DateInterval('P1D');
            $dateRange = new DatePeriod($start, $interval, $end->modify('+1 day'));

            foreach($dateRange as $date) {
                $dateString = $date->format('Y-m-d');

                $isReserved = false;
                foreach ($reservedPeriods as $reservedPeriod) {
                    if (isset($reservedPeriod['date_debut_demande']) && isset($reservedPeriod['date_fin_demande'])) {
                        if ($dateString >= $reservedPeriod['date_debut_demande'] && $dateString <= $reservedPeriod['date_fin_demande']) {
                            $isReserved = true;
                            break;
                        }
                    }
                }
                if(!$isReserved) {
                    $bookableRanges[] = $dateString;
                }
            }
        }

        return $bookableRanges;

    }

    
    
    

    public function GetPrixParJour($id_logement) {
        $availablePeriodsQuery = $this->pdo->prepare("SELECT date_debut, date_fin, prix_location FROM LogementPeriode WHERE id_logement = :id");
        $availablePeriodsQuery->bindParam(':id', $id_logement, PDO::PARAM_INT);
        $availablePeriodsQuery->execute();
        $availablePeriods = $availablePeriodsQuery->fetchAll(PDO::FETCH_ASSOC);
    
        $pricesByDay = [];
        foreach ($availablePeriods as $availablePeriod) {
            $start = new DateTime($availablePeriod['date_debut']);
            $end = new DateTime($availablePeriod['date_fin']);
            $price = $availablePeriod['prix_location'];
    
            $interval = new DateInterval('P1D');
            $dateRange = new DatePeriod($start, $interval, $end->modify('+1 day'));
    
            foreach ($dateRange as $date) {
                $dateString = $date->format('Y-m-d');
                $pricesByDay[$dateString] = $price;
            }
        }
    
        return $pricesByDay;
    }

    public function ajouterReservation($idClient, $idLogement, $datedebut, $datefin, $infoClientJson,$prixpay){
        $sql = "INSERT INTO Reservation (id_client, id_logement, date_debut_demande, date_fin_demande, infoClient,prixpay) VALUES (:idclient, :idlogement, :datedebut, :datefin,:infoClient,:prixpay)";
        $req = $this->pdo->prepare($sql);
        $req->bindParam(':idclient', $idClient, PDO::PARAM_INT);
        $req->bindParam(':idlogement', $idLogement, PDO::PARAM_INT);
        $req->bindParam(':datedebut', $datedebut, PDO::PARAM_STR);
        $req->bindParam(':datefin', $datefin, PDO::PARAM_STR);
        $req->bindParam(':prixpay', $prixpay, PDO::PARAM_STR);
        $req->bindParam(':infoClient', $infoClientJson, PDO::PARAM_STR);
        $req->execute();
        return true;
    }
    public function deleteReservation($idReservation, $idClient) {
        $sql = "DELETE FROM Reservation WHERE id_reservation = :id_reservation AND id_client = :id_client";
        $req = $this->pdo->prepare($sql);
        $req->bindParam(':id_reservation', $idReservation, PDO::PARAM_INT);
        $req->bindParam(':id_client', $idClient, PDO::PARAM_INT);
        $req->execute();
        
        if ($req->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getPendingReservationsByCommercial($comercialid) {
        $sql = "SELECT r.* 
                FROM Reservation r
                JOIN Logements l ON r.id_logement = l.id_logement
                WHERE l.id_commercial = :comercialid AND r.accept = 0";
    
        $req = $this->pdo->prepare($sql);
        $req->bindParam(':comercialid', $comercialid, PDO::PARAM_INT);
        $req->execute();
    
        return $req->fetchAll();
    }

    public function updateReservationStatus($reservationId, $newStatus) {
        $sql = "UPDATE Reservation SET accept = :newStatus WHERE id_reservation = :reservationId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_INT);
        $stmt->bindParam(':reservationId', $reservationId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

?>