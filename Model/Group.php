<?php

namespace Model;

include("Table.php");

class Group extends Table
{

    protected static $tablename = "groups_";
    protected $group_id;
    protected $group_name;
}
