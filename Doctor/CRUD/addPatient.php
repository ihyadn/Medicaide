<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=cabinet', 'root', '');


$query = "
INSERT INTO patient (Nom, Prenom, sex, address, telephone, email, cin, birth,date_d_ajout) VALUES
(:Nom,:Prenom,:sex, :address, :telephone, :email, :cin, :birth, :date);
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   'Nom'  => $_POST['name'],
   'Prenom' => $_POST['prenom'],
   'sex' => $_POST['sexe'],
   'address' => $_POST['address'],
   'telephone' => $_POST['telephone'],
   'email' => $_POST['email'],
   'cin' => $_POST['cin'],
   'birth' => $_POST['birth'],
   'date' => $_POST['date'],
  )
 );

 $dat=[];
 echo json_encode($dat);

?>