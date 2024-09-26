<?php

namespace Model;

include_once("../Model/Table.php");
Table::setConn();

class Employees extends Table
{
    protected static $tableName = "users";

    protected $insert;

    function show()
    {
        if (parent::$connection->connect_error) {
            echo "no";
        } else {
            echo "conect";
        }
        $this->insert = "SELECT * FROM `users` WHERE is_manager = 0";

        $query = parent::$connection->query($this->insert);

        while ($fetch = mysqli_fetch_object($query)) {
            echo "<option value='" . $fetch->user_id . "'>" . $fetch->first_name . "</option>";
        }
    }
    function shows()
    {
        if (parent::$connection->connect_error) {
            echo "no";
        } else {
            echo "conect";
        }
        $this->insert = "SELECT * FROM `users` WHERE is_manager = 0";

        $query = parent::$connection->query($this->insert);

        while ($fetch = mysqli_fetch_object($query)) {
            echo "<option value='" . $fetch->user_id . "'>" . $fetch->first_name . " " . $fetch->middle_name . " " . $fetch->last_name . "</option>";
        }
    }
}
