<?php

include "../components/head.php";
include "../components/sitting.php";
include "../Model/Table.php";
include "../Model/Priority.php";
//include "../Model/task_priority.php";

use Model\Priority;
use Model\Table;
use Model\task_priority;


head(" الإعدادات");
session_start();


$user = unserialize($_SESSION['user']);
Table::setConn();

$prioritys = Model\Priority::All();


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
            top: 40px;
            width: 90%;
            right: 60px;

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
        <h1 class="text-center">عرض الحالات </h1>
        <div class="text-end mb-3">
            <a href="../Views/add_priority.php" class="btn btn-primary">
                إضافة حاله&nbsp;&nbsp;<i class="fa fa-plus"></i>
            </a>
        </div>
        <?php
        if (isset($prioritys['error'])) {
            echo "<div class='alert alert-danger text-center'>" . $prioritys['error'] . "</div>";
        } elseif (isset($prioritys['info'])) {
            echo "<div class='alert alert-info text-center'>" . $prioritys['info'] . "</div>";
        } else {
            echo '<table class="table table-bordered table-striped text-center">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>معرف الحالة </th>';
            echo '<th>اسم الحاله</th>';
            echo '<th>اللون</th>';
            echo '<th>العمليات</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($prioritys as $fetch) {
                echo '<tr>';
                echo '<td>' . $fetch['priority_id'] . '</td>';
                echo '<td>' . $fetch['priority'] . '</td>';
                echo '<td style="background-color: ' . $fetch['priority_color'] . ';">' . "" . '</td>';
                echo '<td>';
                echo '<a href="edit_piority.php?priority_id=' . $fetch['priority_id'] . '" class="btn btn-warning">تعديل</a>'; // زر التعديل
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }
        ?>
    </div>
</body>