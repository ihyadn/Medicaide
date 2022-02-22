<?php
require_once("../connexiondb.php");
$requete="select * from patient ORDER BY date_d_ajout DESC";
$statement = $pdo->prepare($requete); 
$statement->execute();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="..\css\mystyle.css">
    <link rel="stylesheet" href="..\css\sidebar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    <title>Patients</title>
</head>

<body>
    <div class="main d-flex">
        <div class="sidebar">
            <?php include("../include/sidebar.php")?>
        </div>
        <div class="dashboard">
            <div class="containerr">
                <div class="panel">
                    <div class="panel-heading">Rechercher des patients...</div>
                    <div class="panel-body">
                        <div class="table_form">
                            <div class="form_grp">
                                <input type="text" name="CIN" placeholder="rechercher" class="form-control"
                                    id="cin_search">
                                <button type="submit" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-search"> </span>
                                </button>
                            </div>
                            <div class="form_grp">
                                <select name="filtrage" class="form-control" id="filtrage">
                                    <option value="0"> nom</option>
                                    <option value="1"> prenom</option>
                                    <option value="3"> CIN</option>
                                </select>
                                <button type="submit" class="btn btn-warning" onclick="sortTable()">
                                    <span class="glyphicon glyphicon-search"> </span> Filtrer
                                </button>
                            </div>
                            <a href="ajouterpatient.php">
                                <span class="glyphicon glyphicon-plus"> </span> Ajouter un patient</a>


                        </div>
                    </div>
                </div>

                <div class="panel table_cont">
                    <div class="panel-heading">Liste des patients</div>
                    <div class="panel-body" id="table_wrapper">
                        <div id="table_here">
                            <table class="table table_here" id="mytable">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>CIN</th>
                                        <th>Teléphone</th>
                                        <th>fiche du patient</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php while($patient=$statement->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <tr>
                                        <td><?php echo $patient['Nom'] ?> </td>

                                        <td><?php echo $patient ['Prenom'] ?> </td>
                                        <td><?php echo $patient ['email'] ?> </td>
                                        <td><?php echo $patient ['cin'] ?> </td>
                                        <td><?php echo $patient ['telephone'] ?> </td>

                                        <td>
                                            <a href="fichePatient.php?id=<?php echo $patient ['id'] ?>"><i
                                                    class="far fa-eye" style="color:blue"></i></a>
                                            <i class="far fa-trash-alt delete"
                                                onclick="supprimer_rend(<?php echo $patient ['id'] ?>)"> </i>
                                            <a
                                                href="ajouterPatient.php?cin=<?php echo $patient ['cin'] ?>&update=Update"><i
                                                    class="fas fa-pencil" onclick="update()"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                            </table>
                            </tbody>
                        </div>
                    </div>
                </div>



            </div>
        </div>
        <script>
        const supprimer_rend = (id) => {
            console.log("hiii")
            $.ajax({
                url: "../CRUD/deletePatient.php",
                type: "POST",
                data: {
                    id: id,
                },
                success: function() {
                    document.location.reload()
                },
            });
        }

        function searchTable(input) {
            console.log("searching")
            var table, tr, td, i, j, found;
            filter = input.toUpperCase();
            table = document.getElementById("mytable");
            tr = table.getElementsByTagName("tr");
            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    // if(td[j].innerHTML.toUpperCase().substring(0,filter.length)===filter)
                    if (td[j].innerHTML.toUpperCase().substring(0, filter.length) === filter) {
                        console.log(td[j].innerHTML.toUpperCase().indexOf(filter))
                        found = true;
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                    found = false;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        function sortTable() {
            console.log("filtring")
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("mytable");
            switching = true;
            filter = document.getElementById('filtrage').value
            let element = parseInt(filter)
            /* Make a loop that will continue until
            no switching has been done: */
            while (switching) {
                // Start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /* Loop through all table rows (except the
                first, which contains table headers): */
                for (i = 1; i < (rows.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                    one from current row and one from the next: */
                    x = rows[i].getElementsByTagName("TD")[element];
                    y = rows[i + 1].getElementsByTagName("TD")[element];
                    console.log(x, y)
                    // Check if the two rows should switch place:
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    /* If a switch has been marked, make the switch
                    and mark that a switch has been done: */
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }
        $('#cin_search').bind('input', function() {
            searchTable(document.getElementById('cin_search').value)
        })
        </script>
</body>

</html>