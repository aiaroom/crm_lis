<?php
if(!isset($_GET["id"])) exit;
include_once("pro.php");
include_once("db_connect.php");

$query = "UPDATE `tasks` SET `is_del`=true WHERE `id`=".$_GET["id"];
$res_query = mysqli_query($connection,$query);
if(!$res_query) exit("<p>ошибка</p>");

header("Location: pro.php");
exit;