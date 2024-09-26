<?php
include "task-card.php";
function kanban($getBy, $id,$user_id)
{
    $tasksGroup = [];
    switch ($getBy) {
        case "group": {
                $tasksGroup = Model\Group::Find($id);
                break;
            }
        case "priority": {
                $tasksGroup = Model\Priority::Find($id);
                break;
            }
        case "status": {
                $tasksGroup = Model\Status::Find($id);
                break;
            }
        case "type": {
                $tasksGroup = Model\Type::Find($id);
                break;
            }
    }
    $tasks = Model\Task::findColumns([$getBy . '_id', 'due_date'], [$id, "2024-10-01"], ['=', '<'],"AND");
    // $kanbanTitle ;
?>
    <div class="m-1 h-100 kanban">
        <div style="border-top: solid 5px <?= $tasksGroup[$getBy . '_color'] ?>" class="kanban-header rounded-2 pt-3 pb-3 ps-3 bg-secondary-subtle">
            <h2> <?= $tasksGroup[$getBy] ?> </h2>
        </div>

        <div class="tasks-container">
            <?php
            foreach ($tasks as $task) {
                task_card($task[0], $user_id);
            }
            ?>

        </div>
    </div>

<?php } ?>