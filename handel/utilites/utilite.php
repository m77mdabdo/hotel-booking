<?php

require_once "../APP/APP.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $utilitise = $conn->prepare("SELECT * from utilities where room_id=:room_id ");
    $utilitise->bindParam(":room_id", $id);
    $utilitise->execute();

    $allutilitise = $utilitise->fetchAll(PDO::FETCH_OBJ);
}
