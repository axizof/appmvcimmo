<?php

$config = parse_ini_file('config.ini');

$dsn = "mysql:host=" . $config['host'] . ";dbname=" . $config['database'];
$username = $config['user'];
$password = $config['password'];

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    die("Connection failed: " . $e->getMessage());
}

$request_method = $_SERVER['REQUEST_METHOD'];

switch ($request_method) {
    case 'POST':
        $json_data = file_get_contents('php://input');
        break;

    case 'GET':

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM Logements WHERE id_logement = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $logement = $stmt->fetch();
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode($logement);
            } else {
                header("Content-Type: application/json; charset=utf-8");
                echo json_encode(["message" => 'Aucun logement trouvé.']);
            }

        }
        // } else {
        //     $sql = "SELECT * FROM Logements";
        //     $stmt = $pdo->query($sql);

        //     if ($stmt->rowCount() > 0) {
        //         $logements = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //         header("Content-Type: application/json; charset=utf-8");
        //         echo json_encode($logements);
        //     } else {
        //         header("Content-Type: application/json; charset=utf-8");
        //         echo json_encode(["message" => 'Aucun logement trouvé.']);
        //     }
        // }
        break;

    default:
        // M thode non autoris e
        http_response_code(405);
        break;
}

$pdo = null;
?>