<?php
require_once("../connexiondb.php");

$nomp=isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";

$requete="select * from rendezVous ORDER BY start_event DESC";
$resultat=$pdo->query($requete); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="..\css\mystyle.css" />
    <link rel="stylesheet" href="..\css\sidebar.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <title>rends</title>
</head>

<body>
    <div class="main d-flex">
        <div class="sidebar">
            <?php include("../include/sidebar.php")?>
        </div>
        <div class="dashboard">
            <div class="containerr">
                <div class="panel">
                    <div class="panel-heading">Rendez-Vous</div>
                    <div class="panel-body">
                        <div class="table_form">
                            <div class="form_grp">

                                </i>
                                <input type="text" name="CIN" placeholder="rechercher" class="form-control"
                                    id="cin_search" />
                                <button type="submit" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-search"> </span>
                                </button>
                            </div>

                            <div class="form_grp">
                                <select name="filtrage" class="form-control" id="filtrage">
                                    <option value="2">nom</option>
                                    <option value="1">CIN</option>
                                    <option value="5">date</option>
                                    <option value="6">debut</option>
                                </select>
                                <button type="submit" class="btn btn-warning" onclick="sortTable()">
                                    <span class="glyphicon glyphicon-search"> </span> Filtrer
                                </button>
                            </div>
                            <button class="btn btn-danger" onclick="deletSelected()"
                                title='supprimer les rendez-vous selectionés'>
                                Supprimer </button>
                        </div>

                    </div>
                </div>

                <div class="panel table_cont">
                    <div class="panel-heading">Liste des rendez-vous</div>
                    <div class="panel-body table_here" id="table_wrapper">
                        <div id="table_here">
                            <?php $requete="select * from rendezVous ";$resultat=$pdo->query($requete);?>
                            <table class="table table - bordred " id="mytable">
                                <thead>

                                    <tr>
                                        <th> <input type="checkbox" value="false" id="check_all" onclick="checkAll()">
                                        </th>
                                        <th> Cin </th>
                                        <th> Nom </th>
                                        <th> Prenom </th>
                                        <th> action </th>
                                    <tr>
                                </thead>
                                <tbody>
                                    <?php while($rend=$resultat->fetch()){
                                        $query = "SELECT * FROM patient WHERE id = :patientID";
                                        $statement = $pdo->prepare($query);  
                                        $statement->execute(  
                                            array(  
                                                'patientID'     =>   $rend['patientID'],  
                                                )  
                                            ); 
                                        $row = $statement->fetch(PDO::FETCH_ASSOC);?>
                                    <tr>

                                        <td> <input type="checkbox" value="<?php echo $rend ['id'] ?>" id="check"></td>

                                        <td> <?php echo $row ['cin'] ?> </td>
                                        <td> <?php echo $row ['Nom'] ?> </td>

                                        <td> <?php echo $row ['Prenom'] ?> </td>


                                        <td class="d-flex align-items-center">
                                            <a href="fichePatient.php?id=<?php echo $row ['id'] ?>">
                                                <span class="glyphicon glyphicon-eye-open bg-news"> </span>
                                            </a>

                                            <a href="Consultation.php?cin=<?php echo $row["cin"]?>">
                                                <i class="glyphicon glyphicon-plus"> </i></a>
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
    </div>
    <script>
    const checkAll = () => {
        let selects = document.querySelectorAll("#check");
        console.log("hii")
        selects.forEach(e => {
            e.checked = !e.checked;
        })
    }
    const supprimer_rend = (id) => {
        console.log("hiii")
        $.ajax({
            url: "../CRUD/delete.php",
            type: "POST",
            data: {
                id: id,
            },
            success: function() {
                document.location.reload()
            },
        });
    }
    const deletSelected = () => {
        const checks = document.querySelectorAll("#check")

        checks.forEach(c => {
            if (c.checked) {
                supprimer_rend(c.value)
            }
        })
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
                console.log(td[j].innerText.toUpperCase().substring(0, filter.length) === filter)
                if (td[j].innerText.toUpperCase().substring(0, filter.length) === filter) {
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
        console.log(filter)
        let element = parseInt(filter)
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            console.log(rows[3].getElementsByTagName("TD")[1])
            for (i = 2; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[element];
                y = rows[i + 1].getElementsByTagName("TD")[element];
                console.log(x, y)
                // Check if the two rows should switch place:
                if (filter === "5") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                } else {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
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