<?php
    $servername = "mysql.axiz.io";
    $username = "flashmcqueen";
    $password = "flashmcqueen0550002D";
    $dbname = "immoappmvc";
    session_start();
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT id_reservation, id_client, id_logement, date_debut_demande, date_fin_demande, accept FROM Reservation";
        $exec = $conn->query($sql);
        $reservationClients = $exec->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($reservationClients);
        header("Content-Type: application/json");
        echo $json;
    } catch(PDOException $e) {
        die("Connexion échouée : " . $e->getMessage());
    }
?>