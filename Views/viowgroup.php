<?php
include "../components/head.php";
include "../components/sitting.php";

include "../Model/Table.php";
include "../Model/Group.php";

use Model\Table;
use Model\Group;

head("عرض المجموعات");
session_start();
$user = unserialize($_SESSION['user']);

Table::setConn();
$groupModel = new Model\Group();
$groups = $groupModel->viowgroupuser(); // استدعاء المجموعات

?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../bootstrap.css">
    <link rel="stylesheet" href="../Views/styelss.css">
    <title>عرض المجموعات</title>
    <style>
        body {
            direction: rtl;
            background-color: #f0f4f8;
            font-size: 15px;
        }

        .contai {
            margin-top: 20px;
            position: relative;
            top: 30px;
        }

        .card {
            margin: 10px;
            /* إضافة مسافة 10px من جميع الاتجاهات */
            height: 100%;
            transition: transform 0.2s, box-shadow 0.2s;
            /* التأثيرات عند hover */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            /* التأكد من أن padding و border يتم احتسابهم في الحجم الكلي */
        }

        .card:hover {
            transform: scale(1.05);
            /* التكبير عند hover */
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
        }

        .card-text {
            color: #555;
        }

        @media (max-width: 768px) {
            .col-2 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        .row {
            margin-bottom: 10px;
            /* ضبط المسافة بين الصفوف إلى 10 بكسل */
        }
    </style>
</head>

<body data-bs-theme="light">

    <?php sittingbar(); ?>

    <div class="contai">
        <h1 class="text-center mb-4">عرض المجموعات</h1>
        <a href="../Views/add_group.php" class="btn btn-primary">
                إضافة مجموعة &nbsp;&nbsp;<i class="fa fa-plus"></i>
            </a>
        <div class="row">
            <?php
            foreach ($groups as $group) {
                
                $membersDetails = $groupModel->getMembersDetailsByGroupId($group['group_id']);

                echo '<div class="col-2">';
                echo '<div class="card" style="border-left: 5px solid ' . $group['group_color'] . ';">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $group['group']. '</h5>';
                echo '<p class="card-text">معرف المجموعة: ' . $group['group_id'] . '</p>';

                // عرض الأعضاء
                if (!empty($membersDetails)) {
                    echo '<h6 class="mt-2">الأعضاء:</h6>';
                    echo '<ul>';
                    foreach ($membersDetails as $member) {
                        echo '<li>' . htmlspecialchars($member['full_name']);
                    }
                    echo '</ul>';
                } else {
                    echo '<p>لا يوجد أعضاء في هذه المجموعة.</p>';
                }

                echo '</div>';
                echo '</div>'; // إنهاء الكارد
                echo '</div>'; // إنهاء العمود
            }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>