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

function canDoCheckOutInspection($idReservation, $conn) {
    $currentDateTime = date('Y-m-d H:i:s');
    $threeDaysBefore = date('Y-m-d H:i:s', strtotime('-3 days'));
    $oneWeekAfter = date('Y-m-d H:i:s', strtotime('+1 week'));

    $stmt = $conn->prepare("SELECT date_fin_demande FROM Reservation WHERE id_reservation = ?");
    $stmt->execute([$idReservation]);
    $dateFinReservation = $stmt->fetchColumn();

    if ($dateFinReservation) {
        // Convertir la date de fin de réservation en objet DateTime
        $dateFinReservationObj = new DateTime($dateFinReservation);

        // Vérifier si la date actuelle est entre 3 jours avant et 1 semaine après la date de fin de réservation
        if ($currentDateTime >= $threeDaysBefore && $currentDateTime <= $oneWeekAfter && $currentDateTime >= $dateFinReservationObj->modify('-3 days')->format('Y-m-d H:i:s')) {
            return true;
        }
    }
    return false;
}

function getUserTypeFromToken($token, $conn) {
    $stmt = $conn->prepare("SELECT idclient, idcommercial FROM token WHERE token = ?");
    $stmt->execute([$token]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        if ($result['idclient'] !== null) {
            return "client";
        } elseif ($result['idcommercial'] !== null) {
            return "commercial";
        } else {
            return "inconnu";
        }
    } else {
        return "invalide";
    }
}

$rawData = file_get_contents('php://input');
$parsedData = json_decode($rawData, true);

if (!empty($parsedData)) {

    if (isset($parsedData["action"]) && $parsedData["action"] === "connection" && isset($parsedData["username"]) && isset($parsedData["password"])) {
        $stmt = $conn->prepare("SELECT id_client AS id, password, null AS hashed_password FROM Client WHERE login_client = ? 
                                UNION 
                                SELECT id_commercial AS id, null AS password, hashed_password FROM Commercial WHERE login_commercial = ?");
        $stmt->execute([$parsedData["username"], $parsedData["username"]]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result && (($result['password'] && password_verify($parsedData["password"], $result["password"])) || ($result['hashed_password'] && password_verify($parsedData["password"], $result["hashed_password"])))) {
            $id = $result['id'];
            $type = ($result['password']) ? "client" : "commercial";
            $token = ($type === "client") ? createClientToken($id, $conn) : createCommercialToken($id, $conn);
    
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'success', "message" => 'Vous êtes connecté', "id" => $id, "type" => $type, "token" => $token]);
            exit();
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Les informations de compte sont incorrectes']);
            exit();
        }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "GetLogementEtatDesLieux") {
    $validtoken = false;
    $tokennow = "";

    if (isset($parsedData["token"])) {
        if (isValidToken($parsedData["token"], $conn)) {
            $validtoken = true;
            $tokennow = $parsedData["token"];
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
            exit();
        }
    } else {
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(["status" => 'error', "message" => 'Token manquant']);
        exit();
    }

    if ($validtoken) {
        $stmt = $conn->prepare("SELECT idclient, idcommercial FROM token WHERE token = ?");
        $stmt->execute([$tokennow]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $type = "";
        $iduser = 0;
        if ($result) {
            if ($result['idclient'] !== null) {
                $type = "client";
                $iduser = $result['idclient'];
            } elseif ($result['idcommercial'] !== null) {
                $type = "commercial";
                $iduser = $result['idcommercial'];
            } else {
                echo "Impossible de déterminer le type d'utilisateur à partir du token";
            }
        } else {
            echo "Token invalide ou non trouvé";
        }

        $currentDateTime = date('Y-m-d H:i:s');
        $oneWeekBefore = date('Y-m-d H:i:s', strtotime('-1 week'));
        $oneWeekAfter = date('Y-m-d H:i:s', strtotime('+1 week'));
        
        // Utilisation d'une sous-requête pour vérifier si un état des lieux existe déjà pour chaque logement
        if ($type == "commercial"){
            $stmt = $conn->prepare("SELECT Logements.* , Reservation.id_reservation,Reservation.date_debut_demande
            FROM Reservation 
            INNER JOIN Logements ON Reservation.id_logement = Logements.id_logement
            WHERE Reservation.accept = 2 
            AND (Reservation.date_debut_demande BETWEEN ? AND ? OR Reservation.date_fin_demande BETWEEN ? AND ?)
            AND Logements.id_commercial = ?
            AND EXISTS (
                SELECT 1 FROM Etat_Lieux WHERE Etat_Lieux.id_reservation = Reservation.id_reservation AND Etat_Lieux.statut < 5
            )");
            $stmt->execute([$oneWeekBefore, $oneWeekAfter, $oneWeekBefore, $oneWeekAfter, $iduser]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'success', "message" => 'Voici les logements pour l\'état des lieux', "logements" => $result]);
            exit();
        } else {
            $stmt = $conn->prepare("SELECT Logements.* ,Reservation.id_reservation,Reservation.date_debut_demande
            FROM Reservation 
            INNER JOIN Logements ON Reservation.id_logement = Logements.id_logement
            WHERE Reservation.accept = 2 
            AND (Reservation.date_debut_demande BETWEEN ? AND ? OR Reservation.date_fin_demande BETWEEN ? AND ?)
            AND Reservation.id_client = ?
            AND EXISTS (
                SELECT 1 FROM Etat_Lieux WHERE Etat_Lieux.id_reservation = Reservation.id_reservation AND Etat_Lieux.statut < 5
            )");
            $stmt->execute([$oneWeekBefore, $oneWeekAfter, $oneWeekBefore, $oneWeekAfter, $iduser]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'success', "message" => 'Voici les logements pour l\'état des lieux', "logements" => $result]);
            exit();
        }
    }
} else if (isset($parsedData["action"]) && $parsedData["action"] === "GetLogementPieces") {
        $validtoken = false;
        $tokennow = "";
    
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
    
        if ($validtoken) {
            $stmt = $conn->prepare("SELECT idclient, idcommercial FROM token WHERE token = ?");
            $stmt->execute([$tokennow]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $type = "";
            $iduser = 0;
            if ($result) {
                if ($result['idclient'] !== null) {
                    $type = "client";
                    $iduser = $result['idclient'];
                } elseif ($result['idcommercial'] !== null) {
                    $type = "commercial";
                    $iduser = $result['idcommercial'];
                } else {
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(["status" => 'error', "message" => 'Token Invalide']);
                    exit();
                }
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token Invalide ou non trouver']);
                exit();
            }
            if (isset($parsedData["idreservation"])) {
                $stmt = $conn->prepare("SELECT id_logement FROM Reservation WHERE id_reservation = ?");
                $stmt->execute([$parsedData["idreservation"]]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                $parsedData["id_logement"] = $res["id_logement"];
            }
            if (isset($parsedData["id_logement"])) {
                $id_logement = $parsedData["id_logement"];
    
                $stmt = $conn->prepare("
                    SELECT Pieces.id_piece, Pieces.libelle_piece, Pieces.surface, Photos.chemin_photo
                    FROM Pieces
                    LEFT JOIN Photos ON Pieces.id_piece = Photos.id_piece
                    WHERE Pieces.id_logement = ?
                ");
                $stmt->execute([$id_logement]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'success', "message" => 'Informations sur les pièces du logement récupérées', "pieces" => $result]);
                exit();
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'L\'ID du logement est manquant']);
                exit();
            }
        }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "InfoEtatLieux") {
        $validtoken = false;
        $tokennow = "";
    
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
    
        if ($validtoken) {
            $stmt = $conn->prepare("SELECT idcommercial FROM token WHERE token = ?");
            $stmt->execute([$tokennow]);
            $idcommercial = $stmt->fetchColumn();
    
            if ($idcommercial !== null) {
                if (isset($parsedData["id_reservation"])) {
                    $id_reservation = $parsedData["id_reservation"];
                    

                    $stmt = $conn->prepare("SELECT * FROM Etat_Lieux WHERE id_reservation = ?");
                    $stmt->execute([$id_reservation]);
                    $etat_lieux = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($etat_lieux === false) {
                        $stmt = $conn->prepare("INSERT INTO Etat_Lieux (id_reservation, statut) VALUES (?, 0)");
                        $stmt->execute([$id_reservation]);
                        $new_id_etat = $conn->lastInsertId();
                        $stmt = $conn->prepare("SELECT * FROM Etat_Lieux WHERE id_etat = ?");
                        $stmt->execute([$new_id_etat]);
                        $new_etat_lieux = $stmt->fetch(PDO::FETCH_ASSOC);

                        $stmt2 = $conn->prepare("SELECT Logements.id_logement
                        FROM Reservation
                        INNER JOIN Logements ON Reservation.id_logement = Logements.id_logement
                        WHERE Reservation.id_reservation = ?
                        ");
                        $stmt2->execute([$new_etat_lieux["id_reservation"]]);
                        $id_logement = $stmt2->fetchColumn();
                        if (isset($id_logement)) {
                
                            $stmt = $conn->prepare("
                                SELECT Pieces.id_piece, Pieces.libelle_piece, Pieces.surface, Photos.chemin_photo
                                FROM Pieces
                                LEFT JOIN Photos ON Pieces.id_piece = Photos.id_piece
                                WHERE Pieces.id_logement = ?
                            ");
                            $stmt->execute([$id_logement]);
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                            header("Content-Type: application/json; charset=utf-8");
                            echo json_encode(["status" => 'success', "message" => 'Nouvel état des lieux créé pour la réservation', "etat_lieux" => $new_etat_lieux , "pieces" => $result]);
                            exit();

                        } else  {
                            header("Content-Type: application/json; charset=utf-8");
                            echo json_encode(["status" => 'error', "message" => 'L\'ID du logement est manquant']);
                            exit();
                        }
                    } else if ($etat_lieux["statut"] <= 2 && $etat_lieux["statut"] >= 0) {
                        $stmt3 = $conn->prepare("SELECT Logements.id_logement
                        FROM Reservation
                        INNER JOIN Logements ON Reservation.id_logement = Logements.id_logement
                        WHERE Reservation.id_reservation = ?
                        ");
                        $stmt3->execute([$etat_lieux["id_reservation"]]);
                        $id_logement2 = $stmt3->fetchColumn();
                        if (isset($id_logement2)) {
                            $stmt = $conn->prepare("
                                SELECT Pieces.id_piece, Pieces.libelle_piece, Pieces.surface, Photos.chemin_photo
                                FROM Pieces
                                LEFT JOIN Photos ON Pieces.id_piece = Photos.id_piece
                                WHERE Pieces.id_logement = ?
                            ");
                            $stmt->execute([$id_logement2]);
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            header("Content-Type: application/json; charset=utf-8");
                            echo json_encode(["status" => 'success', "message" => 'état des lieux', "etat_lieux" => $etat_lieux , "pieces" => $result]);
                            exit();
                    } else {
                        header("Content-Type: application/json; charset=utf-8");
                        echo json_encode(["status" => 'error', "message" => 'Erreur sur l\'obtention des pièces de l\'état des lieux', "etat_lieux" => $etat_lieux]);
                        exit();
                    }
                } else {
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(["status" => 'error', "message" => 'ID de réservation manquant']);
                    exit();
                }
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide pour un commercial']);
                exit();
            }
        }
    }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "validenext") {
        $validtoken = false;
        $tokennow = "";
    
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
    
        if ($validtoken) {
            $stmt = $conn->prepare("SELECT idcommercial FROM token WHERE token = ?");
            $stmt->execute([$tokennow]);
            $idcommercial = $stmt->fetchColumn();
    
            if ($idcommercial !== null) {
                if (isset($parsedData["id_reservation"])) {
                    $id_reservation = $parsedData["id_reservation"];
    
                    // Vérifier le statut de l'état des lieux
                    $stmt = $conn->prepare("SELECT statut FROM Etat_Lieux WHERE id_reservation = ?");
                    $stmt->execute([$id_reservation]);
                    $etat_lieux_statut = $stmt->fetchColumn();
    
                    if ($etat_lieux_statut === 0) {
                        // Vérifier si toutes les pièces ont une note
                        $stmt = $conn->prepare("
                            SELECT COUNT(*) 
                            FROM Conversation_Etat_Lieux 
                            WHERE id_etat = (
                                SELECT id_etat 
                                FROM Etat_Lieux 
                                WHERE id_reservation = ? 
                                LIMIT 1
                            ) 
                            AND id_piece IS NOT NULL
                            AND noteco IS NOT NULL
                        ");
                        $stmt->execute([$id_reservation]);
                        $pieces_with_notes_count = $stmt->fetchColumn();
    
                        // Vérifier si tous les équipements ont une note
                        $stmt = $conn->prepare("
                            SELECT COUNT(*) 
                            FROM Conversation_Etat_Lieux 
                            WHERE id_etat = (
                                SELECT id_etat 
                                FROM Etat_Lieux 
                                WHERE id_reservation = ? 
                                LIMIT 1
                            ) 
                            AND id_equipement IS NOT NULL
                            AND noteco IS NOT NULL
                        ");
                        $stmt->execute([$id_reservation]);
                        $equipments_with_notes_count = $stmt->fetchColumn();
    
                        // Vérifier si le nombre de pièces et d'équipements avec notes est égal au nombre total de pièces et d'équipements
                        $stmt = $conn->prepare("
                            SELECT COUNT(*) 
                            FROM Pieces 
                            WHERE id_logement = (
                                SELECT id_logement 
                                FROM Reservation 
                                WHERE id_reservation = ? 
                                LIMIT 1
                            )
                        ");
                        $stmt->execute([$id_reservation]);
                        $total_pieces_count = $stmt->fetchColumn();
    
                        $stmt = $conn->prepare("
                            SELECT COUNT(*) 
                            FROM Equipement
                            INNER JOIN Reservation
                            WHERE id_piece = (
                                SELECT id_piece 
                                FROM Pieces 
                                WHERE id_logement = ? 
                                LIMIT 1
                            )
                        ");
                        $stmt->execute([$id_reservation]);
                        $total_equipments_count = $stmt->fetchColumn();
    
                        if ($pieces_with_notes_count >= $total_pieces_count && $equipments_with_notes_count >= $total_equipments_count) {
                            header("Content-Type: application/json; charset=utf-8");
                            echo json_encode(["status" => 'success', "message" => 'Toutes les pièces et équipements ont une note']);
                            exit();
                        } else {
                            header("Content-Type: application/json; charset=utf-8");
                            echo json_encode(["status" => 'error', "message" => 'Toutes les pièces et équipements n\'ont pas de note']);
                            exit();
                        }
                    } else {
                        header("Content-Type: application/json; charset=utf-8");
                        echo json_encode(["status" => 'error', "message" => 'L\'état des lieux n\'est pas en attente de validation']);
                        exit();
                    }
                } else {
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(["status" => 'error', "message" => 'ID de réservation manquant']);
                    exit();
                }
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide pour un commercial']);
                exit();
            }
        }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "infoetatreservation"){
        $validtoken = false;
        $tokennow = "";
    
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
        if ($validtoken) {
            if (isset($parsedData["idreservation"])){
                $stmt = $conn->prepare("SELECT * FROM Etat_Lieux WHERE id_reservation = ?");
                $stmt->execute([$parsedData["idreservation"]]);
                $etat_lieux = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($etat_lieux === false) {
                    $stmt = $conn->prepare("INSERT INTO Etat_Lieux (id_reservation, statut) VALUES (?, 0)");
                    $stmt->execute([$parsedData["idreservation"]]);
                    $new_id_etat = $conn->lastInsertId();
                    $stmt = $conn->prepare("SELECT * FROM Etat_Lieux WHERE id_etat = ?");
                    $stmt->execute([$new_id_etat]);
                    $new_etat_lieux = $stmt->fetch(PDO::FETCH_ASSOC);
                    header("Content-Type: application/json; charset=utf-8");
                    $usertype = getUserTypeFromToken($tokennow, $conn);
                    echo json_encode(["status" => 'success', "message" => 'information sur l`etat des lieux', "etatlieux" => $new_etat_lieux, "usertype" => $usertype]);
                    exit();
                } else {
                    $usertype = getUserTypeFromToken($tokennow, $conn);
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(["status" => 'success', "message" => 'information sur l`etat des lieux', "etatlieux" => $etat_lieux, "usertype" => $usertype]);
                    exit();
                }
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'il manque la reservation']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token invalid']);
            exit();
        }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "candoout"){
        $validtoken = false;
        $tokennow = "";
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
        if ($validtoken) {
            if (isset($parsedData["idreservation"])){
                    if (canDoCheckOutInspection($parsedData["idreservation"],$conn)){
                        header("Content-Type: application/json; charset=utf-8");
                        echo json_encode(["status" => 'success', "message" => 'information récupéré', "candoout" => "true"]);
                        exit();
                    } else {
                        header("Content-Type: application/json; charset=utf-8");
                        echo json_encode(["status" => 'error', "message" => 'il n\'est pas encore possible de faire un état des lieux de sortie', "candoout" => "false"]);
                        exit();
                    }
                } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'il manque la reservation']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token invalid']);
            exit();
        }

     } else if (isset($parsedData["action"]) && $parsedData["action"] === "getlogidfromres"){
        $validtoken = false;
        $tokennow = "";
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
        if ($validtoken) {
            if (isset($parsedData["idreservation"])){
                $stmt = $conn->prepare("SELECT id_logement FROM Reservation WHERE id_reservation = ?");
                $stmt->execute([$parsedData["idreservation"]]);
                $logementId = $stmt->fetchColumn();
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'success', "message" => 'logement id récupéré', "logementId" => $logementId]);
                exit();
                } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'il manque la reservation']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token invalid']);
            exit();
        }

    } else if (isset($parsedData["action"]) && $parsedData["action"] === "getequipementfrompiece") {
        $validtoken = false;
        $tokennow = "";
    
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
    
        if ($validtoken) {
            if (isset($parsedData["idpiece"])) {
                $idPiece = $parsedData["idpiece"];
    
                $stmt = $conn->prepare("SELECT * FROM Equipement WHERE id_piece = ?");
                $stmt->execute([$idPiece]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'success', "message" => 'Liste des équipements de la pièce récupérée', "equipements" => $result]);
                exit();
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'ID de la pièce manquant']);
                exit();
            }
        }
     } else if (isset($parsedData["action"]) && $parsedData["action"] === "getstartpiece") {
        $validtoken = false;
        $tokennow = "";
    
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
    
        if ($validtoken) {
            if (isset($parsedData["id_etat"]) && isset($parsedData["id_piece"])) {
                $idEtat = $parsedData["id_etat"];
                $idPiece = $parsedData["id_piece"];
                $type = $parsedData["type"];
                $stmt = $conn->prepare("SELECT noteco FROM Conversation_Etat_Lieux WHERE id_etat = ? AND id_piece = ? AND type = ?");
                $stmt->execute([$idEtat, $idPiece,$type]);
                $note = $stmt->fetchColumn();
    
                if ($note !== false) {
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(["status" => 'success', "message" => 'Note de la pièce récupérée', "note" => $note]);
                    exit();
                } else {
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(["status" => 'error', "message" => 'Aucune note trouvée pour cette pièce dans cet état des lieux']);
                    exit();
                }
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'ID de l\'état des lieux ou ID de la pièce manquant']);
                exit();
            }
        }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "updatenotepiece") {
        $validtoken = false;
        $tokennow = "";
    
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
    
        if ($validtoken) {
            if (isset($parsedData["id_etat"]) && isset($parsedData["id_piece"]) && isset($parsedData["note"])) {
                $idEtat = $parsedData["id_etat"];
                $idPiece = $parsedData["id_piece"];
                $note = $parsedData["note"];
                $type = $parsedData["type"];
    
                // Vérifier si une note existe déjà pour cette pièce dans cet état des lieux
                $stmt = $conn->prepare("SELECT id_conversation FROM Conversation_Etat_Lieux WHERE id_etat = ? AND id_piece = ? AND type = ?");
                $stmt->execute([$idEtat, $idPiece,$type]);
                $existingConversation = $stmt->fetchColumn();
    
                if ($existingConversation) {
                    // Mettre à jour la note existante
                    $stmt = $conn->prepare("UPDATE Conversation_Etat_Lieux SET noteco = ? WHERE id_conversation = ?");
                    $stmt->execute([$note, $existingConversation]);
    
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(["status" => 'success', "message" => 'Note de la pièce mise à jour avec succès']);
                    exit();
                } else {
                    // Insérer une nouvelle note
                    $stmt = $conn->prepare("INSERT INTO Conversation_Etat_Lieux (id_etat, noteco, id_piece) VALUES (?, ?, ?)");
                    $stmt->execute([$idEtat, $note, $idPiece]);
    
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(["status" => 'success', "message" => 'Nouvelle note de la pièce ajoutée avec succès']);
                    exit();
                }
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'ID de l\'état des lieux, ID de la pièce ou note manquant']);
                exit();
            }
        }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "getconversationetat") {
        $validtoken = false;
        $tokennow = "";
    
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
    
        if ($validtoken) {
            if (isset($parsedData["id_etat"]) && isset($parsedData["idpiece"])) {
                $idEtat = $parsedData["id_etat"];
                $idPiece = $parsedData["idpiece"];
                $type = $parsedData["type"];
                
                // Récupérer la conversation de l'état des lieux
                $stmt = $conn->prepare("SELECT * FROM Conversation_Etat_Lieux WHERE id_etat = ? AND id_piece = ? AND type = ? ORDER BY datepost ASC");
                $stmt->execute([$idEtat,$idPiece,$type]);
                $conversation = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'success', "message" => 'Conversation de l\'état des lieux récupérée', "conversation" => $conversation]);
                exit();
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'ID de l\'état des lieux ou id piece manquant']);
                exit();
            }
        }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "getetatstatus") {
        $validtoken = false;
        $tokennow = "";
    
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
    
        if ($validtoken) {
            if (isset($parsedData["id_etat"])) {
                $idEtat = $parsedData["id_etat"];
    
                // Récupérer la conversation de l'état des lieux
                $stmt = $conn->prepare("SELECT statut FROM Etat_Lieux WHERE id_etat = ?");
                $stmt->execute([$idEtat]);
                $statut = $stmt->fetchColumn();
    
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'success', "message" => 'status recup', "statut" => $statut]);
                exit();
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'ID de l\'état des lieux manquant']);
                exit();
            }
        }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "getidfromtoken") {
        $validtoken = false;
        $tokennow = "";
    
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
    
        if ($validtoken) {
            $stmt = $conn->prepare("SELECT idclient, idcommercial FROM token WHERE token = ?");
            $stmt->execute([$tokennow]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                if ($result['idclient'] !== null) {
                    $type = "client";
                    $iduser = $result['idclient'];
                } elseif ($result['idcommercial'] !== null) {
                    $type = "commercial";
                    $iduser = $result['idcommercial'];
                } else {
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(["status" => 'error', "message" => 'Impossible de déterminer le type d\'utilisateur à partir du token']);
                    exit();
                }
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'success', "message" => 'ID de l\'utilisateur récupéré', "type" => $type, "id_user" => $iduser]);
                exit();
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou non trouvé']);
                exit();
            }
        }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "insertConversationEtatLieux") {
        $validtoken = false;
        $tokennow = "";
    
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
    
        if ($validtoken) {
            $userType = getUserTypeFromToken($tokennow, $conn);
            if ($userType === "client" || $userType === "commercial") {
                $stmt = $conn->prepare("SELECT idclient, idcommercial FROM token WHERE token = ?");
                $stmt->execute([$tokennow]);
                $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
                $id_client = null;
                $id_commercial = null;
                if ($userType === "client") {
                    $id_client = $result2["idclient"];
                } elseif ($userType === "commercial") {
                    $id_commercial = $result2["idcommercial"];
                }
    
                $id_etat = $parsedData["id_etat"];
                $id_equipement = $parsedData["id_equipement"];
                $type = $parsedData["type"];
                $message = isset($parsedData["message"]) ? $parsedData["message"] : null;
                $photo = isset($parsedData["photo"]) ? $parsedData["photo"] : null;
                $noteco = isset($parsedData["noteco"]) ? $parsedData["noteco"] : null;
    
                // Vérification obligatoire de la présence de noteco
                if ($noteco === null) {
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(["status" => 'error', "message" => 'La note de la conversation est obligatoire']);
                    exit();
                }
    
                // Insertion de la conversation dans la table Conversation_Etat_Lieux
                $stmt = $conn->prepare("INSERT INTO Conversation_Etat_Lieux (id_commercial, id_client, id_etat, id_equipement, type, message, chemin_photo, noteco) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$id_commercial, $id_client, $id_etat, $id_equipement, $type, $message, $photo, $noteco]);
    
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'success', "message" => 'Conversation ajoutée avec succès']);
                exit();
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Type d\'utilisateur invalide']);
                exit();
            }
        }
    } else if (isset($parsedData["action"]) && $parsedData["action"] === "modifystatusetatlieux") {
        $validtoken = false;
        $tokennow = "";
    
        if (isset($parsedData["token"])) {
            if (isValidToken($parsedData["token"], $conn)) {
                $validtoken = true;
                $tokennow = $parsedData["token"];
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Token invalide ou expiré']);
                exit();
            }
        } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Token manquant']);
            exit();
        }
    
        if ($validtoken) {
            if (!isset($parsedData["id_etat"])){
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'id état manquant']);
                exit();
            }
            // Récupérer le type de compte associé au token
            $stmt = $conn->prepare("SELECT idcommercial, idclient FROM token WHERE token = ?");
            $stmt->execute([$tokennow]);
            $account_type = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Récupérer le statut actuel de l'état des lieux
            $stmt = $conn->prepare("SELECT statut FROM Etat_Lieux WHERE id_etat = ?");
            $stmt->execute([$parsedData["id_etat"]]);
            $current_status = $stmt->fetchColumn();
    
            // Vérifier le type de compte et autoriser la modification du statut en conséquence
            if ($account_type['idcommercial'] !== null && $current_status === 0) {
                // Un commercial peut modifier le statut lorsque celui-ci est sur 0
                $new_status = 1;
            } else if ($account_type['idclient'] !== null && $current_status === 1) {
                // Un client peut modifier le statut lorsque celui-ci est sur 1
                $new_status = 3;
            } else if ($account_type['idclient'] !== null && $current_status === 3) {
                // Un client peut modifier le statut lorsque celui-ci est sur 3
                $new_status = 4;
            } else if ($account_type['idcommercial'] !== null && $current_status === 4) {
                // Un client peut modifier le statut lorsque celui-ci est sur 3
                $new_status = 5;
            } else if ($current_status === 5) {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Vous avez atteint le niveau maximum']);
                exit();
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["status" => 'error', "message" => 'Vous n\'avez pas la permission de modifier le statut de l\'état des lieux dans cette situation']);
                exit();
            }
    
            // Mettre à jour le statut dans la base de données
            $stmt = $conn->prepare("UPDATE Etat_Lieux SET statut = ? WHERE id_etat = ?");
            $stmt->execute([$new_status, $parsedData["id_etat"]]);
    
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'success', "message" => 'Statut de l\'état des lieux mis à jour avec succès', "new_status" => $new_status]);
            exit();
        }
    } else {
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode(["status" => 'error', "message" => 'Vous n\'avez pas la permission de faire ça [err-492]']);
            exit();
    }
    // if ($validtoken && $validcommercial) {
    //     $stmt = $conn->prepare("SELECT * FROM `Equipement` WHERE `id_piece` = ?");
    //     $stmt->execute([$parsedData["idPiece"]]);
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     header("Content-Type: application/json; charset=utf-8");
    //     echo json_encode(["status" => 'success', "message" => 'Voici Les Equipement pour la Piece demander ', "PieceEquipement" => $result]);
    //     exit();
    // }
}
?>