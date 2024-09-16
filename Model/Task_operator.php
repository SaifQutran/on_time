<?php

namespace Model;

include("Table.php");

class Task_operator extends Table
{
    protected static $tablename = "task_operators";
    protected  $user_id;
    protected  $task_id;
}
