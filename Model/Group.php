<?php

namespace Model;

class Group extends Table
{

    protected static $tableName = "groups_";
    protected $group_id;
    function getGroupId()
    {
        return $this->group_id;
    }
    protected $group_name;
    function getGroupName()
    {
        return $this->group_name;
    }
    protected $insert;
    function add_group($group_name)
    {
        $this->group_name = $group_name;
        parent::$connection->connect_error;

        $this->insert = "INSERT INTO `groups_`(`group`) VALUES (' $group_name')";

        parent::$connection->query($this->insert);
    }
    function show_group()
    {
        parent::$connection->connect_error;

        $this->insert = "SELECT * FROM `groups_`";

        $query = parent::$connection->query($this->insert);

        while ($fetch = mysqli_fetch_object($query)) {
            echo "<option value='" . $fetch->group_id . "'>" . $fetch->group . "</option>";
        }
    }
    function viowgroup()
    {
        if (parent::$connection->connect_error) {
            return ["error" => "خطأ في الاتصال: " . parent::$connection->connect_error];
        }

        $select = "SELECT * FROM `groups_`";
        $query = parent::$connection->query($select);

        if ($query === false) {
            return ["error" => "خطأ في الاستعلام: " . parent::$connection->error];
        }

        if ($query->num_rows === 0) {
            return [];
        }

        return $query->fetch_all(MYSQLI_ASSOC);
    }
    function viowgroupuser()
    {
        if (parent::$connection->connect_error) {
            return ["error" => "خطأ في الاتصال: " . parent::$connection->connect_error];
        }

        $select = "SELECT g.group_id, g.group, g.group_color, GROUP_CONCAT(u.user_id) AS members FROM groups_ g LEFT JOIN group_members gm ON g.group_id = gm.group_id LEFT JOIN users u ON gm.user_id = u.user_id GROUP BY g.group_id, g.group, g.group_color";
        $query = parent::$connection->query($select);

        if ($query === false) {
            return ["error" => "خطأ في الاستعلام: " . parent::$connection->error];
        }

        if ($query->num_rows === 0) {
            return [];
        }

        return $query->fetch_all(MYSQLI_ASSOC);
    }
    public function getMembersDetailsByGroupId($groupId)
    {
        $select = "
            SELECT 
                u.user_id, 
                CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name) AS full_name, 
                u.user_photo, 
                u.email, 
                u.phone 
            FROM 
                group_members gm 
            JOIN 
                users u ON gm.user_id = u.user_id 
            WHERE 
                gm.group_id = $groupId
        ";
        $query = parent::$connection->query($select);

        if ($query === false) {
            return ["error" => "خطأ في الاستعلام: " . parent::$connection->error];
        }

        if ($query->num_rows === 0) {
            return [];
        }

        return $query->fetch_all(MYSQLI_ASSOC);
    }
}
