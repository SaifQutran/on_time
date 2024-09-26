<?php


namespace Model;

class Step extends Table
{
    protected static $tableName = "steps";
    protected $step_id;
    protected $step_name;
    protected $task_id;
    protected $assiged_at;
    protected $user_id;
    protected $is_compleated;
    protected $add_step;

    static  function add_step($step_name, $task_Id, $user_id = "NULL")
    {
        $sql = "INSERT INTO `steps`(`step_name`,task_id,`user_id`) VALUES ('$step_name',$task_Id,$user_id)";
        parent::$connection->query($sql);
    }
}
