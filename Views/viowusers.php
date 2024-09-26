<?php

include "../components/head.php";
include "../components/sitting.php";

include "../Model/Table.php";
include "../Model/User.php";

head(" الإعدادات");
session_start();
$user = unserialize($_SESSION['user']);

Model\Table::setConn();
$users = Model\User::All();



?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap.css">
    <title>عرض الموظفين</title>
    <link rel="stylesheet" href="../Views/styelss.css">
    <style>
        body {
            direction: rtl;
            background-color: #f8f9fa;
            font-size: 15px;
        }

        .contai {
            margin-top: 20px;
            position: relative;
            top: 30px;

        }

        .table thead th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body data-bs-theme="light">
    <?php sittingbar(); ?>
    <div class="contai">
        <h1 class="text-center">عرض الموظفين </h1>
        <div class="text-end mb-3">
            <a href="add_user.php" class="btn btn-primary">
                إضافة موظف&nbsp;&nbsp;<i class="fa fa-plus"></i>
            </a>
        </div>
        <?php
        if (isset($users['error'])) {
            echo "<div class='alert alert-danger text-center'>" . $users['error'] . "</div>";
        } elseif (isset($users['info'])) {
            echo "<div class='alert alert-info text-center'>" . $users['info'] . "</div>";
        } else {
            echo '<table class="table table-bordered table-striped text-center">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>معرف   </th>';
            echo '<th> الاسم الأول </th>';
            echo '<th> اسم الأب </th>';

            echo '<th>اسم العائلة</th>';
            echo '<th> الوظيفة</th>';
            echo '<th>البريد الإلكتروني</th>';

            echo '<th>رقم الهاتف</th>';
            echo '<th>كلمة المرور </th>';
            echo '<th> مدير </th>';
            echo '<th> العمليات </th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($users as $fetch) {
                echo '<tr>';
                echo '<td>' . $fetch['user_id'] . '</td>';
                echo '<td>' . $fetch['first_name'] . '</td>';
                echo '<td>' . $fetch['middle_name'] . '</td>';
                echo '<td>' . $fetch['last_name'] . '</td>';
                echo '<td>' . $fetch['title'] . '</td>';
                echo '<td>' . $fetch['email'] . '</td>';
                echo '<td>' . $fetch['phone'] . '</td>';
                echo '<td>' . $fetch['password'] . '</td>';
                if ($fetch['is_manager'] == 1) {
                    echo '<td> مدير</td>';
                } else {
                    echo '<td> موظف</td>';
                }


                echo '<td>';
                echo '<a href="../Views/edit_user.php?user_id=' . $fetch['user_id'] . '" class="btn btn-warning">تعديل</a>'; // زر التعديل
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }

        ?>
    </div>
</body>