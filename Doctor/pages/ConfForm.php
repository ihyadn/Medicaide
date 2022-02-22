<div class="modal fade" id="confmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Certificat</h4>
            </div>
            <div class="modal-body modalbody">
                <label for="raison">Raison:</label>
                <input class="modal_input" type="text" placeholder="" id="raison">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">fermer</button>
                <button type="button" class="btn btn-primary imprimerc">imprimer</button>
            </div>
        </div>
    </div>
</div>
<script>
$(".imprimerc").click(function() {
    var id = document.getElementById("idP").value
    var idCons = document.getElementById("id").value
    var raison = document.getElementById("raison").value
    const timeElapsed = Date.now();
    const today = new Date(timeElapsed);
    $.ajax({
        url: "../CRUD/fichierInsert.php",
        type: "POST",
        data: {
            consultation: idCons,
            patient: id,
            type: "confrerie",
            chemin: "http://localhost/Doctor/fpdf/Saved/confrerie" + id +
                ".pdf",
        },
        success: function(data) {
            $.ajax({
                url: "../fpdf/confrerie.php?id=" + id + "&raison=" + raison,
                type: "POST",
                data: {
                    consultation: idCons,
                    patient: id,
                    type: "confrerie",
                    chemin: "http://localhost/Doctor/fpdf/Saved/confrerie" + id +
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