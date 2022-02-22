<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=cabinet', 'root', '');

$query = "
 SELECT * FROM  `rendezvous` WHERE (:start>=start_event AND :start<end_event) OR (:end>start_event AND :end<= end_event) OR (:start<=start_event AND :end>=end_event)
 ";
 $st = $connect->prepare($query);
 $st->execute(
  array(
   'start' => $_POST['start'],
   'end' => $_POST['end'],
  ));
if(!$st->rowcount())
{
$query = "
 INSERT INTO `rendezvous`
 (patientID, start_event, end_event) 
 VALUES (:patientID, :start_event, :end_event)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   'patientID'  => $_POST['patientID'],
   'start_event' => $_POST['start'],
   'end_event' => $_POST['end'],
  )
 );
 print_r("zzz");
 $data=[];
 echo json_encode($data);
}
else
{
    $dat=["plage inisponible"];
     echo json_encode($dat);
}



?>