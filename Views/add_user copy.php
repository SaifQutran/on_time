<?php

include "../components/head.php";
include "../components/sitting.php";
include "../Model/Table.php";
include "../Model/User.php";

use Model\Table;

head(" الإعدادات");
session_start();
$token = uniqid("tkn");


$user = unserialize($_SESSION['user']);

$first_name = "";
$middle_name = "";
$last_name = "";
$user_photo = "";
$title = "";
$email = "";
$phone = "";
$password = "";
$is_manager = false;
$success_message = ""; // متغير لتخزين رسالة النجاح

Table::setConn();

if (isset($_POST['send'])) {
    $first_name = $_POST['first_name'];
    $middle_name  = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $title = $_POST['title'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $is_manager = isset($_POST['is_manager']);

    // if (Model\User::add_user(
    //     $first_name,
    //     $middle_name,
    //     $last_name,
    //     $title,
    //     $email,
    //     $phone,
    //     $password,
    //     $is_manager
    // )) {
    //     $success_message = "تمت الإضافة بنجاح."; // تعيين رسالة النجاح
    // }
    
   Model\User::add_user(
        $first_name,
        $middle_name,
        $last_name,
        $user_photo,
        $title,
        $email,
        $phone,
        $password,
        $is_manager,
        $token
    );

    $selected = Model\User::getLast();
    $directory = "../attachments/users/" . $selected[0] . "/";
    $user_photo = $_FILES['user_photo'];
    $user_extention = explode('.', $user_photo['name'])[1];
    $user_tmp = $user_photo['tmp_name'];
    $destination = $directory . "pic." . $user_extention;

    if (!is_dir($directory)) {
        try {
            mkdir($directory, 0755);
        } catch (Exception $ex) {
            echo " " . $ex->getMessage() . "<br>";
        }
    }

    if (move_uploaded_file($user_tmp, $destination)) {
        $user_photo = $destination;
    } else {
        echo "خطأ في رفع الصورة.<br>";
        exit();
    }

    Model\User::Update(['user_photo'], [$user_photo], $selected[0]);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافة موظف </title>
    <link rel="stylesheet" href="../bootstrap.css">
    <link rel="stylesheet" href="../Views/styelss.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            position: relative;
            top: 100px;
            padding: 20px;
            width: 100%;

            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);


        }

        .mangers {
            position: relative;
            right: 140px;
            font-size: 20px;

        }

        .box {
            position: relative;

            font-size: 20px;
            left: 10px;
        }

        h1 {
            color: #343a40;
        }
    </style>
</head>

<body data-bs-theme="light">
    <?php sittingbar(); ?>
    <div class="container">
        <h1 class="text-center mb-4">معلومات المستخدم</h1>

        <?php if ($success_message): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="first_name" class="form-label">الاسم الأول</label>
                    <input name="first_name" type="text" class="form-control" required />
                </div>
                <div class="col-md-4">
                    <label for="middle_name" class="form-label">اسم الأب</label>
                    <input name="middle_name" type="text" class="form-control" required />
                </div>
                <div class="col-md-4">
                    <label for="last_name" class="form-label">اسم العائلة</label>
                    <input name="last_name" type="text" class="form-control" required />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="user_photo" class="form-label">الصورة</label>
                    <input name="user_photo" type="file" class="form-control" required />
                </div>
                <div class="col-md-4">
                    <label for="title" class="form-label">الوظيفة</label>
                    <input name="title" type="text" class="form-control" required />
                </div>
                <div class="col-md-4">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input name="email" type="email" class="form-control" required />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="phone" class="form-label">رقم الهاتف</label>
                    <input name="phone" type="tel" class="form-control" />
                </div>
                <div class="col-md-4">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input name="password" type="password" class="form-control" required />
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input name="is_manager" type="checkbox" class="box form-check-input" value="1" id="is_manager" />
                        <label class="mangers form-check-label" for="is_manager">مدير</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button name="send" type="submit" class="btn btn-primary">إرسال</button>
                <a href="viowusers.php" class="btn btn-secondary">رجوع</a>
            </div>
        </form>
    </div>


</body>