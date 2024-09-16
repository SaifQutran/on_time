<?php

use Model\Table;

include "../Model/User.php";

$first_name = "";
$middle_name = "";
$last_name = "";
$title = "";
$email = "";
$phone = "";
$password = "";
$is_manager = false;
Table::setConn();
if (isset($_POST['send'])) {


    $first_name = $_POST['first_name'];

    $middle_name  = $_POST['middle_name'];
    
    $last_name = $_POST['last_name'];

    $title = $_POST['title'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $is_manager = isset($_POST['is_manager']);
    $add = new Model\User();
    $add->add_user($first_name, $middle_name, $last_name, $title, $email, $phone, $password, $is_manager);
    header("Location: http://localhost/on_time/Views/add_user.php");
} else {
    echo "Not set";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information Form</title>
</head>

<body>
    <form action="" method="post">
        <label for="first_name">First Name</label>
        <input name="first_name" type="text" required />
        <br />
        <label for="middle_name">Middle Name</label>
        <input name="middle_name" type="text" required />
        <br />
        <label for="last_name">Last Name</label>
        <input name="last_name" type="text" required />
        <br />
        <label for="title">Title</label>
        <input name="title" type="text" required />
        <br />
        <label for="email">Email</label>
        <input name="email" type="email" required />
        <br />
        <label for="phone">Phone</label>
        <input name="phone" type="tel" />
        <br />
        <label for="password">Password</label>
        <input name="password" type="password" required />
        <br />
        <label for="is_manager">Is Manager</label>
        <input name="is_manager" type="checkbox" value="1" />
        <br />
        <input name="send" type="submit" />
    </form>
</body>

</html>