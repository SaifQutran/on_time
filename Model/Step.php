<?php

namespace Model;

include("Table.php");

class Step extends Table
{
    protected static $tablename = "steps";

    protected $step_id;
    protected $step_name;
    protected $step_description;
    protected $task_id;
    protected $due_date;
    protected $begin_date;
    protected $user_id;
    protected bool $status;
}
