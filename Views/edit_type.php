<?php

include "../components/head.php";
include "../components/sitting.php";

include "../Model/Table.php";
include "../Model/task_type.php";

use Model\Table;
use Model\Type;

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
            padding: 30px;
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
        <h1 class="text-center">تعديل بيانات النوع</h1>

        <?php


        if (isset($_GET['type_id'])) {
            $type_id = intval($_GET['type_id']);

            $typeModel = new Model\task_type();
            $result = $typeModel->viowid($type_id);

            if (isset($result['error'])) {
                echo "<div class='alert alert-danger'>" . htmlspecialchars($result['error']) . "</div>";
            } else {
                if (empty($result)) {
                    echo "<div class='alert alert-warning'>لا توجد بيانات لهذا ID.</div>";
                } else {
                    $row = $result[0];
                }
                if (isset($_POST['edit'])) {
                    $type_id = $_POST['type_id'];
                    $type = $_POST['type'];
                    $type_color = $_POST['type_color'];

                    $typeModelw = new Model\task_type();
                    $typeModelw->edittype($type_id, $type, $type_color);
                }

        ?>
                <form action="" method="post">
                    <input type="hidden" name="type_id" value="<?php echo htmlspecialchars($row['type_id']); ?>">
                    <div class="form-group">
                        <label for="type">المعرف:</label>
                        <input type="text" id="type" name="type_id" class="form-control" value="<?php echo htmlspecialchars($row['type_id']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="type">النوع:</label>
                        <input type="text" id="type" name="type" class="form-control" value="<?php echo htmlspecialchars($row['type']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="type_color">اللون:</label>
                        <input type="color" id="type_color" name="type_color" class="form-control" value="<?php echo htmlspecialchars($row['type_color']); ?>" required>
                    </div>

                    <button name="edit" type="submit" class="btn btn-primary btn-block">تحديث البيانات</button>
                    <a href="type_viow.php" class="btn btn-secondary">رجوع</a>
                </form>
        <?php
            }
        }

        ?>
    </div>

</body>