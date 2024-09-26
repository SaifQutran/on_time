<?php

include "../components/head.php";
include "../components/sitting.php";

head("الإعدادات");
session_start();

$user = unserialize($_SESSION['user']);

?>

<head>
    <link rel="stylesheet" href="../Views/styelss.css">
    <style>
        .button-container {
            position: fixed;
            right: 70%;
            bottom: 80px;
            display: flex;
            /* استخدام flexbox لتوزيع الأزرار أفقيًا */
            gap: 10px;
            /* إضافة مسافة 10px بين الأزرار */
        }

        .btn-custom {
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body data-bs-theme="light">
    <?php sittingbar(); ?>
    <div class="button-container">
        <a href="viowusers.php" class="btn btn-warning rounded-5 p-3 btn-custom">
            الموظفين&nbsp;&nbsp;<i class="fa fa-plus"></i>
        </a>
        <a href="priority_viow.php" class="btn btn-secondary rounded-5 p-3 btn-custom">
            الحالات&nbsp;&nbsp;<i class="fa fa-plus"></i>
        </a>
        <a href="viowgroup.php" class="btn btn-success rounded-5 p-3 btn-custom">
            المجموعات&nbsp;&nbsp;<i class="fa fa-plus"></i>
        </a>
        <a href="type_viow.php" class="btn btn-info rounded-5 p-3 btn-custom">
            النوع&nbsp;&nbsp;<i class="fa fa-plus"></i>
        </a>
    </div>

</body>