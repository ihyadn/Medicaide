<?php
//index.php
session_start();
include("../connexiondb.php");
if (!isset($_SESSION["role"]) ||  $_SESSION["role"]!="secretaire"){
    header('location:pages/login.php');
}
$query='SELECT * FROM patient WHERE id= :id';
$statement = $pdo->prepare($query);  
                $statement->execute(  
                     array(  
                          'id'     =>     $_GET['id'],  
                     )  
                ); 

$query='SELECT * FROM rendezvous WHERE patientID= :id';
$st = $pdo->prepare($query);  
                $st->execute(  
                     array(  
                          'id'     =>     $_GET['id'],  
                     )  
                ); 
$count = $st->rowCount();
$query1='SELECT * FROM rendezvous WHERE patientID= :id AND start_event>(SELECT NOW())';
$st1 = $pdo->prepare($query1);  
                $st1->execute(  
                     array(  
                          'id'     =>     $_GET['id'],  
                     )  
                ); 
$future = $st1->rowCount();
$query2='SELECT * FROM rendezvous WHERE patientID= :id AND end_event<(SELECT NOW())';
$st2 = $pdo->prepare($query2);  
                $st2->execute(  
                     array(  
                          'id'     =>     $_GET['id'],  
                     )  
                ); 
$passe = $st2->rowCount();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="../css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="../css/fichePatient.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Josefin+Sans:ital,wght@0,300;1,300&family=PT+Sans:ital,wght@0,400;0,700;1,400&family=Prompt:ital,wght@0,200;0,300;0,400;1,200;1,300&family=Raleway:ital,wght@0,300;1,200;1,300&family=Roboto&family=Roboto+Slab:wght@300;400;500&family=Ultra&family=Yanone+Kaffeesatz:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="main d-flex">
        <div class="sidebar">
            <?php include("../include/sidebar.php")?>
        </div>
        <div class="dashboard">
            <?php
            while ($donnees = $statement->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="info_patient">
                <div class="container_sidebar">
                    <div class="patient_info">
                        <div class="nom_patient">
                            <h3><?php echo $donnees['Nom'].' '.$donnees['Prenom'];?></h3>
                        </div>
                        <img alt="" src="../images\examination.png" class="patient_img"></img>
                        <div class=info_RDVs>
                            <div class=rdv>
                                <p style="font-size:1.5em"><?php echo $passe?></p>
                                <h5>passés</h5>
                            </div>
                            <div class="rdv">
                                <p style="font-size:1.5em"><?php echo $future?></p>
                                <h5>a venir</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container_main">
                    <div class="info1_patient">
                        <p class="info_title">sex:</p>
                        <p class="info_text"><?php echo $donnees['sex'];?></p>
                    </div>
                    <div class="info2_patient">
                        <p class="info_title">address:</p>
                        <p class="info_text"><?php echo $donnees['address'];?></p>
                    </div>
                    <div class="info3_patient">
                        <p class="info_title">télephone:</p>
                        <p class="info_text"><?php echo $donnees['telephone'];?></p>
                    </div>
                    <div class="info4_patient">
                        <p class="info_title">email:</p>
                        <p class="info_text"><?php echo $donnees['email'];?></p>
                    </div>
                    <div class="info5_patient">
                        <p class="info_title">cin:</p>
                        <p class="info_text"><?php echo $donnees['cin'];?></p>
                    </div>
                    <div class="info6_patient">
                        <p class="info_title">birth:</p>
                        <p class="info_text"><?php echo $donnees['birth'];?></p>
                    </div>
                    <div class="info7_patient">
                        <p class="info_title">date d'ajout:</p>
                        <p class="info_text"><?php echo $donnees['date_d_ajout'];?></p>
                    </div>
                </div>
            </div>
            <div class="barre_patient">
                <div class="info_container bg-danger">
                    <p class="info_title">RDV passés:</p>
                    <p class="info_num"><?php echo $passe?></p>
                </div>
                <div class="info_container bg-primary ">
                    <p class="info_title">RDV futurs:</p>
                    <p class="info_num"><?php echo $future?></p>
                </div>
                <div class="info_container bg-success">
                    <p class="info_title">Réservations:</p>
                    <p class="info_num"><?php echo $count?></p>
                </div>
                <div class="info_container bg-warning">
                    <p class="info_title">Absences:</p>
                    <p class="info_num">5</p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
<script>
</script>

</html>