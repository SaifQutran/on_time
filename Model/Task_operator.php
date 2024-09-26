<?php

namespace Model;

class Task_operator extends Table
{
    protected static $tableName = "task_operators";
    protected  $user_id;
    protected  $task_id;
    protected $insert;

    function task_opreator($user_id)
    {
        $this->user_id = $user_id;
        $selected = "SELECT * FROM tasks ORDER BY task_id DESC LIMIT 1";
        $last_value = parent::$connection->query($selected);
        if ($last_value->num_rows > 0) {
            $row = $last_value->fetch_assoc();
            $this->task_id = $row["task_id"];
            $task_id = $this->task_id;
        } else {
            echo null;
        }
        $task_id;
        if ($task_id != 0 && $user_id != 0) {
            $this->insert = "INSERT INTO `task_operators`(`task_id`, `user_id`) VALUES ('$task_id',' $user_id')";
            parent::$connection->query($this->insert);
        } else {
            echo "is null";
        }
    }
    static function addTaskOps($taskId,array $operators){
        foreach($operators as $operator){
            $sql = "INSERT INTO ".static::$tableName." (`task_id`, `user_id`) VALUES ('$taskId',' $operator')";
            parent::$connection->query($sql);
        }
    }
}
