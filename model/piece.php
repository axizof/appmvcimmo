<?php
    class piece {
        
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


        //Rcuperer toutes les pièces
        public function getAll(){
            $sql = "SELECT * FROM Pieces";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $stmt->fetchAll();
        }

        public function getInfosPiece($id_logement){
            $sql = "SELECT * FROM Pieces WHERE id_logement = :id";
            $req = $this->pdo->prepare($sql);
            $req->bindParam(':id', $id_logement, PDO::PARAM_INT);
            $req->execute();


            $pieces = $req->fetchAll();


            if ($pieces) {
                foreach ($pieces as &$piece) {
                    $piece['libelle_piece'] = preg_replace('/\s+\d+-\d+/', '', $piece['libelle_piece']);
                }
            }

            return $pieces;
        }

        
    }

?>