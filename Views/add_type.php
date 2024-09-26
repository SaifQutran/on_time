<?php

include "../components/head.php";
include "../components/sitting.php";

include "../Model/Table.php";
include "../Model/task_type.php";

use Model\Table;
use Model\task_type;


Table::setConn();

head(" الإعدادات");
session_start();


$user = unserialize($_SESSION['user']);


if (isset($_POST['adds'])) {
    $type = $_POST['type'];
    $type_color = $_POST['type_color'];


    $newType = new Model\Type();


    $newType->addType($type, $type_color);
    header("type_viow.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap.css">
    <title>إضافة نوع جديد</title>
    <link rel="stylesheet" href="../Views/styelss.css">
    <style>
        body {
            direction: rtl;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
            height: 500px;
            position: relative;
            top: 70px;
        }
    </style>
</head>

<body data-bs-theme="light">
    <?php sittingbar(); ?>

    <div class="container">
        <h1 class="text-center">إضافة نوع جديد</h1>
        <form method="post" action="">
            <div class="mb-3">
                <label for="type" class="form-label">اسم النوع</label>
                <input type="text" class="form-control" id="type" name="type" required>
            </div>
            <div class="mb-3">
                <label for="type_color" class="form-label">اللون</label>
                <input type="color" class="form-control" id="type_color" name="type_color" required>
            </div>
            <div class="text-center">
                <button name="adds" type="submit" class="btn btn-primary me-2">إضافة نوع</button>
                <a href="type_viow.php" class="btn btn-secondary">رجوع</a>
            </div>
        </form>
    </div>

</body>