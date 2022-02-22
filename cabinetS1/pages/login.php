<?php
session_start();
    include("../connexiondb.php");
    if (isset($_POST["email"]) &&  isset($_POST["password"])){
        $email = $_POST["email"];
        $role=$_POST["role"];
        $query = "SELECT * FROM utilisateur WHERE email = :email AND role = :role";  
                $statement = $pdo->prepare($query);  
                $statement->execute(  
                     array(  
                          'email'     =>     $email,  
                          'role'     =>     $role 
                     )  
                ); 
        // $requete = $connection->query("SELECT * FROM `utilisateur` WHERE email = '".$email."' AND role = '".$role."' ;");
        // $requete->data_seek(0);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        
        if($row==null || $_POST["password"] != $row["password"]){
            $erreurLogin="Email ou mot de passe est incorrect";
        }
        else{
            $_SESSION["role"] = $_POST["role"];
            print_r($row);
            header('location:/cabinetS1/');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="main">
        <img alt="" src="../images/logo.png" class="logo">
        <img alt="" src="../images/svg.png" class="back_img">
        <div class="right">
            <img alt="" src="../images/doc.svg" class="left_img">
        </div>
        <div class="left">
            <form class="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <?php
                        if(!empty($erreurLogin)){
                            echo "<div id='alert' class='alert alert-danger' role='alert'>$erreurLogin</div>";
                        }
                    ?>
                <p>Êtes-vous:</p>
                <div class="d-flex role">
                    <div class="role_chooose">
                        <label for="secretaire"><img alt="" src="../images/secretary.png" class="avatar"></img></label>
                        <p>Secretaire</p>
                        <input type="radio" id="secretaire" value="secretaire" name="role">
                    </div>
                    <div class="role_chooose">
                        <label for="medecin"><img alt="" src="../images/doctor.png" class="avatar"></label>
                        <p>Medecin</p>
                        <input type="radio" id="medecin" value="medecin" name="role" required>
                    </div>
                </div>
                <div class="form-g">
                    <label for="email">Email:</label>
                    <input class="input_form" type="email" placeholder="Email" name="email" required>
                </div>
                <div class="form-g">
                    <label for="password">Password:</label>
                    <input class="input_form" type="password" placeholder="Password" name="password" required>
                </div>
                <button type="submit" class="sub">login</button>
            </form>
        </div>
    </div>
    </div>
</body>
<script>
document.addEventListener("DOMContentLoaded", function(event) {
    console.log("hii")
    let alert = document.getElementById("alert");
    if (!alert.classList.contains("d-none")) {
        setTimeout(() => {
            alert.classList.add("d-none")
        }, 3000);
    }
});
</script>

</html>