<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=cabinet', 'root', '');


$query = "
INSERT INTO consultation (patientID, date, heure, montant, status, compte_rendu) VALUES
(:patient,:date,:heure, :montant,:status, :compteRendu);
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   'patient'  => $_POST['patient'],
   'heure' => $_POST['heure'],
   'montant'=>$_POST['montant'],
   'status' => $_POST['status'],
   'compteRendu' => $_POST['compteRendu'],
   'date' => $_POST['date'],
  )
 );
 $query = "SELECT * FROM consultation ORDER BY id DESC LIMIT 1 ";
 $statement = $connect->prepare($query);
 $statement->execute();

 $row = $statement->fetch(PDO::FETCH_ASSOC);
 $data= array(
    'id'   => $row['id'],
   );
echo json_encode($data);
 
?>