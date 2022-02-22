<?php
//index.php
session_start();
if (!isset($_SESSION["role"]) ||  $_SESSION["role"]!="secretaire"){
    header('location:login.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\sidebar.css" />
    <link rel="stylesheet" href="..\css\mystyle.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    <title>Patients</title>
</head>
<style>
.dashboard {
    background-image: linear-gradient(to top, #fff1eb 0%, #ace0f9 100%);
}
</style>

<body>
    <div class="main d-flex">
        <div class="sidebar">
            <?php include("../include/sidebar.php")?>
        </div>
        <div class="dashboard">
            <div class="cont">
                <div class="heading">
                    <h3><?php echo isset($_GET['update'])?"Modifier":"Ajouter"?> un Patient</h3>
                    <img src="..\images\crowd.png" alt="">
                </div>
                <div class="add_form_wrapper">
                    <div class="form_inputs">
                        <input class="" style="display:none" type="text" id="id">
                        <div class="form-g">
                            <label for="nom">Nom:</label>
                            <input type="text" name="nom" placeholder="Nom" id="nom" />
                        </div>

                        <div class="form-g">
                            <label for="prenom">Prenom:</label>
                            <input type="text" name="prenom" class="" placeholder="prenom" id="prenom" />
                        </div>
                        <div class="form-g sexe">
                            <label for="sexe">sexe:</label>
                            <select name="sexe" class="" id="sexe">
                                <option value="homme"> homme</option>
                                <option value="femme"> femme</option>
                            </select>
                        </div>
                        <div class="form-g">
                            <label for="email">Email:</label>
                            <input type="text" name="email" class="" placeholder="email" id="email" />
                        </div>

                        <div class="form-g">
                            <label for="adresse">Adresse:</label>
                            <input type="text" name="adresse" class="" placeholder="adresse" id="adresse" />
                        </div>
                        <div class="form-g">
                            <label for="cin">Cin:</label>
                            <input type="text" value="<?php echo isset($_GET['cin'])?$_GET['cin']:''?>" name="cin"
                                placeholder="carte d'identité nationale" id="cin" />
                        </div>


                        <div class="form-g">
                            <label for="telephone">Telephone:</label>
                            <input type="text" name="telephone" class="" placeholder="telephone" id="telephone" />
                        </div>
                        <div class="form-g">
                            <label for="birth">date de naissance:</label>
                            <input type="date" name="birth" class="" placeholder="date de naissance" id="birth" />
                        </div>
                    </div>
                    <button id='enr' type="submit"
                        class="<?php echo "button ".(isset($_GET['update'])?"modifier":"ajouter")?>">
                        <?php echo isset($_GET['update'])?"Modifier":"Ajouter"?>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<script>
$(".ajouter").click(function() {
    var cin = document.getElementById("cin").value
    var name = document.getElementById("nom").value
    var tele = document.getElementById("telephone").value
    var prenom = document.getElementById("prenom").value
    var birth = document.getElementById("birth").value
    var email = document.getElementById("email").value
    var adresse = document.getElementById("adresse").value
    var sexe = document.getElementById("sexe").value
    var date = new Date().toJSON().slice(0, 10).replace(/-/g, '/');
    $.ajax({
        url: "../CRUD/addPatient.php",
        type: "POST",
        data: {
            cin: cin,
            name: name,
            telephone: tele,
            prenom: prenom,
            birth: birth,
            email: email,
            address: adresse,
            sexe: sexe,
            date: date
        },
        success: function() {
            alert("patient ajouté avec succès")
            window.location.href = "patients.php"
        }
    })
});
$(".modifier").click(function() {
    var id = document.getElementById("id").value
    var cin = document.getElementById("cin").value
    var name = document.getElementById("nom").value
    var tele = document.getElementById("telephone").value
    var prenom = document.getElementById("prenom").value
    var birth = document.getElementById("birth").value
    var email = document.getElementById("email").value
    var adresse = document.getElementById("adresse").value
    var sexe = document.getElementById("sexe").value
    $.ajax({
        url: "../CRUD/updatePatient.php",
        type: "POST",
        data: {
            id: id,
            cin: cin,
            name: name,
            telephone: tele,
            prenom: prenom,
            birth: birth,
            email: email,
            address: adresse,
            sexe: sexe,
        },
        success: function() {
            alert("patient modifié avec succès")
            window.location.href = "patients.php"
        }
    })
});
$("document").ready(function() {
    console.log("jjj")
    var cin = document.getElementById("cin").value
    $.ajax({
        url: "../CRUD/chercherPatient.php",
        type: "POST",
        data: {
            cin: cin,
        },
        success: function(data) {
            console.log(jQuery.isEmptyObject(JSON.parse(data)))
            if (!jQuery.isEmptyObject(JSON.parse(data))) {
                data = JSON.parse(data)
                document.getElementById("nom").value = data["Nom"]
                document.getElementById("telephone").value = data['telephone']
                document.getElementById("prenom").value = data['Prenom']
                document.getElementById("email").value = data['email']
                document.getElementById("adresse").value = data['address']
                document.getElementById("id").value = data['id']
                document.getElementById("birth").value = data['birth']
            } else {}
        }
    })
});
</script>

</html>