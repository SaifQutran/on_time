<?php

include "../components/head.php";
include "../components/sitting.php";
include "../Model/Table.php";
include "../Model/Type.php";

use Model\Table;

head("الإعدادات");
session_start();

Table::setConn();
$type = new Model\Type();
$types = $type->viowtype();

$user = unserialize($_SESSION['user']);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap.css">
    <link rel="stylesheet" href="../Views/styelss.css">
    <title>عرض الأنواع</title>
    <style>
        body {
            direction: rtl;
            background-color: #f8f9fa;
            /* font-family: 'Arial', sans-serif; */
            font-size: 15px;
        }

        .container-fluid {
            margin-top: 20px;
        }

        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
        }

        .table thead th {
            background-color: #007bff;
            color: white;
        }

        .alert {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }
    </style>
</head>

<body data-bs-theme="light">
    <?php sittingbar(); ?>

    <div class="container-fluid">
        <h1 class="text-center">عرض الأنواع</h1>
        <div class="text-end mb-3">
            <a href="add_type.php" class="btn btn-primary">
                إضافة نوع&nbsp;&nbsp;<i class="fa fa-plus"></i>
            </a>
        </div>
        <?php
        if (isset($types['error'])) {
            echo "<div class='alert alert-danger text-center'>" . $types['error'] . "</div>";
        } elseif (isset($types['info'])) {
            echo "<div class='alert alert-info text-center'>" . $types['info'] . "</div>";
        } else {
            echo '<table class="table table-bordered table-striped text-center">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>معرف النوع</th>';
            echo '<th>اسم النوع</th>';
            echo '<th>اللون</th>';
            echo '<th>العمليات</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($types as $fetch) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($fetch['type_id']) . '</td>';
                echo '<td>' . htmlspecialchars($fetch['type']) . '</td>';
                echo '<td style="background-color: ' . htmlspecialchars($fetch['type_color']) . ';"></td>';
                echo '<td>';
                echo '<a href="edit_type.php?type_id=' . htmlspecialchars($fetch['type_id']) . '" class="btn btn-warning">تعديل</a>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }
        ?>
    </div>
</body>