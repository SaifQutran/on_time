<?php
function sittingbar($imgURL = "")
{
?>
    <header>
        <div class="logo" title="University Management System">
            <img src="../assets/images/logo.png" alt="">
        </div>
        <div class="navbar">
            <a href="dashboard.php" class=" text-decoration-none">
                <span class="material-icons-sharp">home</span>
                <h3>الصفحة الرئيسية</h3>
            </a>
            <a href="timetable.html" class="text-decoration-none" onclick="timeTableAll()">
                <span class="material-icons-sharp">today</span>
                <h3>Time Table</h3>
            </a>
            <a href="test.php" class="text-decoration-none">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Examination</h3>
            </a>
            <a href="settings.php" class="active text-decoration-none">
                <span class="material-icons-sharp">settings</span>
                <h3>الإعدادات</h3>
            </a>
            <a href="../Views/logout.php">
                <span class="material-icons-sharp" onclick="">logout</span>
                <h3>تسجيل الخروج</h3>
            </a>
        </div>
        <div id="profile-btn">
            <span class="material-icons-sharp">person</span>
        </div>
        <!-- <div class="theme-toggler">
            <span class="material-icons-sharp active">light_mode</span>
            <span class="material-icons-sharp">dark_mode</span>
        </div> -->

    </header>

<?php
}
