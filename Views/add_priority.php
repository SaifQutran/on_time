<?php

include "../components/head.php";
include "../components/sitting.php";
include "../Model/Table.php";
//include "../Model/task_priority.php";

use Model\Table;

use Model\task_priority;


head(" الإعدادات");
session_start();


$user = unserialize($_SESSION['user']);

Table::setConn();
class Add_type extends Table
{
    protected $priority_id;
    protected $priority;
    protected $priority_color;
}
if (isset($_POST['adds'])) {



    $priority = $_POST['priority'];
    $priority_color = $_POST['priority_color'];

    $addpriority = new Model\Priority();
    $addpriority->addpriority($priority, $priority_color);

    header("Location: ../Views/priority_viow.php");
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
            top: 200px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            /* padding: 20px; */

            height: 300px;
            /* margin-top: 40px;
            max-width: 900px; */
            /* تحديد عرض الحاوية */
            margin-left: auto;
            /* محاذاة الوسط */
            margin-right: auto;
            /* محاذاة الوسط */
        }

        h1 {
            color: #343a40;
        }
    </style>
</head>

<body data-bs-theme="light">
    <?php sittingbar(); ?>


    <div class="container mt-4">
        <h2 class="text-center">اضافة حالة</h2>
        <form method="post" action="">

            <div class="mb-3">
                <label for="type" class="form-label">اسم الحالة</label>
                <input type="text" class="form-control" name="priority" required>
            </div>
            <div class=" mb-3">
                <label for="type_color" class="form-label">اللون</label>
                <input type="color" class="form-control" name="priority_color" required>
            </div>
            <div class="text-center">
                <button name="adds" type="submit" class="btn btn-primary">حفظ </button>
                <a href="../Views/priority_viow.php" class="btn btn-secondary ms-2">رجوع</a>
            </div>
        </form>
    </div>

</body>