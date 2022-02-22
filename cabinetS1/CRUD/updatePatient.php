<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=cabinet', 'root', '');

$query = "
UPDATE patient 
SET Nom= :Nom, Prenom= :Prenom, sex= :sexe, address= :address, telephone= :telephone, email= :email, cin= :cin, birth= :birth
WHERE id= :id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   'id'=>$_POST['id'],
   'Nom'  => $_POST['name'],
   'Prenom' => $_POST['prenom'],
   'sexe' => $_POST['sexe'],
   'address' => $_POST['address'],
   'telephone' => $_POST['telephone'],
   'email' => $_POST['email'],
   'cin' => $_POST['cin'],
   'birth' => $_POST['birth'],
  )
 );
?>