<?php

namespace Model;

include("Table.php");

class Group_member extends Table{
    
    protected static $tablename = "group_members";
    protected $user_id;
    protected $group_id;



}