<div class="modal fade" id="piecemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Certificat</h4>
            </div>
            <div class="modal-body modalbody">
                <label for="piece">fichier:</label>
                <input class="modal_input" type="file" placeholder="" id="piece">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">fermer</button>
                <button type="button" class="btn btn-primary imprimercr">imprimer</button>
            </div>
        </div>
    </div>
</div>
<script>
$(".imprimercr").click(function() {
    console.log("hii");
    var id = document.getElementById("idP").value
    var fichier = document.getElementById("piece").value
    var idCons = document.getElementById("id").value
    // const fs = require('fs');
    // require(['fs'], function(fs, fichier) {
    //     fs.copyFile('C:/xampp/htdocs/cabinetS1/cabinet.sql', 'C:/folderB/myfile.sql', (err) => {
    //         if (err) throw err;
    //         console.log('File was copied to destination');
    //     });
    // });
    // destination will be created or overwritten by default.


    $.ajax({
        url: "../CRUD/fichierInsert.php",
        type: "POST",
        data: {
            consultation: idCons,
            patient: id,
            type: "piece joint",
            chemin: "http://localhost/Doctor/fpdf/Saved/pieceJ" + id + ".pdf",
        },
        success: function(data) {
            window.location.reload();
        }
    })






})
</script>