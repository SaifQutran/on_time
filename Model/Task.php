<?php

namespace Model;

class Task extends Table
{
       protected static $tableName = "tasks";
       protected $task_Id;
       protected $task_name;
       protected $task_description;
       protected $assigner;
       protected $due_date;
       protected $begin_date;
       protected $finish_date;

       protected $group_id;
       protected bool $status;
       protected $assigned_at;
       protected $type_id;
       protected $priority_id;
       protected $task_hours;
       static function addTask($task_name, $task_description, $due_date, $assigner, $group_id, $type_id, $priority_id, $task_hours)
       {
              $sql = "INSERT INTO `tasks`( `assigned_at`,`task_name`, `task_description`,`due_date`, `group_id`,`type_id`,`task_hours`,`priority_id`,`assigner`) VALUES (curdate(),'$task_name','$task_description','$due_date' ,$group_id,$type_id,$task_hours,$priority_id,$assigner)";

              parent::$connection->query($sql);
       }
       static function hasComments($taskId)
       {
              if (count(Comment::findColumn('task_id', $taskId)) > 0) {
                     return count(Comment::findColumn('task_id', $taskId));
              } else {
                     return false;
              }
       }
       static function hasSteps($taskId)
       {
              if (count(Step::findColumn('task_id', $taskId)) > 0) {
                     return count(Step::findColumn('task_id', $taskId));
              } else {
                     return false;
              }
       }
       static function hasAttachments($taskId)
       {
              if (is_dir("../attachments/tasks/$taskId/")) {
                     if (count(scandir("../attachments/tasks/$taskId/")) > 2) {
                            return count(scandir("../attachments/tasks/$taskId/")) - 2;
                     } else {
                            return false;
                     }
              }
       }
       static function getPeriod($column, $from, $to)
       {
              $tableName = static::$tableName;
              $query = "SELECT * FROM $tableName WHERE $column BETWEEN '$from' AND '$to'";
              $result = self::$connection->query($query);
              return $result->fetch_all(MYSQLI_BOTH);
       }
       static function countPeriod($column, $from, $to)
       {
              $tableName = static::$tableName;
              $query = "SELECT count(*) FROM $tableName WHERE $column BETWEEN '$from' AND '$to'";
              $result = self::$connection->query($query);
              $count = $result->fetch_assoc();
              return $count['count(*)'];
       }
}
