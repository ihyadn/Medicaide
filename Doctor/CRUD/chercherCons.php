<?php
include("../connexiondb.php");
$query = "SELECT * FROM consultation WHERE id = :ID";  
                $statement = $pdo->prepare($query);  
                $statement->execute(  
                     array(  
                          'ID'     =>     $_POST['id'],  
                     )  
                ); 
 $row = $statement->fetch(PDO::FETCH_ASSOC);

 $query2 = "SELECT * FROM patient WHERE id = :patientID";
                                        $statement2 = $pdo->prepare($query2);  
                                        $statement2->execute(  
                                            array(  
                                                'patientID'     =>   $row['patientID'],  
                                                )  
                                            ); 
$patient = $statement2->fetch(PDO::FETCH_ASSOC);
 if ($statement->rowCount())
 {
 $data= array(
    'id'   => $row['id'],
    'idP'  =>$row['patientID'],
    'date'   => $row["date"],
    'heure'   => $row["heure"],
    'prenom'   => $patient["Prenom"],
    'cin'   => $patient["cin"],
    'email'   => $patient["email"],
    'telephone'   => $patient["telephone"],
    'nom'   => $patient["Nom"],
    'montant'   => $row["montant"],
    'status'   => $row["status"],
    'compteRendu'   => $row["compte_rendu"],

   );
  echo json_encode($data);
}
else
{
     $dat=[];
     echo json_encode($dat);

}
?>