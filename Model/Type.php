<?php

namespace Model;

class Type extends Table
{

    protected static $tableName = "task_type";
    protected $type_id;
    protected $type_color;
    function getTypeId()
    {
        return $this->type_id;
    }
    protected $type;
    function getTypeName()
    {
        return $this->type;
    }
    public function addType($type, $type_color)
    {
        $this->type = $type;
        $this->type_color = $type_color;
        if (empty($type) || empty($type_color)) {
            return ["error" => "جميع الحقول مطلوبة."];
        }
        $query = "INSERT INTO `task_type` (`type`, `type_color`) VALUES ('$this->type',  '$this->type_color')";

        parent::$connection->query($query);
    }
    function viowtype()
    {
        if (parent::$connection->connect_error) {
            return ["error" => "خطأ في الاتصال: " . parent::$connection->connect_error];
        }

        $select = "SELECT * FROM `task_type`";
        $query = parent::$connection->query($select);

        if ($query === false) {
            return ["error" => "خطأ في الاستعلام: " . parent::$connection->error];
        }

        if ($query->num_rows === 0) {
            return [];
        }

        return $query->fetch_all(MYSQLI_ASSOC);
    }
    function viowid($type_id)

    {
        $this->type_id = $type_id;
        if (parent::$connection->connect_error) {
            return ["error" => "خطأ في الاتصال: " . parent::$connection->connect_error];
        }

        $select = "SELECT `type_id`, `type`, `type_color` FROM `task_type`WHERE `type_id` = $this->type_id ";
        $query = parent::$connection->query($select);

        if ($query === false) {
            return ["error" => "خطأ في الاستعلام: " . parent::$connection->error];
        }

        if ($query->num_rows === 0) {
            return [];
        }

        return $query->fetch_all(MYSQLI_ASSOC);
    }
    function edittype($type_id, $type, $type_color)
    {

        $this->type_id = $type_id;
        $this->type = $type;
        $this->type_color = $type_color;

        $updatas = "UPDATE `task_type` SET `type`='$this->type', `type_color`='$this->type_color' WHERE `type_id` = $this->type_id";
        parent::$connection->query($updatas);
        header("../Views/type_viow.php");
        exit();
    }
}


