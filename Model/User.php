<?php

namespace Model;

class User extends Table
{
    protected static $tableName = "users";
    protected $user_id;
    protected $first_name;
    public function getFirstName()
    {
        return $this->first_name;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function getMiddleName()
    {
        return $this->middle_name;
    }
    public function getLastName()
    {
        return $this->last_name;
    }
    public function isManager()
    {
        return $this->is_manager;
    }
    protected $middle_name;
    protected $last_name;
    protected $title;
    protected $email;
    protected $phone;
    protected $user_photo;
    function getImg(){
        return $this->user_photo;
    }
    function getTitle(){
        return $this->title;
    }
    protected $password;
    protected bool $is_manager = false;

    protected $insert;

    function __construct($data)
    {
        $this->user_id  = $data['user_id'];
        $this->first_name  = $data['first_name'];
        $this->middle_name = $data['middle_name'];
        $this->last_name   = $data['last_name'];
        $this->user_photo  = $data['user_photo'];
        $this->title       = $data['title'];
        $this->email       = $data['email'];
        $this->phone       = $data['phone'];
        $this->password    = $data['password'];
        $this->is_manager  = $data['is_manager'];
    }
    static function
    add_user($first_name, $middle_name, $last_name, $user_photo, $title, $email, $phone, $password, $is_manager, $token)
    {
        
        if (parent::$connection->connect_error) {
            echo "no";
        } else {
            echo "conect";
        }
        $sql = "INSERT INTO `users`(`first_name`, `middle_name`, `last_name`, `user_photo`, `title`, `email`, `phone`, `password`, `is_manager` ,`token`) VALUES ('$first_name','$middle_name','$last_name','$user_photo','$title','$email','$phone','$password','$is_manager','$token')";

        if (parent::$connection->query($sql)) {
            echo "new users";
        } else {
            echo "dont";
        }
    }

    function edituser($user_id, $first_name, $middle_name, $last_name, $user_photo, $title, $email, $phone, $password, $is_manager)
    {
        $this->user_id     =  $user_id;
        $this->first_name  = $first_name;
        $this->middle_name = $middle_name;
        $this->last_name   = $last_name;
        $this->user_photo  = $user_photo;
        $this->title       = $title;
        $this->email       = $email;
        $this->phone       = $phone;
        $this->password    = $password;
        $this->is_manager  = $is_manager;

        $updatas = "UPDATE `users` SET `user_id`='$this->user_id',`first_name`='$this->first_name ',`middle_name`='$this->middle_name ',`last_name`='$this->last_name ',`user_photo`='$this->user_photo',`title`='$this->title',`email`='$this->email ',`phone`='$this->phone',`password`='$this->password',`is_manager`='$this->is_manager' WHERE `user_id` = $this->user_id";
        parent::$connection->query($updatas);
        header("Location: ../Views/viowusers.php");
        exit();
    }
}
