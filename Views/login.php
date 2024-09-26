<?php

use Model\Table;

include "../Model/Table.php";
include "../Model/User.php";

use Model\User;

session_start();
//session_unset();
Model\Table::setConn();

if (!empty($_SESSION['user'])) {
    header('Location: dashboard.php');
}

include '../components/head.php';
head("تسجيل الدخول");
?>
<div class="main">
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="../assets/images/logo.png" alt="sing up image"></figure>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">تسجيل الدخول</h2>
                    <form method="post" class="register-form" id="login-form">
                        <div class="form-group">
                            <input type="text" name="phone" id="phone" placeholder="رقم الجوال" />
                            <label class="login-label" for="phone"><i class="text-start  zmdi zmdi-account material-icons-name"></i></label>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" placeholder="كلمة السر" />
                            <label class="login-label"  for="password"><i class="zmdi zmdi-lock"></i></label>
                        </div>
                        <?php
                        
                        if (isset($_POST['login'])) {
                        //    echo "dseq";
                            Model\Table::setConn();
                            $phone = User::findColumn('phone', $_POST['phone']);
                            $password = User::findColumn('password', $_POST['password']);
                          //  var_dump($phone);
                           // var_dump($password);
                            if (!isset($phone[0]['user_id']) || !isset($password[0]['user_id'])) {

                                echo "<p class='text-danger text-bold'>رقم الجوال أو كلمة السر خطأ</p>";
                            } else {
                                if ($phone[0]['user_id'] == $password[0]['user_id']) {
//                                    session_start();
                                    $_SESSION['user'] = serialize(new User(User::Find($password[0]['user_id'])));
                                       header("Location: dashboard.php");
                                }
                            }
                        }
                        ?>
                        <div class="form-group form-button">
                            <input type="submit" name="login" id="Login" class="form-submit fw-semibold fs-2" value="دخــول" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
closeHTML();
