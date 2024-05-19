<?php

class photos {
	
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
	
	public function getLogementPhotos($idlog){
		if(isset($idlog)){
			$sql = "SELECT * FROM Photos WHERE id_logement = :id AND id_piece IS NULL AND id_equipement IS NULL";
			$req = $this->pdo->prepare($sql);
			$req->bindParam(':id', $idlog, PDO::PARAM_INT);
			$req->execute();
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}
	}
	public function getPiecePhotos($idlog, $idPiece){
		if(isset($idlog) && isset($idPiece)){
			$sql = "SELECT * FROM Photos WHERE id_logement = :id AND id_piece = :idPiece";
			$req = $this->pdo->prepare($sql);
			$req->bindParam(':id', $idlog, PDO::PARAM_INT);
			$req->bindParam(':idPiece', $idPiece, PDO::PARAM_INT);
			$req->execute();
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}
	}

	public function getEquipementPhotos($idlog, $idEquipement){
		if(isset($idlog) && isset($idEquipement)){
			$sql = "SELECT * FROM Photos WHERE id_logement = :id AND id_equipement = :idEquipement";
			$req = $this->pdo->prepare($sql);
			$req->bindParam(':id', $idlog, PDO::PARAM_INT);
			$req->bindParam(':idEquipement', $idEquipement, PDO::PARAM_INT);
			$req->execute();
			return $req->fetchAll(PDO::FETCH_ASSOC);
		}
	}

	public function getAllLogementPhotos($idlog){
    if(isset($idlog)){
        $sql = "SELECT * FROM Photos WHERE id_logement = :id ORDER BY id_piece IS NULL DESC, id_equipement IS NULL DESC";
        $req = $this->pdo->prepare($sql);
        $req->bindParam(':id', $idlog, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}

}
?>