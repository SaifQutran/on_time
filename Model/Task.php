<?php

namespace Model;

include("Table.php");

class Task extends Table{
    protected static $tablename = "tasks";
    protected $task_Id;
    protected $task_name;
    protected $task_description;
    protected $assigner;
    protected $due_date;
    protected $assigned_at;
    protected $group_id;
    protected bool $status;
 function addtask($task_name,$task_description,$assigner){
    
 }

}
