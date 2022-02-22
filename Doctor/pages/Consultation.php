<?php
//index.php
// session_start();
// if (!isset($_SESSION["role"]) ||  $_SESSION["role"]!="medecin"){
//     header('location:/cabinetS1/index.php"');
// }
require_once("../connexiondb.php");
if (isset($_GET['id']))
{
$requete="select * from fichier where Consult_ID=:id";
$statement = $pdo->prepare($requete); 
$statement->execute(
    array(
        'id'  => $_GET['id'],
       )
);
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="..\css\sidebar.css" />
    <link rel="stylesheet" href="..\css\consultation.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.css" rel="stylesheet"
        type="text/css">

    <!-- JS -->
    <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.js"></script>

    <title>New</title>
</head>

<body>

    <?php include("CertifForm.php")?>
    <?php include("OrdForm.php")?>
    <?php include("ConfForm.php")?>
    <?php include("pieceForm.php")?>
    <div class="main d-flex">
        <div class="sidebar">
            <?php include("../include/sidebar.php")?>
        </div>
        <div class="dashboard">
            <div class="info_consultation d-flex mb-5">
                <div class="patient">
                    <div class="pat_log">
                        <h2>Patient</h2>
                        <img class="patient_img" alt="" src="../images/examination.png">
                    </div>
                    <div class="info_patient">
                        <div class="serach">
                            <input class="input" type="text" placeholder="cin" id="cin"
                                value="<?php echo isset($_GET["cin"])?$_GET["cin"]:""?>">
                            <img alt="" src="../images/search.png" id="search"
                                title="aller à une date spécifique"></img>
                        </div>
                        <input class="input" type="text" placeholder="nom" id="nom">
                        <input class="input" type="text" placeholder="prenom" id="prenom">
                        <input class="input" type="text" placeholder="email" id="email">
                        <input class="input" type="text" placeholder="telephone" id="telephone">
                    </div>
                </div>
                <div class="info_specifique d-flex">
                    <div class="pat_log">

                        <img class="patient_img" alt="" src="../images/doccons.png">
                        <button class="btn btn-warning" id="<?php echo isset($_GET["update"])?"modifier":"save"?>"
                            <?php echo !isset($_GET["update"])?"disabled":""?>><?php echo isset($_GET["update"])?"modifier":"Enrigistrer"?></button>
                    </div>
                    <div class="info_patient">
                        <input class="dnone" type="text" placeholder="id" id="idP">
                        <input class="dnone" type="text" placeholder="id" id="id"
                            value="<?php echo isset($_GET["id"])?$_GET["id"]:""?>">
                        <input class="input" type="date" placeholder="date" id="date">
                        <input class="input" type="time" placeholder="heure" id="heure">
                        <input class="input" type="text" placeholder="montant" id="montant">
                        <!-- <input class="input" type="text" placeholder="medicament" id="medicament"> -->
                        </br><textarea id="compterndu" class="text compterendu" cols="86" rows="10"
                            name="confirmationText" placeholder="Compte rendu"></textarea>
                    </div>
                </div>
            </div>
            <div class="info_consultation d-flex">
                <div class="patient">
                    <h3>Ajouter document</h3>
                    <div class="add_file">
                        <a class="link_add" data-toggle="modal" data-target="#ordmodal">
                            <img class="img_add" alt="" src="../images/checklist.png">
                        </a>
                        Ordonnance
                    </div>
                    <div class="add_file">

                        <a class="link_add" data-toggle="modal" data-target="#myModal">
                            <img class="img_add" alt="" src="../images/certification.png">
                        </a>
                        Certificat
                    </div>
                    <div class="add_file">

                        <a class="link_add" data-toggle="modal" data-target="#confmodal">
                            <img class="img_add" alt="" src="../images/letter.png">
                        </a>
                        Lettre de confrere
                    </div>
                    <div class="add_file ">

                        <a class="link_add" data-toggle="modal" data-target="#piecemodal">
                            <img class="img_add" alt="" src="../images/add-file.png">
                        </a>
                        <!-- <input type="file" name="somename" size="chars" class="piece" hidden> -->
                        piece joint
                    </div>
                </div>
                <div class="docassoc_wrapper">
                    <div class="docassoc">
                        <h3>Documents associée</h3>
                        <table class="table table-bordred">
                            <thead>
                                <tr>
                                    <th> Nom </th>
                                    <th> type </th>
                                    <th> action </th>
                                <tr>
                            </thead>
                            <tbody>
                                <?php while(isset($_GET["id"]) && $fichier=$statement->fetch(PDO::FETCH_ASSOC)){?>
                                <tr>
                                    <td><?php echo $fichier["type"].$fichier["id"]?></td>
                                    <td><?php echo $fichier["type"]?></td>
                                    <td class="d-flex"><a href="<?php echo $fichier["chemin"] ?>" target="_blank"><i
                                                class="fas fa-eye m-5"></i></a>
                                    </td>
                                    <?php }?>
                                </tr>


                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
</body>
<script>
$("document").ready(function() {
    var id = document.getElementById("id").value
    var cin = document.getElementById("cin").value
    if (id) {
        $.ajax({
            url: "../CRUD/chercherCons.php",
            type: "POST",
            data: {
                id: id,
            },
            success: function(data) {
                console.log(data)
                if (!jQuery.isEmptyObject(JSON.parse(data))) {
                    data = JSON.parse(data)
                    document.getElementById("cin").value = data["cin"]
                    document.getElementById("nom").value = data["nom"]
                    document.getElementById("telephone").value = data['telephone']
                    document.getElementById("prenom").value = data['prenom']
                    document.getElementById("email").value = data['email']
                    document.getElementById("montant").value = data['montant']
                    document.getElementById("date").value = data['date']
                    document.getElementById("heure").value = data['heure']
                    document.getElementById("compterndu").value = data['compteRendu']
                    document.getElementById("idP").value = data['idP']
                    // document.getElementById("id").value = data['id']

                } else {
                    alert("patient n'existe pas")
                }
            }
        })
    } else if (cin) {

        $.ajax({
            url: "../CRUD/chercherPatient.php",
            type: "POST",
            data: {
                cin: cin,
            },
            success: function(data) {
                if (!jQuery.isEmptyObject(JSON.parse(data))) {
                    data = JSON.parse(data)
                    document.getElementById("nom").value = data["Nom"]
                    document.getElementById("telephone").value = data['telephone']
                    document.getElementById("prenom").value = data['Prenom']
                    document.getElementById("email").value = data['email']
                    document.getElementById("idP").value = data['id']
                } else {
                    alert("patient n'existe pas")
                }
            }
        })
    }
});
$("#search").click(function() {
    var cin = document.getElementById("cin").value
    $.ajax({
        url: "../CRUD/chercherPatient.php",
        type: "POST",
        data: {
            cin: cin,
        },
        success: function(data) {
            if (!jQuery.isEmptyObject(JSON.parse(data))) {
                data = JSON.parse(data)
                document.getElementById("nom").value = data["Nom"]
                document.getElementById("telephone").value = data['telephone']
                document.getElementById("prenom").value = data['Prenom']
                document.getElementById("email").value = data['email']
                document.getElementById("idP").value = data['id']
            } else {
                alert("patient n'existe pas")
            }
        }
    })
});
$("#save").click(function() {
    var patient = document.getElementById("idP").value
    var date = document.getElementById("date").value
    var heure = document.getElementById("heure").value
    var montant = document.getElementById("montant").value
    var compterendu = document.getElementById("compterndu").value
    var getID
    $.ajax({
        url: "../CRUD/ajouterConsultation.php",
        type: "POST",
        data: {
            patient: patient,
            date: date,
            heure: heure,
            montant: montant,
            status: "non payée",
            compteRendu: compterendu,
        },
        success: function(data) {
            if (!jQuery.isEmptyObject(JSON.parse(data))) {
                data = JSON.parse(data)
                getID = data["id"]
            }
            window.location.href = "Consultation.php?id=" + getID
        }
    })
});
$("#modifier").click(function() {
    console.log("hii")
    var patient = document.getElementById("idP").value
    var date = document.getElementById("date").value
    var heure = document.getElementById("heure").value
    var montant = document.getElementById("montant").value
    var compterendu = document.getElementById("compterndu").value
    var id = document.getElementById("id").value
    var getID
    $.ajax({
        url: "../CRUD/updateCons.php",
        type: "POST",
        data: {
            id: id,
            patientID: patient,
            date: date,
            heure: heure,
            montant: montant,
            status: "non payée",
            compte_rendu: compterendu,
        },
        success: function(data) {

        }
    })
});

$('.piecej').click(function() {
    $('.piece').click();
});
// $(".imprimer").click(function() {
//     console.log('gggg');
//     var id = document.getElementById("id").value
//     var debut = document.getElementById("debut").value
//     var fin = document.getElementById("fin").value
//     $.ajax({
//         url: "../fpdf/certificat.php",
//         type: "POST",
//         data: {
//             id: id,
//             debut: debut,
//             fin: fin,
//         },
//         success: function(data) {
//             window.location = data.url;
//         }
//     })

// })
</script>

</html>