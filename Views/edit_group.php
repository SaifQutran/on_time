<?php
include "../components/head.php";
include "../components/sitting.php";

include "../Model/Table.php";
include "../Model/Group.php";

use Model\Table;
use Model\User;

head("تعديل المجموعة");
session_start();
$user = unserialize($_SESSION['user']);

Table::setConn();
$viogroup = new Model\Group();

// افترض أنك تحصل على معرف المجموعة من الرابط
$group_id = $_GET['group_id'];
$group = $viogroup->getGroupById($group_id); // يجب أن يكون لديك دالة للحصول على تفاصيل المجموعة



?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../bootstrap.css">
    <link rel="stylesheet" href="../Views/styelss.css">
    <title>تعديل المجموعة</title>
    <style>
        body {
            direction: rtl;
            background-color: #f8f9fa;
            font-size: 15px;
        }

        .container {
            margin-top: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            /* زيادة المسافة بين الحقول */
        }

        .btn-primary {
            margin-top: 10px;
            /* إضافة مسافة فوق الزر */
        }
    </style>
</head>

<body data-bs-theme="light">
    <?php sittingbar(); ?>

    <div class="container">
        <h1 class="text-center mb-4">تعديل المجموعة</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="group_name">اسم المجموعة</label>
                <input type="text" class="form-control" id="group_name" name="group_name" value="<?php echo htmlspecialchars($group['group']); ?>" required>
            </div>
            <div class="form-group">
                <label for="group_color">لون المجموعة</label>
                <input type="color" class="form-control" id="group_color" name="group_color" value="<?php echo htmlspecialchars($group['group_color']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">تحديث المجموعة</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>