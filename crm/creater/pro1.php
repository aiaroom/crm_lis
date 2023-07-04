<?php
error_reporting(0);
include_once('../config.php');
include_once("../db_connect.php");

if(session_status() == PHP_SESSION_NONE){
  @session_name("tfhgfhgfh");
  @session_start();
}
$data = $_POST;

$id1 = $_GET["id"];
$id_pro = "SELECT `name` FROM `projects` WHERE `id`= $id1";
$id_pro = $connection->query($id_pro);
$id_pro = $id_pro->fetch_array();
$id_pro1 = $id_pro['name'];

$id = $_SESSION["id"];
$bd = "SELECT * FROM users WHERE id = $id";
    $bd = $connection->query($bd);
    $bd = $bd->fetch_array();
    $name = $bd['f_name'];
    $last_name = $bd['s_name'];
    $email = $bd['email'];
    $fio = $name.' '.$last_name;

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITLis</title>
    <link rel="stylesheet" href="pro.css">
    <!-- <script src="login.js"></script> -->
</head>
<body> 
    <div class="page">
      <div class="nav">
      <div class="id_pr"><?php echo $id_pro1;?></div>
        <div class="logo"><h1>ITLis</h1></div>
            <div class="nav_list">
                <button type= "button" class="btn"><a href="cr.php" class="hr">Проекты</a>
                </button>
                <button type= "button" class="btn"><a href="cli.html" class="hr">Клиенты</a>
                </button>
            </div>
          <div class="username"><?php echo $fio;?></div>
        <button type= "exit" class="exit"></button>
      </div>
    </div>
    
      
    <div class="conteiner">
        <div class="elem">
        <div><p>Предстоящие</p></div>
        <?php $result = $connection->query("SELECT * FROM tasks WHERE status_id=1 AND is_del IS NULL AND project_id=$id1");
    while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
    {
        echo '<div class="sp"><p><span style="font-weight: 900">'.$row['name'].'</span>: '.$row['descr'].' <br> '.$row['date_start'].' - '.$row['date_finish'].' </p> </div>';// выводим данные
    } ?>
        </div>
        <div class="elem">
        <div><p>В процессе</p></div>
        <?php $result = $connection->query("SELECT * FROM tasks WHERE status_id=2 AND is_del IS NULL AND project_id=$id1");
    while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
    {
        echo '<div class="sp"><p><span style="font-weight: 900">'.$row['name'].'</span>: '.$row['descr'].' <br> '.$row['date_start'].' - '.$row['date_finish'].'</p></div>';// выводим данные
    } ?>
        </div>
        <div class="elem">
        <div><p>Завершенные</p></div>
        <?php $result = $connection->query("SELECT * FROM tasks WHERE status_id=3 AND is_del IS NULL AND project_id=$id1");
    while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
    {
        echo '<div class="sp"><p><span style="font-weight: 900">'.$row['name'].'</span>: '.$row['descr'].' <br> '.$row['date_start'].' - '.$row['date_finish'].' </p> </div>';// выводим данные
    } ?>
        </div>
        
    </div>
    
    





    
                 
</body> 
</html>