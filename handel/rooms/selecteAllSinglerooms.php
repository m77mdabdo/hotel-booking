<?php
require_once "../APP/APP.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $room = $conn->prepare("SELECT * from rooms where status = 1 AND  id=:id");
    $room->bindParam(":id", $id);
    $room->execute();
    $singleRoom = $room->fetch(PDO::FETCH_OBJ);
} else {
    header("location:../index.php ");
}
