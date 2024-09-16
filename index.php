<?php 
if(!empty($_SESSION['user'])){
    header('Location: Views/dashboard.php');
}else{
    header('Location: Views/login.php');
}