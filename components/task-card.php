<?php

use Model\Group;
use Model\Priority;
use Model\Task;

include "task-details.php";
function task_card($id,$user_id)
{
    $task = Task::Find($id);
    $priority = is_null($task['priority_id']) ? null : Priority::Find($task['priority_id']);
    $group = is_null($task['group_id']) ? null : Group::Find($task['group_id']);
?>

    <div data-bs-toggle="modal" data-bs-target="#editModal<?= $id ?>" class="task-card m-2 rounded-2 bg-primary-subtle p-3">
        <h3 class="d-inline-block"><?= $task['task_name'] ?><span class="task-priority fs-6 ms-5 rounded-5 p-1 ps-3 pe-3" style="background-color:<?= $priority['priority_color'] ?>;"><?= $priority['priority'] ?></span></h3>
        <h5><?= is_null($group) ? " " : $group['group'] ?></h5>
        <p><?= date("Y/m/d", strtotime($task['due_date'])) ?></p>
        <?php progressLine($task['progress']) ?>
        <div class="text-secondary" style="position: absolute;left:15px;bottom:10px;">
            <?php if (Task::hasComments($id)) { ?>
                <span><?= Task::hasComments($id) . " " ?> </span> <span class="fa fa-comment-dots"></span>
            <?php } ?>
            <?php if (Task::hasSteps($id)) { ?>
                <span><?= Task::hasSteps($id) . " " ?> </span> <span class="fa fa-code-branch"></span>
            <?php } ?>
            <?php if (Task::hasAttachments($id)) { ?>
                <span><?= Task::hasAttachments($id) . " " ?> </span> <span class="fa fa-file"></span>
            <?php } ?>
        </div>
    </div>
    <?php
    task_details($task ,$user_id);
    ?>
<?php }
