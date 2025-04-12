<?php 

$rooms=$conn->query("select * from rooms where status =1");
  $rooms->execute();
  $allRooms=$rooms->fetchall(PDO::FETCH_OBJ);