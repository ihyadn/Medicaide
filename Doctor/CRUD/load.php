<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=cabinet', 'root', '');

$data = array();

$query = "SELECT * FROM rendezvous ORDER BY start_event DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
    $query = "SELECT * FROM patient WHERE id = :id";  
                $st = $connect->prepare($query);  
                $st->execute(  
                     array(  
                          'id'     =>     $row['patientID'],  
                     )  
                ); 
    $patient = $st->fetch(PDO::FETCH_ASSOC);
    $hex = 'rgba(';

//Create a loop.
foreach(array('r', 'g', 'b') as $color){
    //Random number between 0 and 255.
    $val = mt_rand(0, 255);
    //Convert the random number into a Hex value.
    //Concatenate
    $hex .= $val.",";
}
$hex .="0.7)";
 $data[] = array(
  'id'   => $row["id"],
  'title'=>$patient["Nom"]." ".$patient["Prenom"],
  'patientID'   => $row["patientID"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"],
  'color' =>$hex,
  'textColor'=>"black"
 );
}

echo json_encode($data);

?>