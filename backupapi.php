<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "mysql.axiz.io";
$username = "flashmcqueen";
$password = "flashmcqueen0550002D";
$dbname = "immoappmvc";
session_start();


/*

SELECT * FROM `LogementPeriode` WHERE `date_debut` >= now() - INTERVAL 7 DAY;

*/

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur PDO sur Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connexion échouée : " . $e->getMessage());
}
function generateToken()
{
    return bin2hex(random_bytes(32));
}

function createClientToken($idClient, $conn)
{
    $token = generateToken();
    $expiration = date('Y-m-d H:i:s', strtotime('+1 day'));

    $stmt = $conn->prepare("INSERT INTO token (token, expiration, idclient) VALUES (?, ?, ?)");
    $stmt->execute([$token, $expiration, $idClient]);
    return $token;
}

function createCommercialToken($idCommercial, $conn)
{
    $token = generateToken();
    $expiration = date('Y-m-d H:i:s', strtotime('+1 day'));

    $stmt = $conn->prepare("INSERT INTO token (token, expiration, idcommercial) VALUES (?, ?, ?)");
    $stmt->execute([$token, $expiration, $idCommercial]);

    return $token;
}

function isValidToken($token, $conn)
{
    $currentDateTime = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("SELECT * FROM token WHERE token = ? AND expiration > ?");
    $stmt->execute([$token, $currentDateTime]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        if ($result['idclient'] != null) {
            return true;
        } elseif ($result['idcommercial'] != null) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

$rawData = file_get_contents('php://input');
$parsedData = json_decode($rawData, true);

if (!empty($parsedData)) {

    if (isset($parsedData["action"]) && $parsedData["action"] === "connectionclient" && isset($parsedData["username"]) && isset($parsedData["password"])) {
        $stmt = $conn->prepare("SELECT * FROM Client WHERE login_client = ?");
        $stmt->execute([$parsedData["username"]]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($parsedData["password"], $result["password"])) {
            $idc = $result['id_client'];
            $typec = "client";
            // if (!isValidToken($_SESSION['token'], $conn)) {
            //     $_SESSION['token'] = createClientToken($result['id_client'], $conn);
            // }
            $tokc = createClientToken($result['id_client'], $conn);
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'success', "message" => 'Vous êtes connecté', "idclient" => $result['id_client'], "type" => $typec, "token" => $tokc]);
            exit();
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Les informations de compte sont incorrectes']);
            exit();
        }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "connectioncommercial" && isset($parsedData["username"]) && isset($parsedData["password"])) {
    $stmt = $conn->prepare("SELECT * FROM Commercial WHERE login_commercial = ?");
    $stmt->execute([$parsedData["username"]]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && password_verify($parsedData["password"], $result["hashed_password"])) {
        $tokc = createCommercialToken($result['id_commercial'], $conn);
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(["status" => 'success', "message" => 'Vous êtes connecté', "idcommercial" => $result['id_commercial'], "type" => "commercial", "token" => $tokc]);
        exit();
    } else {
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(["status" => 'error', "message" => 'Les informations de compte sont incorrectes']);
        exit();
    }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "infodunereservationclient" && isset($parsedData["id_client"])) {
        /*
            Il faudra v rifier la pr sence du bon token ici avant de faire les requ tes (c'est le prof qui l'a demand )
            Ethan , Enzo sur ce code j'affiche en faite les info de reservation d'un logement reserv  par un client don l'id est pass  en param tre
            J'avais voulu faire une seule requete pour tout afficher en meme temps, infos du logement, photos, pieces etc... mais le prof m'a dit de faire  a en deux reqeutes
        */
        $sql = $conn->prepare("SELECT id_reservation, Client.id_client, Logements.id_logement, date_debut_demande, date_fin_demande, accept, nom_logement, nb_pieces, rue_logement, ville_logement 
                                FROM Reservation 
                                INNER JOIN Logements ON Reservation.id_logement = Logements.id_logement
                                INNER JOIN Client ON Client.id_client = Reservation.id_client
                                WHERE Reservation.id_client = ?");
        $sql->execute([$parsedData["id_client"]]);
        $reservationClients = $sql->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($reservationClients);
        header("Content-Type: application/json");
        echo $json;
        exit();
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "reservation" && isset($parsedData["id_client"]) && isset($parsedData["id_reservation"])) {
        /*  
            et du coup l  c'est la seconde requete qui affiche du coup les photos , pieces du logement en fonction de l'id_client et l'id_reservation
        */
        $sql = $conn->prepare("SELECT id_reservation, Logements.id_logement, id_photo, chemin_photo, Pieces.id_piece, libelle_piece, surface
                FROM Reservation 
                INNER JOIN Logements ON Logements.id_logement = Reservation.id_logement
                INNER JOIN Photos ON Photos.id_logement = Logements.id_logement
                INNER JOIN Pieces ON Pieces.id_piece = Photos.id_piece 
                WHERE id_client = ? AND id_reservation = ?");
        $sql->execute([$parsedData["id_client"], $parsedData["id_reservation"]]);
        $reservation = $sql->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($reservation);
        header("Content-Type: application/json");
        echo $json;
        exit();

        /*
            Ethan , Enzo le code en dessous pour inserer unAvis c'etait jsute  pour un test , c'est pour cela que j'ai mis les champs id_reservation, id_commercial, id_piece
            A null, pareil aussi dans la base de donn e, quand vous reprenez le projet chez vous , n'oubliez pas de retirer les champs que j'ai mis   NULL dans le code et dans la base de donn e
        */
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "insererAvisCommercial" && isset($parsedData["commentaire"]) && $parsedData["note"]) {
        $sql = $conn->prepare("INSERT INTO Avis(commentaire, id_reservation, id_commercial, note, id_piece, Checked) VALUES(?, NULL, NULL, ?, NULL, NULL)");
        $sql->execute([
            $parsedData["commentaire"],
            $parsedData["note"]
        ]);

        if ($sql->rowCount() > 0) {
            $dernierId = $conn->lastInsertId();

            $sql2 = $conn->prepare("INSERT INTO PhotoAvis(urlphoto, idAvis) VALUES(?, ?)");
            $sql2->execute([
                $parsedData["urlphoto"],
                $dernierId
            ]);

            if ($sql2->rowCount() > 0) {
                $reponse = ["succes" => true, "message" => "Avis et photo soumis avec succ s"];
            } else {
                $reponse = ["succes" => false, "message" => "Erreur lors de l'ajout de la photo"];
            }
        } else {
            $reponse = ["succes" => false, "message" => "Erreur lors de l'ajout de l'avis"];
        }
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($reponse);
        exit;

    } else if (isset($parsedData["action"]) && $parsedData["action"] === "GetLogementPourEtatdeslieuxCommercial") {
        $validtoken = false;
        $validcommercial = false;
        $tokennow = "";
        $idcommercial = 0;
        if (isset($_SESSION["token"])) {
            if (isValidToken($_SESSION["token"], $conn)) {
                $validtoken = true;
                $tokennow = $_SESSION["token"];
            } else if (isset($parsedData["token"])) {
                if (isValidToken($parsedData["token"], $conn)) {
                    $validtoken = true;
                    $tokennow = $parsedData["token"];
                } else {
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(["status" => 'error', "message" => 'Vous n\'avez pas la permission de faire  a [err-487]']);
                    exit();
                }
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Vous n\'avez pas la permission de faire  a [err-488]']);
                exit();
            }
        }
        if (isset($_SESSION["id"]) && $_SESSION['type'] == "commercial") {
            $validcommercial = true;
        } else {
            $stmt = $conn->prepare("SELECT `idcommercial` FROM `token` WHERE `token` = ?");
            $stmt->execute([$tokennow]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result["idcommercial"] == null) {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Vous n\'avez pas la permission de faire  a [err-489]']);
                exit();
            } else {
                $validcommercial = true;
            }
        }
        if ($validtoken && $validcommercial) {
            $stmt = $conn->prepare("SELECT L.* FROM `Reservation` R INNER JOIN Logements L ON R.`id_logement` = L.id_logement WHERE `accept` = 1 AND L.id_commercial = ? ORDER BY `date_debut_demande` ASC;");
            $stmt->execute([$idcommercial]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'success', "message" => 'Voici vos Etat des lieux', "logementEtat" => $result]);
            exit();
        }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "GetPiecePourEtatdeslieuxCommercial" && isset($parsedData["idlog"])) {
        $validtoken = false;
        $validcommercial = false;
        $tokennow = "";
        $idcommercial = 0;
        if (isset($_SESSION["token"])) {
            if (isValidToken($_SESSION["token"], $conn)) {
                $validtoken = true;
                $tokennow = $_SESSION["token"];
            } else if (isset($parsedData["token"])) {
                if (isValidToken($parsedData["token"], $conn)) {
                    $validtoken = true;
                    $tokennow = $parsedData["token"];
                } else {
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(["status" => 'error', "message" => 'Vous n\'avez pas la permission de faire  a [err-487]']);
                    exit();
                }
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Vous n\'avez pas la permission de faire  a [err-488]']);
                exit();
            }
        }
        if (isset($_SESSION["id"]) && $_SESSION['type'] == "commercial") {
            $validcommercial = true;
        } else {
            $stmt = $conn->prepare("SELECT `idcommercial` FROM `token` WHERE `token` = ?");
            $stmt->execute([$tokennow]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result["idcommercial"] == null) {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Vous n\'avez pas la permission de faire  a [err-489]']);
                exit();
            } else {
                $validcommercial = true;
            }
        }
        if ($validtoken && $validcommercial) {
            $stmt = $conn->prepare("SELECT P.* FROM `Pieces` P WHERE `id_logement` = ?");
            $stmt->execute([$parsedData["idlog"]]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'success', "message" => 'Voici Les pi ces pour les  tats des lieux', "logementPiece" => $result]);
            exit();
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'donn es incorrect']);
            exit();
        }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "GetEquipementPourEtatdeslieuxDePieceCommercial" && isset($parsedData["idPiece"])) {
        $validtoken = false;
        $validcommercial = false;
        $tokennow = "";
        $idcommercial = 0;
        if (isset($_SESSION["token"])) {
            if (isValidToken($_SESSION["token"], $conn)) {
                $validtoken = true;
                $tokennow = $_SESSION["token"];
            } else if (isset($parsedData["token"])) {
                if (isValidToken($parsedData["token"], $conn)) {
                    $validtoken = true;
                    $tokennow = $parsedData["token"];
                } else {
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(["status" => 'error', "message" => 'Vous n\'avez pas la permission de faire  a [err-490]']);
                    exit();
                }
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Vous n\'avez pas la permission de faire  a [err-491]']);
                exit();
            }
        }
        if (isset($_SESSION["id"]) && $_SESSION['type'] == "commercial") {
            $validcommercial = true;
        }

    } else {
        $stmt = $conn->prepare("SELECT `idcommercial` FROM `token` WHERE `token` = ?");
        $stmt->execute([$tokennow]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result["idcommercial"] == null) {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Vous n\'avez pas la permission de faire  a [err-492]']);
            exit();
        } else {
            $validcommercial = true;
        }
    }
    if ($validtoken && $validcommercial) {
        $stmt = $conn->prepare("SELECT * FROM `Equipement` WHERE `id_piece` = ?");
        $stmt->execute([$parsedData["idPiece"]]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(["status" => 'success', "message" => 'Voici Les Equipement pour la Piece demander ', "PieceEquipement" => $result]);
        exit();
    }

}
?>