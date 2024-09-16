<?php
//include "../Model/Table.php";
include "../Model/User.php";
use Model\User;
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
                <input type="text" name="phone" class="form-control text-start w-75 h-25 me-auto ms-auto">

                <label for="password" class="form-label mt-3 w-75 me-auto text-start ms-auto">كلمة السر</label>
                <input type="password" name="password" class="form-control h-25 text-start w-75 me-auto ms-auto">
                <?php
                if (isset($_POST['login'])) {

                    //Model\Table::setConn();
                    $phone = User::findColumn('phone', $_POST['phone']);
                    $password = User::findColumn('password', $_POST['password']);
                    if (!isset($phone['user_id']) || !isset($password['user_id'])) {
                        echo "<p class='text-danger text-bold'>رقم الجوال أو كلمة السر خطأ</p>";
                } else {
                        if ($phone['user_id'] == $password['user_id']) {
                            session_start();
                            $_SESSION['user'] = serialize(new User(User::Find($password['user_id'])));
                            header("Location: dashboard.php");
                        } else
                        echo "out";
                        //$_SESSION['login'] = serialize();}
                    }
                }
                ?>
                <input type="submit" value="دخول" class="text-center btn btn-success btn-lg ms-auto me-auto login-button mt-5" name="login">
            </form>
        </div>
    </div>
</body>
<?php
closeHTML();
