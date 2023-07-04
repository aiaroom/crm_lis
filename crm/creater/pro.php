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

#добавление таска
if(isset($data['add_task'])) {
    $taskname = $_POST['name'];
    $desc = $_POST['description'];
    $select_cli = $_POST['user_profile_color_1'];
    $date_s = $_POST['date_s'];
    $date_f = $_POST['date_f'];

    $add_course = "INSERT INTO `tasks`(`name`, `descr`, `project_id`,`date_start`, `date_finish`, `status_id`) VALUES ('$taskname','$desc', $id1, '$date_s', '$date_f', 1 )";
    $res_query = $connection->query($add_course);
    mysqli_free_result($ac2);
    mysqli_next_result($connection);
  
  }
  

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
    <div class="project_cr">
    <button class="create" type="button" value="Создать курс" onclick="openForm()">Создать таск</button>
    </div>
      
    <div class="conteiner">
        <div class="elem">
        <div><p>Предстоящие</p></div>
        <?php $result = $connection->query("SELECT * FROM tasks WHERE status_id=1 AND is_del IS NULL AND project_id=$id1");
    while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
    {
        echo '<div class="sp"><p><span style="font-weight: 900">'.$row['name'].'</span>: '.$row['descr'].' <br> '.$row['date_start'].' - '.$row['date_finish'].' </p> <a href="status.php?id='.$row["id"].'">Изменить статус   </a><a href="rem.php?id='.$row["id"].'">Удалить</a></div>';// выводим данные
    } ?>
        </div>
        <div class="elem">
        <div><p>В процессе</p></div>
        <?php $result = $connection->query("SELECT * FROM tasks WHERE status_id=2 AND is_del IS NULL AND project_id=$id1");
    while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
    {
        echo '<div class="sp"><p><span style="font-weight: 900">'.$row['name'].'</span>: '.$row['descr'].' <br> '.$row['date_start'].' - '.$row['date_finish'].'</p> <a href="status1.php?id='.$row["id"].'">Изменить статус   </a><a href="rem.php?id='.$row["id"].'">Удалить</a></div>';// выводим данные
    } ?>
        </div>
        <div class="elem">
        <div><p>Завершенные</p></div>
        <?php $result = $connection->query("SELECT * FROM tasks WHERE status_id=3 AND is_del IS NULL AND project_id=$id1");
    while($row = $result->fetch_assoc())// получаем все строки в цикле по одной
    {
        echo '<div class="sp"><p><span style="font-weight: 900">'.$row['name'].'</span>: '.$row['descr'].' <br> '.$row['date_start'].' - '.$row['date_finish'].' </p> <a href="status1.php?id='.$row["id"].'">Изменить статус   </a><a href="rem.php?id='.$row["id"].'">Удалить</a></div>';// выводим данные
    } ?>
        </div>
        
    </div>
    
    <div class="form-popup" id="myForm">
            <form action='pro.php?id=<?php echo $id1; ?>'class="form-container" method="post">
              <div class="namediv"><input type="text" placeholder="Название таска" name="name" class="naz" required></div>
              <!-- <select class="choisef" name="user_profile_color_1">
                <option value="" style="display: none; color: #AAA9A9">Проект</option>
                
              </select> -->
              <p>
                <label for="date" style="color:#AAA9A9" class="desc">Дата начала: </label>
                <input type="date" style="margin-left:20px;" id="date" name="date_s"/>
                </p>
                <p>
                <label for="date" style="color:#AAA9A9"  class="desc">Дата финиша: </label>
                <input type="date" style="margin-left:20px;" id="date" name="date_f"/>
                </p>
              <div class="desc">
                <label for="description">Описание таска</label>
                <textarea name="description"></textarea>
            </div>
              <div class="but">      
                <button type="button" class="btn_cancel" onclick="closeForm()">Отмена</button>
                <button type="submit" class="btn" name="add_task">Создать</button>
            </div>
            </form>
        
          </div>
        </div>
          <script>
            function openForm() {
                document.getElementById("myForm").style.display = "block";
            }
            
            function closeForm() {
                document.getElementById("myForm").style.display = "none";
            }
          
          </script>
  </div>






    
                 
</body> 
</html>