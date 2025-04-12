<?php 

$hotels=$conn->query("select * from hotels where status =1");
  $hotels->execute();
  $allHotels=$hotels->fetchall(PDO::FETCH_OBJ);