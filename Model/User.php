<?php
namespace Model;
include("../Model/Table.php");
class User extends Table
{
    protected static $tableName = "users";
    protected $user_id;
    protected $first_name;
    protected $middle_name;
    protected $last_name;
    protected $title;
    protected $email;
    protected $phone;
    protected $password;
    protected bool $is_manager = false;

    protected $insert ;
   
    function __construct($data){
        $this->first_name  = $data['first_name'];
        $this->middle_name = $data['middle_name'];
        $this->last_name   = $data['last_name'];
        $this->title       = $data['title'];
        $this->email       = $data['email'];
        $this->phone       = $data['phone'];
        $this->password    = $data['password'];
        $this->is_manager  = $data['is_manager'];         
    }
    function add_user($first_name,$middle_name,$last_name,$title,$email,$phone,$password,$is_manager){
        $this->first_name  = $first_name;
        $this->middle_name = $middle_name;
        $this->last_name   = $last_name;
        $this->title       = $title;
        $this->email       = $email;
        $this->phone       = $phone;
        $this->password    = $password;
        $this->is_manager  = $is_manager;
        
        if (parent::$connection->connect_error) {
            echo "no";
        } else {
            echo "conect";
        }
       $sql ="INSERT INTO `users` (`first_name`, `middle_name`, `last_name`, `title`, `email`, `phone`, `password`, `is_manager`) VALUES ('$first_name','$middle_name', '$last_name', '$title','$email' ,'$phone','$password', '$is_manager')";
       
        if(parent::$connection->query($sql)){
            echo "new users";

        }else {
            echo "dont";
        }
    }
        
    }

 



