<?php

use Model\Table;

include "../components/head.php";
include "../components/sitting.php";
include "../Model/employees.php";
include "../Model/Group.php";
include "../Model/Group_member.php";
head(" الإعدادات");
session_start();




Table::setConn();

$group_name = "";
$user_id = [];
$message = "";

$user = unserialize($_SESSION['user']);

if (isset($_POST["adds"])) {
    $group_name = $_POST["group_name"];
    $employee_names = $_POST['employee_names'] ?? [];

    if (empty($employee_names)) {
        echo "<script>alert('يرجى إدراج موظف واحد على الأقل قبل إنشاء القروب.');</script>";
    } else {
        $add = new Model\Group();
        $add->add_group($group_name);
        $user_id = [];

        $addds = new Model\Group_member();
        $addds->group_member($employee_names);


        $message = "تم إنشاء القروب بنجاح!";
    }
}

$show = new Model\Employees;


?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>نموذج المهام</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="task.css">



    <link rel="stylesheet" href="../Views/styelss.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
        }

        .btn-custom {
            background-color: #28a745;
            color: #fff;
        }

        .btn-custom:hover {
            background-color: #218838;
            color: #fff;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            color: #fff;
        }
    </style>
</head>

<body data-bs-theme="light">
    <?php sittingbar(); ?>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <form action="" method="POST" class="form-container w-50">
            <h2 class="text-center mb-4">إضافة قروب</h2>


            <?php if (!empty($message)): ?>
                <div class="alert alert-success text-center" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="group_name" class="font-weight-bold">اسم القروب:</label>
                <input type="text" id="group_name" name="group_name" class="form-control" required />
            </div>

            <h3 class="mt-4">إضافة موظف</h3>
            <div id="employees"></div>
            <button type="button" id="addEmployeeField" class="btn btn-secondary mb-3">إضافة حقل موظف جديد</button>

            <button name="adds" type="submit" class="btn btn-custom">إنشاء قروب</button>
        </form>

        <datalist id="employeeList">
            <?php echo $show->shows(); ?>
        </datalist>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const addedEmployees = new Set();

        document.getElementById('addEmployeeField').addEventListener('click', function() {
            const newInput = document.createElement('input');
            newInput.setAttribute('list', 'employeeList');
            newInput.name = 'employee_names[]';
            newInput.placeholder = 'اختر موظف أو أدخل اسم موظف جديد';
            newInput.classList.add('form-control', 'mb-2');

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'employee_id[]';
            hiddenInput.classList.add('employee-id');

            newInput.addEventListener('change', function() {
                const employeeValue = newInput.value.trim();
                const selectedOption = [...document.querySelectorAll('#employeeList option')]
                    .find(option => option.value === employeeValue);

                if (selectedOption) {
                    hiddenInput.value = selectedOption.getAttribute('data-id');
                    if (!addedEmployees.has(employeeValue)) {
                        addedEmployees.add(employeeValue);
                    }
                } else {
                    alert("الرجاء اختيار موظف من القائمة.");
                    newInput.value = '';
                    hiddenInput.value = '';
                }
            });

            document.getElementById('employees').appendChild(newInput);
            document.getElementById('employees').appendChild(hiddenInput);
        });
    </script>
</body>
