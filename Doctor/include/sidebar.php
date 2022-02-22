<div class="doctor_info">
    <img alt="" src="\Doctor\images\doctor.png" class="doc_img"></img>
    <div class="nom_docteur">
        <h4>Doctor</h4>
    </div>
</div>
<div class="sidebar_list">
    <a class="<?php echo 'list_item'.($_SERVER['REQUEST_URI']=="/Doctor/"?' active':'')?> " onclick="changeactive(this)"
        href="/Doctor/pages/dashboard.php">
        <img class="fad fa-calendar-alt icon" alt="" src="\Doctor\images\dashboard.png"></img>
        <div>Tableau de bord</div>
    </a>
    <a class="<?php echo 'list_item'.($_SERVER['REQUEST_URI']=="/Doctor/pages/Consultations.php"?' active':'')?> "
        onclick=" changeactive(this)" href="/Doctor/pages/Consultations.php">
        <img class="fad fa-calendar-alt icon" alt="" src="\Doctor\images\appointment.png"></img>
        <div>Consultations</div>
    </a>

    <a class="list_item" onclick="changeactive(this)" href="\Doctor\logout.php">
        <img class="fad fa-calendar-alt icon" alt="" src="\Doctor\images\logout.png"></img>
        <div>logout</div>
    </a>
</div>
<script>
const changeactive = (e) => {
    // e.preventDefault()
    let data = document.querySelectorAll(".list_item");
    data.forEach((e) => {
        e.classList.remove('active')
    });
    e.classList.add('active')
}
</script>