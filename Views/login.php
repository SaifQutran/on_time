<?php
if (!empty($_SESSION['user'])) {
    header('Location: Views/dashboard.php');
}
include '../components/head.php';
head("تسجيل الدخول");
?>

<body class="bg-grad">


    <div class="container h-25 ">
        <div class="login-form ms-auto me-auto rounded-5 w-50 bg-success-subtle p-5 mt-5">
            <div class="form-header d-flex">
                <img src="../assets//R (1).png" alt="" class="text-center ms-auto me-auto login-logo">
            </div>
            <form action="" method="post">

                <label for="phone" class="form-label text-lg text-start  w-75 mt-3 me-auto ms-auto">رقم الجوال</label>
                <input type="tel" name="phone" class="form-control text-start w-75 h-25 me-auto ms-auto">

                <label for="password" class="form-label mt-3 w-75 me-auto text-start ms-auto">كلمة السر</label>
                <input type="password" name="password" class="form-control h-25 text-start w-75 me-auto ms-auto">
                <input type="submit" value="دخول" class="text-center btn btn-success btn-lg ms-auto me-auto login-button mt-5" name="login">
            </form>
        </div>
    </div>
</body>