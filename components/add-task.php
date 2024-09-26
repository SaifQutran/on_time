<?php
$user = unserialize($_SESSION['user']);
$task_name = "";
$task_description = "";
$assigner = "";
$due_date = "";
$task_hours = "";
$group_id = "";
$task_type = "";
$user_id = $user->getUserId();
Model\Table::setConn();
$counter = 0;
if (isset($_POST["adds"])) {
    $task_name = $_POST["task_name"];
    $task_description = $_POST["task_description"];
    $due_date = $_POST["due_date"];
    $task_hours = isset($_POST["task_hours"]) ? $_POST["task_hours"] : "0";
    $group_id = isset($_POST["group_id"]) ? $_POST["group_id"] : "NULL";
    $type_id = isset($_POST["type_id"]) ? $_POST["type_id"] : "NULL";
    $priority_id = isset($_POST["priority_id"]) ? $_POST["priority_id"] : 1;
    $assigneees_id = [];
    $stepsCounter = 0;
    $steps = [];


    Model\Task::addtask(
        $task_name,
        $task_description,
        $due_date,
        $user_id,
        $group_id,
        $type_id,
        $priority_id,
        $task_hours
    );

    // $add = new Model\Step();
    // $add->add_step($steps, $user_id);
    $thisTask = Model\Task::getLast();

    foreach ($_POST as $key => $value) {
        if (strpos($key, "stepName") !== false) {
            $stepsCounter++;
        }
    }

    for ($i = 1; $i <= $stepsCounter; $i++) {
        if (isset($_POST["stepAssignee$i"])) {
            Model\Step::add_step($_POST["stepName$i"], $thisTask[0], $_POST["stepAssignee$i"]);
            $assigneees_id[] = $_POST["stepAssignee$i"];
        } else {
            Model\Step::add_step($_POST["stepName$i"], $thisTask[0]);
        }
    }


    foreach ($_POST as $key => $value) {
        if (strpos($key, "employee_names") !== false) {
            $assigneees_id[] = $value;
        }
    }

    $selected = Model\Task::getLast();

    $directory = "../attachments/tasks/" . $selected[0] . "/";
    $file = $_FILES['attachment'];
    $user_tmp = $file['tmp_name'];
    $destination = $directory . $file['name'];

    $last_name = $_POST['last_name'];
    if (!is_dir($directory)) {
        try {
            mkdir($directory, 0755);
        } catch (Exception $ex) {
            echo " " . $ex->getMessage() . "<br>";
        }
    }

    if (move_uploaded_file($user_tmp, $destination)) {
        $file = $destination;
    } else {
        echo "خطأ في رفع الصورة.<br>";
        exit();
    }

    $assigneees_id = array_unique($assigneees_id);
    Model\Task_operator::addTaskOps($thisTask[0], $assigneees_id);
    header("Location: dashboard.php");
} else {
}
?>
<style>
    input,
    textarea,
    select {
        margin-bottom: 15px;
        padding: 10px;
        border: 1px solid #aaa;
        border-radius: 5px;
    }

    input:focus,
    textarea:focus,
    select:focus {
        margin-bottom: 15px;
        padding: 10px;
        border: 2px solid #28a745;
        border-radius: 8px;
    }

    textarea {
        width: 100%;
    }

    button {
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }
</style>
<div class="modal fade " id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title fs-2" id="exampleModalLabel">أضف مهمة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="task_name">اسم المهمة:</label>
                <input type="text" id="task_name" name="task_name" required />

                <label for="task_description">وصف المهمة:</label>
                <textarea
                    id="task_description"
                    name="task_description"
                    rows="4"
                    required></textarea>

                <label for="due_date">تاريخ التسليم :</label>
                <input class="d-inline w-25" type="date" id="due_date" name="due_date" required />
                <label for="task_hours"> عدد الساعات :</label>
                <input class="w-25 d-inline" type="number" name="task_hours">
                <label for="attatchmet"> مرفقات المهمة :</label>
                <input class="w-25 d-inline" type="file" name="attachment">

                <br>
                <label for="group">اسم المجموعة:</label>
                <select name="group" class="d-inline-blocl" id="group">
                    <option value="NULL"></option>
                    <?php
                    $Groups = Model\Group::All();
                    foreach ($Groups as $Group) {
                    ?>
                        <option value="<?= $Group[0] ?>"><?= $Group[1] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <div id="employees"></div>
                <span class="btn btn-link text-decoration-none" id="addEmployeeField">إضافة موظف
                    <span class="fa fa-user-plus"></span>
                </span>
                <datalist id="employeeList">
                    <?php
                    $Users = Model\User::All();
                    foreach ($Users as $User) {
                    ?>
                        <option value="<?= $User[0] ?>"><?= $User[1] . " " . $User[3] ?></option>
                    <?php
                    }
                    ?>
                </datalist>

                <script>
                    const addedEmployees = new Set();

                    document.getElementById('addEmployeeField').addEventListener('click', function() {
                        const newInput = document.createElement('input');
                        newInput.setAttribute('list', 'employeeList');
                        newInput.name = 'employee_names[]';
                        newInput.placeholder = 'اختر موظف';
                        newInput.style.display = 'inline-block';

                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'employee_ids[]';
                        hiddenInput.classList.add('employee-id');

                        newInput.addEventListener('change', function() {
                            const employeeValue = newInput.value.trim();
                            const selectedOption = [...document.querySelectorAll('#employeeList option')]
                                .find(option => option.value === employeeValue);

                            if (selectedOption) {
                                hiddenInput.value = selectedOption.getAttribute('data-id');
                            } else {
                                hiddenInput.value = '';
                            }

                            if (employeeValue && !addedEmployees.has(employeeValue)) {
                                addedEmployees.add(employeeValue);
                            } else {
                                alert("هذا الموظف مضاف بالفعل.");
                                newInput.value = '';
                                hiddenInput.value = '';
                            }
                        });

                        document.getElementById('employees').appendChild(newInput);
                        document.getElementById('employees').appendChild(hiddenInput);
                    });
                </script>
                <label for="priotrity"> اهمية المهمة:</label>
                <select name="priotrity" id="priotrity">
                    <?php
                    $Priorities = Model\Priority::All();
                    foreach ($Priorities as $Priority) {
                    ?>
                        <option value="<?= $Priority[0] ?>"><?= $Priority[1] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label for="type"> نوع المهمة:</label>
                <select name="type" id="type">
                    <?php
                    $Types = Model\Type::All();
                    foreach ($Types as $Type) {
                    ?>
                        <option value="<?= $Type[0] ?>"><?= $Type[1] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <div id="Steps"></div>

                <i class="btn btn-success mb-2" onclick="addStep()" id="addStep">إضافة خطوة<span class="fa fa-code-branch"></span></i>
                <?php $Users = Model\User::All(); ?>
                <script>
                    var counter = 1;

                    function addStep() {
                        const label1 = document.createElement('label');
                        label1.setAttribute('for', "step" + counter);
                        label1.innerHTML = 'عنوان الخطوة:';
                        document.getElementById('Steps').appendChild(label1);
                        const input1 = document.createElement('input');
                        input1.name = 'stepName' + counter;
                        input1.id = 'step' + counter;
                        input1.type = 'text';
                        input1.classList.add('w-25', 'me-2', 'd-inline');
                        document.getElementById('Steps').appendChild(input1);
                        const select = document.createElement('select');
                        select.name = 'stepAssignee' + counter;
                        select.id = 'stepAssignee' + counter;
                        const firstOption = document.createElement('option');
                        firstOption.value = "NULL";
                        select.appendChild(firstOption);
                        const options = <?= json_encode($Users) ?>;
                        options.forEach(User => {
                            const option = document.createElement('option');
                            option.value = User[0];
                            option.innerHTML = User[1] + " " + User[3]
                            select.appendChild(option);
                        });
                        const label2 = document.createElement('label');
                        label2.setAttribute('for', "stepAssignee" + counter);
                        label2.innerHTML = 'عنوان الخطوة:';
                        document.getElementById('Steps').appendChild(label2);
                        document.getElementById('Steps').appendChild(select);
                       // document.getElementById('Steps').appendChild(document.createElement('br/'));

                        counter++;
                    }
                </script>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" name="adds" class="btn btn-primary">إضافة المهمة</button>
                </div>
            </form>
        </div>
    </div>
</div>