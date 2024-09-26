<?php

namespace Model;

class Priority extends Table
{
    protected static $tableName = "task_priority";
    private $priority_id;
    private $priority;
    private $priority_color;
    function getPriority()
    {
        return $this->priority;
    }
    function getPriorityColor()
    {
        return $this->priority_color;
    }
    function setPriority($task_priority)
    {
        $this->priority = $task_priority;
    }
    function setPriorityColor($priority_color)
    {
        $this->priority_color = $priority_color;
    }

    public function addpriority($priority,  $priority_color)
    {
        $this->priority = $priority;
        $this->priority_color = $priority_color;

        $query = "INSERT INTO `task_priority` (`priority`, `priority_color`) VALUES ('$this->priority',  '$this->priority_color')";

        parent::$connection->query($query);
    }
    function viowpriority()
    {
        if (parent::$connection->connect_error) {
            return ["error" => "خطأ في الاتصال: " . parent::$connection->connect_error];
        }

        $select = "SELECT * FROM `task_priority`";
        $query = parent::$connection->query($select);

        if ($query === false) {
            return ["error" => "خطأ في الاستعلام: " . parent::$connection->error];
        }

        if ($query->num_rows === 0) {
            return [];
        }

        return $query->fetch_all(MYSQLI_ASSOC);
    }
    function viowid($priority_id)

    {
        $this->priority_id = $priority_id;
        if (parent::$connection->connect_error) {
            return ["error" => "خطأ في الاتصال: " . parent::$connection->connect_error];
        }

        $select = "SELECT `priority_id`, `priority`, `priority_color` FROM `task_priority` WHERE priority_id =$this->priority_id ";
        $query = parent::$connection->query($select);

        if ($query === false) {
            return ["error" => "خطأ في الاستعلام: " . parent::$connection->error];
        }

        if ($query->num_rows === 0) {
            return [];
        }

        return $query->fetch_all(MYSQLI_ASSOC);
    }
    function editpriority($priority_id, $priority, $priority_color)
    {

        $this->priority_id = $priority_id;
        $this->priority = $priority;
        $this->priority_color = $priority_color;

        $updatas = "UPDATE `task_priority` SET `priority`='$this->priority', `priority_color`='$this->priority_color' WHERE `priority_id` = $this->priority_id";
        parent::$connection->query($updatas);
        header("Location: ../Views/priority_viow.php");
        exit();
    }
}
