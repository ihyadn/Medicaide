<?php
//index.php
session_start();
if (!isset($_SESSION["role"])){
    header('location:/CabinetS1/pages/login.php');
}
else if($_SESSION["role"]=="medecin")
{
    header("location:/Doctor/pages/dashboard.php");
}

?>
<!DOCTYPE html>
<html>

<?php include("include/head.php")?>

<body>
    <div class="main d-flex">
        <div class="sidebar">
            <?php include("include/sidebar.php")?>
        </div>
        <div class="dashboard">
            <div class="calendar">
                <div class="main_cal d-flex">
                    <?php include("calendrier/calendar.php")?>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
</script>

</html>