<?php

include "../components/head.php";
include "../components/sitting.php";

include "../Model/Table.php";
include "../Model/User.php";

use Model\Table;
use Model\Type;

head(" الإعدادات");
session_start();


$user = unserialize($_SESSION['user']);

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
        <h1 class="text-center">تعديل بيانات الموظف</h1>

        <?php
        if (isset($_GET['user_id'])) {
            $user_id = intval($_GET['user_id']);

            
            $result = Model\User::Find($user_id);

            if (isset($result['error'])) {
                echo "<div class='alert alert-danger'>" . htmlspecialchars($result['error']) . "</div>";
            } else {
                if (empty($result)) {
                    echo "<div class='alert alert-warning'>لا توجد بيانات لهذا ID.</div>";
                } else {
                    $row = $result[0];
                }
                if (isset($_POST['edit'])) {
                    $user_id = $_POST['user_id'];
                    $first_name = $_POST['first_name'];
                    $middle_name  = $_POST['middle_name'];
                    $last_name = $_POST['last_name'];
                    $title = $_POST['title'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    $password = $_POST['password'];
                    $is_manager = isset($_POST['is_manager']);

                    $userss->edituser($user_id, $first_name, $middle_name, $last_name, $user_photo, $title, $email, $phone, $password, $is_manager);
                }

        ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="user_id" class="form-label"> معرف الموظف</label>
                            <input name="user_id" type="number" class="form-control" value="<?php echo $row['user_id']; ?>" required />
                        </div>
                        <div class="col-md-4">
                            <label for="first_name" class="form-label">الاسم الأول</label>
                            <input name="first_name" type="text" class="form-control" value="<?php echo $row['first_name']; ?>" required />
                        </div>
                        <div class="col-md-4">
                            <label for="middle_name" class="form-label">اسم الأب</label>
                            <input name="middle_name" type="text" class="form-control" value="<?php echo $row['middle_name']; ?>" required />
                        </div>
                        <div class="col-md-4">
                            <label for="last_name" class="form-label">اسم العائلة</label>
                            <input name="last_name" type="text" class="form-control" value="<?php echo $row['last_name']; ?>" required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="user_photo" class="form-label">الصورة</label>
                            <input name="user_photo" type="file" class="form-control" />
                        </div>
                        <div class="col-md-4">
                            <label for="title" class="form-label">الوظيفة</label>
                            <input name="title" type="text" class="form-control" value="<?php echo $row['title']; ?>" required />
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input name="email" type="email" class="form-control" value="<?php echo $row['email']; ?>" required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                            <input name="phone" type="number" class="form-control" value="<?php echo $row['phone']; ?>" />
                        </div>
                        <div class="col-md-4">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input name="password" type="password" class="form-control" required />
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input name="is_manager" type="checkbox" class="box form-check-input" value="<?php echo $row['is_manager']; ?>" id="is_manager" required />
                                <label class="mangers form-check-label" for="is_manager">مدير</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button name="edit" type="submit" class="btn btn-primary">إرسال</button>
                        <a href="viowusers.php" class="btn btn-secondary">رجوع</a>
                    </div>
                </form>
        <?php
            }
        }

        ?>
    </div>

</body>