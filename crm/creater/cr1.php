<?php
include_once('../config.php');
include_once("../db_connect.php");

if(session_status() == PHP_SESSION_NONE){
  @session_name("tfhgfhgfh");
  @session_start();
}
$data = $_POST;
$id = $_SESSION["id"];
$bd = "SELECT * FROM users WHERE id = $id";
    $bd = $connection->query($bd);
    $bd = $bd->fetch_array();
    $name = $bd['f_name'];
    $last_name = $bd['s_name'];
    $email = $bd['email'];
    $fio = $name.' '.$last_name;

#запрос на формирование выпадающего списка
$query = "SELECT CONCAT(clients.f_name, clients.s_name) AS fio FROM clients";
$res_query = $connection->query($query);
$arr= array();
$rows = mysqli_num_rows($res_query);

for ($i=0; $i < $rows; $i++) { 
    $row = $res_query->fetch_array();
    $row = $row['fio'];
    array_push($arr, $row);
}
#добавление проекта
if(isset($data['add_project'])) {
  $projename = $_POST['name'];
  $desc = $_POST['description'];
  $select_cli = $_POST['user_profile_color_1'];

  
  $add_course2 = " SELECT id FROM clients WHERE CONCAT(clients.f_name, clients.s_name) = '$select_cli'";
  $ac2 = $connection->query($add_course2);
  $selected_cli = $ac2->fetch_array();
  $selected_cli = $selected_cli['id'];
  $cli = $selected_cli;
  $add_course = "INSERT INTO `projects`(`name`, `descr`, `user_id`,`cli_id`) VALUES ('$projename','$desc', '$id', '$cli')";
  $res_query = $connection->query($add_course);
  mysqli_free_result($ac2);
  mysqli_next_result($connection);

}

#формирование списка курсов
$pro_list = "SELECT id,name FROM projects";
$pro_list = $connection->query($pro_list);
$pro= array();
$rows = mysqli_num_rows($pro_list);

for ($i=0; $i < $rows; $i++) { 
    $row = $pro_list->fetch_array();
    $ra = array(
      "name" => $row['name'],
      "id" => $row['id'],
    );
    // $row1 = $row['name'];
    array_push($pro, $ra);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITLis</title>
    <link rel="stylesheet" href="cr.css">
    <!-- <script src="login.js"></script> -->
</head>
<body> 
    <div class="page">
      <div class="nav">
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
    <div class="project_cr">
    <div class="pro"><?php foreach ($pro as $p) {echo "<div class='content_t'><a href='pro1.php?id=".$p['id']."'><p>".$p['name']."</p></a></div>";} ?> </div>
    
                 
</body> 
</html>