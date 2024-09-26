<?php

include "../components/head.php";
include "../components/sitting.php";
include "../Model/Table.php";
include "../Model/task_priority.php";

use Model\Table;
use Model\task_priority;

head(" الإعدادات");
session_start();


$user = unserialize($_SESSION['user']);

?>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل بيانات النوع</title>
    <link rel="stylesheet" href="../bootstrap.css">
    <link rel="stylesheet" href="../Views/styelss.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 80px;
            margin-top: 50px;
            position: relative;
            top: 50px;
            
        }

        h1 {
            color: #343a40;
            margin-bottom: 30px;
        }

        button {
            margin-top: 10px;
        }
    </style>
</head>

<body data-bs-theme="light">
    <?php sittingbar(); ?>
    <div class="container">
        <h1 class="text-center">تعديل بيانات الحالة</h1>

        <?php


        if (isset($_GET['priority_id'])) {
            $priority_id = intval($_GET['priority_id']);

            $priorityeid = new Model\Priority();
            $result = $priorityeid->viowid($priority_id);

            if (isset($result['error'])) {
                echo "<div class='alert alert-danger'>" . $result['error'] . "</div>";
            } else {
                if (empty($result)) {
                    echo "<div class='alert alert-warning'>لا توجد بيانات لهذا ID.</div>";
                } else {
                    $row = $result[0];
                }
                if (isset($_POST['edit'])) {
                    $priority_id = $_POST['priority_id'];
                    $priority = $_POST['priority'];
                    $priority_color = $_POST['priority_color'];


                    $priorityObject = new Model\Priority();
                    $priorityObject->editpriority($priority_id, $priority, $priority_color);
                }

        ?>
                <form action="" method="post">
                    <input type="hidden" name="priority_id" value="<?php echo htmlspecialchars($row['priority_id']); ?>">
                    <div class="form-group">
                        <label for="type">معرف الحالة:</label>
                        <input type="text" id="priority_id" name="priority_id" class="form-control" value="<?php echo $row['priority_id']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="type">الحالة:</label>
                        <input type="text" id="priority" name="priority" class="form-control" value="<?php echo $row['priority']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="type_color">اللون:</label>
                        <input type="color" id="priority_color" name="priority_color" class="form-control" value="<?php echo $row['priority_color']; ?>" required>
                    </div>

                    <button name="edit" type="submit" class="btn btn-primary btn-block">تحديث البيانات</button>
                    <a href="priority_viow.php" class="btn btn-secondary">رجوع</a>
                </form>
        <?php
            }
        }

        ?>
    </div>

</body>