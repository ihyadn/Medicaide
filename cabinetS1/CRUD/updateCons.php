<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=cabinet', 'root', '');

$query = "
UPDATE consultation 
SET status= :status, recu= :recu
WHERE id= :id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   'id'=>$_POST['consultation'],
   'status'  => $_POST['status'],
   'recu' => $_POST['recu'],
  )
 );
?>