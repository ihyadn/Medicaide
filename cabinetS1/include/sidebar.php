<div class="doctor_info">
    <img alt="" src="\CabinetS1\images\secretary.png" class="doc_img"></img>
    <div class="nom_docteur">
        <h4>Secretaire</h4>
    </div>
</div>
<div class="sidebar_list">
    <a class="<?php echo 'list_item'.($_SERVER['REQUEST_URI']=="/cabinetS1/"?' active':'')?> "
        onclick="changeactive(this)" href="/cabinetS1">
        <img class="fad fa-calendar-alt icon" alt="" src="\CabinetS1\images\appointments.png"></img>
        <div>prise de rendez-vous</div>
    </a>
    <a class="<?php echo 'list_item'.($_SERVER['REQUEST_URI']=="/cabinetS1/pages/rendezVous.php"?' active':'')?> "
        onclick=" changeactive(this)" href="/cabinetS1/pages/rendezVous.php">
        <img class="fad fa-calendar-alt icon" alt="" src="\CabinetS1\images\deadline.png"></img>
        <div>liste rendez-vous</div>
    </a>
    <a class="<?php echo 'list_item'.($_SERVER['REQUEST_URI']=="/cabinetS1/pages/patients.php"?' active':'')?> "
        onclick="changeactive(this)" href="/cabinetS1/pages/patients.php">
        <img class="fad fa-calendar-alt icon" alt="" src="\CabinetS1\images\examination.png"></img>
        <div>Patients</div>
    </a>
    <a class="<?php echo 'list_item'.($_SERVER['REQUEST_URI']=="/cabinetS1/pages/Comptabilte.php"?' active':'')?> "
        onclick="changeactive(this)" href="/cabinetS1/pages/Comptabilte.php">
        <img class="fad fa-calendar-alt icon" alt="" src="\CabinetS1\images\examination.png"></img>
        <div>Comptabilité</div>
    </a>
    <a class="list_item" onclick="changeactive(this)" href="\CabinetS1\logout.php">
        <img class="fad fa-calendar-alt icon" alt="" src="\CabinetS1\images\logout.png"></img>
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