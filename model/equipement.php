<?php

class equipement {
	
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

	public function getEquipementsByLogement($id_logement) {
    $sql = "SELECT Equipement.* FROM Equipement JOIN Pieces ON Equipement.id_piece = Pieces.id_piece WHERE Pieces.id_logement = :id";
    
    $req = $this->pdo->prepare($sql);
    $req->bindParam(':id', $id_logement, PDO::PARAM_INT);
    $req->execute();
    
    return $req->fetchAll();
}
	
}
?>