<?php
session_name("tfhgfhgfh");
session_start();
include_once('../config.php');
include_once("../db_connect.php");
$login = $_POST['login'];
$pass = $_POST['password'];
$password = md5($pass);

$user_id_query = "SELECT id FROM `users` WHERE `login` = '$login'";
$user_id = $connection->query($user_id_query);
$fetchid = $user_id->fetch_array();
$id = $fetchid['id'];
mysqli_next_result($connection);
$passcheck = "SELECT `password` FROM `passwords` WHERE user_id = '$id'";
$checkpass = $connection->query($passcheck);
$fetchpass = $checkpass->fetch_array();
$pass = $fetchpass['password'];
$count_num_rows_pass = $checkpass->num_rows;
mysqli_free_result($checkpass);
mysqli_next_result($connection);
  
$log_check = "SELECT `login` FROM `users` WHERE id = '$id'";
$logresult = $connection->query($log_check);
$count_num_rows_users = $logresult->num_rows;
$fetchid = $logresult->fetch_array();
$log = $fetchid['login'];
if($count_num_rows_users > 0 && $count_num_rows_pass > 0){
    mysqli_free_result($logresult);
    mysqli_next_result($connection);

    if($login == $log && $password == $pass){
        $check_role = "SELECT `role_id` FROM users WHERE id = '$id'";
        $checkrole = $connection->query($check_role);
        $checkrole = $checkrole->fetch_array();
        $role = $checkrole['role_id'];
        $_SESSION["id"] = $id;
        mysqli_free_result($user_id);
        if($role == 1){
          header('Location: http://188.17.157.3/DDPT/Alisa/crm/creater/cr.php');
        }
        elseif($role==2){
          header('Location: http://188.17.157.3/DDPT/Alisa/crm/creater/cr1.php');
        }
      }
    else{
        echo "Ошибка: Неверный логин или пароль!";
      }
}