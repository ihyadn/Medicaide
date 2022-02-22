<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=cabinet', 'root', '');
echo "hoo";

$query = "
UPDATE consultation 
SET date=:date, heure=:heure, montant=:montant, status=:status, compte_rendu=:compte_rendu
WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   'id'  => $_POST['id'],
   'date'  => $_POST['date'],
   'heure'  => $_POST['heure'],
   'montant'  => $_POST['montant'],
   'status'  => $_POST['status'],
   'compte_rendu'  => $_POST['compte_rendu'],
   
  )
 );
 
?>