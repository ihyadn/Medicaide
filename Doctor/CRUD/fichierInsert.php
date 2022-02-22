<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=cabinet', 'root', '');


$query = "
INSERT INTO fichier (patientID, Consult_ID, type, chemin) VALUES
(:patient,:consultation,:type, :chemin);
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   'patient'  => $_POST['patient'],
   'consultation' => $_POST['consultation'],
   'type' => $_POST['type'],
   'chemin' => $_POST['chemin'],
  )
 );

 $dat=[];
 echo json_encode($dat);

?>