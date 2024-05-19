<?php

$config = parse_ini_file('config.ini');

$dsn = "mysql:host=" . $config['host'] . ";dbname=" . $config['database'] . ";charset=utf8mb4";
$username = $config['user'];
$password = $config['password'];

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8mb4");
} catch (PDOException $e) {
    http_response_code(500);
    die("Connection failed: " . $e->getMessage());
}

$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'GET':
        break;
        case 'POST':
            $token = $_POST['token'];
        
            if (empty($token)) {
                http_response_code(400);
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(array('error' => 'Token manquant.'));
                exit;
            }
            
            $upload_dir = "images/";
            
        
            if (!empty($_FILES['photo']['name'])) {
                $file_name = uniqid() . '_' . basename($_FILES['photo']['name']);
                $upload_file = $upload_dir . $file_name;
            }
        
            $stmt = $pdo->prepare('INSERT INTO Conversation_Etat_Lieux (id_commercial,message,chemin_photo,noteco,id_piece,id_equipement,datepost,type,id_etat) 
                            VALUES (:id,:message,:chemin_photo,:noteco,:id_piece,:id_equipement,NOW(),:type,:id_etat)');
        
            $stmt->bindParam(':id', $_POST['idUser']);
            $stmt->bindParam(':message', $_POST['commentaire']);
            $stmt->bindParam(':chemin_photo', $file_name);
            $stmt->bindParam(':noteco', $_POST['note']);
            $stmt->bindParam(':id_piece', $_POST['idpiece']);
            $stmt->bindParam(':id_equipement', $_POST['idEquipement']);
            $stmt->bindParam(':type', $_POST['type']);
            $stmt->bindParam(':id_etat', $_POST['idEtat']);
        
            if ($stmt->execute()) {
                if (!empty($file_name) && move_uploaded_file($_FILES['photo']['tmp_name'], $upload_file)) {
                    http_response_code(200);
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(array('message' => 'L\'image a été téléchargée et insérée avec succès.', 'token' => $token, 'file_name' => $file_name));
                } else {
                    http_response_code(500);
                    header("Content-Type: application/json; charset=utf-8");
                    echo json_encode(array('error' => 'Une erreur s\'est produite lors de l\'enregistrement de l\'image.'));
                }
            } else {
                http_response_code(500);
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(array('error' => 'Une erreur s\'est produite lors de l\'insertion des données dans la base de données.'));
            }
            break;
        
    case 'PUT':
        break;

    case 'DELETE':
        break;

    default:
        http_response_code(405);
        echo json_encode(array('error' => 'M�thode non autoris�e'));
        break;
}

$pdo = null;
