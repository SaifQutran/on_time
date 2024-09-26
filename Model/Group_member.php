<?php

namespace Model;

class Group_member extends Table{
    
    protected static $tablename = "group_members";
    protected $user_id;
    protected $group_id;
    function group_member($user_id)
    {

        $this->user_id  = $user_id;
        $selected = "SELECT * FROM groups_ ORDER BY group_id DESC LIMIT 1";
        $last_value = parent::$connection->query($selected);
        if ($last_value->num_rows > 0) {
            $row = $last_value->fetch_assoc();
            $this->group_id = $row["group_id"];
        } else {
            echo null;
        }

        foreach ($this->user_id as $user_idd) {
            $sql = "INSERT INTO `group_members`(`group_id`, `user_id`) VALUES ('$this->group_id','$user_idd')";

            parent::$connection->query($sql);
        }


}}