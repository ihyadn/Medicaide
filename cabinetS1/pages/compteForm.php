<div class="modal fade" id="comptamodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Certificat</h4>
            </div>
            <div class="modal-body modalbody">
                <label for="selectST" class="">status:</label>
                <select id="selectST">
                    <option value="Payé">Payé</option>
                    <option value="Semi payé">Semi payé</option>
                    <option value="Non payé">Non payé</option>
                </select>

                <label for="recu">Reçu:</label>
                <input class="modal_input" type="text" placeholder="" id="recu">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">fermer</button>
                <button type="button" class="btn btn-primary enrigistrercrf">enrigistrer</button>
            </div>
        </div>
    </div>
</div>
<script>
$(".enrigistrercrf").click(function() {
    var status = document.getElementById("selectST").value
    var recu = document.getElementById("recu").value
    var consultation = document.getElementById("patient").value
    $.ajax({
        url: "../CRUD/updateCons.php",
        type: "POST",
        data: {
            consultation: consultation,
            status: status,
            recu: recu,
        },
        success: function(data) {
            location.reload();

        }
    })






})
</script>