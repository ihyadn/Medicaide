<div class="modal fade" id="ordmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Certificat</h4>
            </div>
            <div class="modal-body modalbody">
                <label for="medicament">Medicaments:</label>
                <input class="modal_input" type="text" placeholder="" id="medicament">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">fermer</button>
                <button type="button" class="btn btn-primary imprimero">imprimer</button>
            </div>
        </div>
    </div>
</div>
<script>
$(".imprimero").click(function() {
    var id = document.getElementById("idP").value
    var idCons = document.getElementById("id").value
    var medicament = document.getElementById("medicament").value
    const timeElapsed = Date.now();
    const today = new Date(timeElapsed);
    $.ajax({
        url: "../CRUD/fichierInsert.php",
        type: "POST",
        data: {
            consultation: idCons,
            patient: id,
            type: "ordanance",
            chemin: "http://localhost/Doctor/fpdf/Saved/ordonance" + id +
                ".pdf",
        },
        success: function(data) {
            $.ajax({
                url: "../fpdf/ordonance.php?id=" + id + "&medicament=" + medicament,
                type: "POST",
                data: {
                    consultation: idCons,
                    patient: id,
                    type: "certificat",
                    chemin: "http://localhost/Doctor/fpdf/Saved/ordonance" + id +
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