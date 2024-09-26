<?php

include "head.php";
include "../Model/Table.php";
include "../Model/Status.php";
include "../Model/Task.php";
include "../Model/User.php";
include "../Model/Priority.php";
include "../Model/Group.php";
include "../Model/Type.php";
include "../Model/Comment.php";
include "../Model/Task_operator.php";
include "../Model/Step.php";
function task_details($task, $id)
{


?>
    <div class="modal fade" id="editModal<?= $task['task_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $task['task_id'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title fs-2" id="exampleModalLabel<?= $task['task_id'] ?>">معلومات المهمة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="<?= Model\Comment::CountWhere('task_id', $task['task_id']) > 0 ? "display: grid;grid-template-columns: 50% 50%;" : "" ?>">
                    <?php
                    $task_name = "";
                    $task_description = "";
                    $assigner = "";
                    $due_date = "";
                    $task_hours = "";
                    $group_id = "";
                    $task_type = "";
                    $user_id = "";
                    Model\Table::setConn();
                    $counter = 0;
                    if (isset($_POST["edit"])) {
                        $task_name = $_POST["task_name"];
                        $task_description = $_POST["task_description"];
                        $due_date = $_POST["due_date"];
                        $task_hours = $_POST["task_hours"];
                        $group_id = $_POST["group_id"];
                        $task_type = $_POST["task_type"];
                        $user_id = $_POST["user_id"];
                        $steps = [];
                        foreach ($_POST as $key => $value) {
                            if (strpos($key, "step") !== false) {
                                $steps[] = $value;
                            }
                        }

                        foreach ($_POST as $key => $value) {
                            if (strpos($key, "employee_names") !== false) {
                                $assigneees_id = $value;
                            }
                        }

                        Model\Task_operator::addTaskOps($task['task_id'], $assigneees_id);
                        // $add = new Model\Step();
                        //$add->add_step($steps, $user_id);

                    } else {
                    }
                    ?>

                    <form action="" method="POST">
                        <label for="task_name">اسم المهمة:</label>
                        <input type="text" id="task_name" name="task_name" id="task_name" value="<?= $task['task_name'] ?>" required />

                        <label for="task_description">وصف المهمة:</label>
                        <textarea

                            id="task_description"
                            name="task_description"
                            rows="4"><?= $task['task_description'] ?></textarea>


                        <label for="due_date">تاريخ التسليم :</label>
                        <input value="<?= date("Y-m-d", strToTime($task['due_date'])) ?>" class="d-inline w-25" type="date" id="due_date" name="due_date" required />
                        <label for="task_hours"> عدد الساعات :</label>
                        <input value="<?= $task['task_hours'] ?>" class="w-25 d-inline" type="number" id="task_hours" name="task_hours">
                        <br>

                        <label for="group">اسم المجموعة:</label>

                        <select name="group" id="group">
                            <?php
                            $selected  = $task['group_id'];

                            $Groups = Model\Group::All();
                            foreach ($Groups as $Group) {
                                if ($selected == $Group[0]) {
                            ?>
                                    <option selected value="<?= $Group[0] ?>"><?= $Group[1] ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?= $Group[0] ?>"><?= $Group[1] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <label for="priotrity"> اهمية المهمة:</label>
                        <select name="priotrity" id="priotrity">
                            <?php
                            $selected  = $task['priority_id'];

                            $Prioritys = Model\Priority::All();
                            foreach ($Prioritys as $Priority) {
                                if ($selected == $Priority[0]) {
                            ?>
                                    <option selected value="<?= $Priority[0] ?>"><?= $Priority[1] ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?= $Priority[0] ?>"><?= $Priority[1] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <label for="type"> نوع المهمة:</label>
                        <select name="type" id="type">
                            <?php
                            $selected  = $task['type_id'];

                            $Types = Model\Type::All();
                            foreach ($Types as $Type) {
                                if ($selected == $Type[0]) {
                            ?>
                                    <option selected value="<?= $Type[0] ?>"><?= $Type[1] ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?= $Type[0] ?>"><?= $Type[1] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <div id="editSteps"></div>

                        <i class="btn btn-success mb-2" onclick="editStep()" id="editStep">إضافة خطوة<span class="fa fa-code-branch"></span></i>
                        <?php $Users = Model\User::All(); ?>
                        <script>
                            var editCounter = 1;

                            function editStep() {
                                console.log("Test");
                                const editlabel1 = document.createElement('label');
                                editlabel1.setAttribute('for', "editStep" + editCounter);
                                editlabel1.innerHTML = 'عنوان الخطوة:';
                                document.getElementById('editSteps').appendChild(editlabel1);
                                const editinput1 = document.createElement('input');
                                editinput1.name = 'editStepName' + editCounter;
                                editinput1.id = 'editStep' + editCounter;
                                editinput1.type = 'text';
                                editinput1.classList.add('w-25', 'me-2', 'd-inline');
                                document.getElementById('editSteps').appendChild(editinput1);
                                const editselect = document.createElement('select');
                                editselect.name = 'editStepAssignee' + editCounter;
                                editselect.id = 'editStepAssignee' + editCounter;
                                const editfirstOption = document.createElement('option');
                                editfirstOption.value = "NULL";
                                editselect.appendChild(editfirstOption);
                                const editoptions = <?= json_encode($Users) ?>;
                                editoptions.forEach(User => {
                                    const editoption = document.createElement('option');
                                    editoption.value = User[0];
                                    editoption.innerHTML = User[1] + " " + User[3]
                                    editselect.appendChild(editoption);
                                });
                                const editlabel2 = document.createElement('label');
                                editlabel2.setAttribute('for', "editStepAssignee" + editCounter);
                                editlabel2.innerHTML = 'عنوان الخطوة:';
                                document.getElementById('editSteps').appendChild(editlabel2);
                                document.getElementById('editSteps').appendChild(editselect);
                                editCounter++;
                                console.log("Test");
                            }
                        </script>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                            <button type="button" name="edit" class="btn btn-primary">حفظ التغييرات</button>
                        </div>
                    </form>
                    <?php
                    if (Model\Comment::CountWhere('task_id', $task['task_id']) > 0) { ?>
                        <div class="comments-section m-2">
                            <p class="display-5 text-dark">التعليقات</p>
                            <?php
                            $Comments = Model\Comment::findColumn('task_id', $task['task_id']);
                            foreach ($Comments as $Comment) {
                                $Commenter = Model\User::Find($Comment['user_id']);
                            ?>
                                <div style="height:90px;" class="m-3 d-flex">
                                    <div class="me-1">
                                        <img src="<?= $Commenter['user_photo'] ?>" style="width:55px" alt="" class="d-inline rounded-circle">
                                        <p style="width:fit-content" class="fs-6 fw-semibold"><?= $Commenter['first_name'] . " " . $Commenter['last_name'] ?> </p>
                                    </div>
                                    <div style="width:85%" class="p-3 bg-secondary rounded-5">
                                        <p class="text-light"> <?= $Comment['comment_body'] ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php  } ?>
                </div>
            </div>
        </div>
    </div>
<?php }
