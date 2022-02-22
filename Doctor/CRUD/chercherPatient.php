<?php
include("../connexiondb.php");
$query = "SELECT * FROM patient WHERE cin = :CIN";  
                $statement = $pdo->prepare($query);  
                $statement->execute(  
                     array(  
                          'CIN'     =>     $_POST['cin'],  
                     )  
                ); 
 $row = $statement->fetch(PDO::FETCH_ASSOC);
 if ($statement->rowCount())
 {
 $data= array(
    'id'   => $row['id'],
    'Nom'   => $row["Nom"],
    'Prenom'   => $row["Prenom"],
    'address'   => $row["address"],
    'telephone'   => $row["telephone"],
    'email'   => $row["email"],
    'cin'   => $row["cin"],
    'birth'   => $row["birth"],
    'date d ajout'   => $row["date_d_ajout"],
   );
  echo json_encode($data);
}
else
{
     $dat=[];
     echo json_encode($dat);

}
?>