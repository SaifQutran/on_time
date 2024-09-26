<?php

namespace Model;


class Comment extends Table
{
    protected static $tableName = "comments";

    protected $comment_id;
    protected $comment_body;
    protected $user_id;
    protected $task_id;
}
