<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Certificat</h4>
            </div>
            <div class="modal-body modalbody">
                <label for="debut">date de debut:</label>
                <input class="modal_input" type="date" placeholder="" id="debut">
                <label for="fin">nombre de jours:</label>
                <input class="modal_input" type="text" placeholder="" id="fin">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">fermer</button>
                <button type="button" class="btn btn-primary imprimercrf">imprimer</button>
            </div>
        </div>
    </div>
</div>
<script>
$(".imprimercrf").click(function() {
    var id = document.getElementById("idP").value
    var idCons = document.getElementById("id").value
    var debut = document.getElementById("debut").value
    var fin = document.getElementById("fin").value

    $.ajax({
        url: "../CRUD/fichierInsert.php",
        type: "POST",
        data: {
            consultation: idCons,
            patient: id,
            type: "certificat",
            chemin: "http://localhost/Doctor/fpdf/Saved/certificat" + id + debut + ".pdf",
        },
        success: function(data) {
            $.ajax({
                url: "../fpdf/certificat.php?id=" + id + "&debut=" + debut + "&fin=" + fin,
                type: "POST",
                data: {
                    consultation: idCons,
                    patient: id,
                    type: "certificat",
                    chemin: "http://localhost/Doctor/fpdf/Saved/certificat" + id + debut +
                        ".pdf",
                },
                success: function(data) {
                    window.location.reload();
                }
            })

        }
    })






})
</script>