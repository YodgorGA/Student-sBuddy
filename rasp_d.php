<?php
require_once 'connection_bd.php';
require_once 'back_d.php';
session_start();
global $admin;
$admin = new admin;
$selected_t = 'reps';
?>

<!doctype html>
<html lang="ru">
  <head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='css/style.css' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Расписание</title>
  </head>
  <body>
    <!--Header-->
    <ul class="nav nav-tabs nav-justified">
      <div class="px-4 py-2 "><a class="navbar-brand text-dark" href="main_d.php">Student's Buddy</a></div>
        <li class="nav-item">
            <a class="nav-link  text-dark" aria-current="page" href="main_d.php">Главная</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark active " href="rasp_d.php">Расписание</a>
        </li>
        <li class="nav-item dropdown">
          <button class="btn btn-white text-dark nav-link dropdown-toggle border w-100" data-bs-toggle="dropdown" role="button" aria-expanded="false">
            <?php 
            if ($_SESSION['is_loggined'] == true)
            echo $_SESSION['loggined_user'];
            else
            {
              echo 'Войти';
            }
            ?>
          </button>
          <ul class="dropdown-menu"><form method='post'>
            <li><a class="dropdown-item" href='registration_d.php'>Регистрация</a></li>
            <li><a class="dropdown-item" href='authorization_d.php'>Авторизация</a></li>
            <li><a class="dropdown-item"><input type='submit' name='exit' class='btn btn-danger w-100' value='Выход'></a></li>
          </ul></form>
        </li>
    </ul>
    <?php 
        if(isset($_POST['exit']))
        { 
          $_SESSION['is_loggined'] = false;
        }
    ?>
    <!--Фото расписания-->
    <div class='container'>
    <div class='row justify-content-center'>
        <div class='col-2 py-5'><h2>Расписание</h2></div>
    </div>
    <div class='row justify-content-center'>
        <div class='col-12'>
          <div class='text-center'>
          <?php 
          if (empty($_SESSION['new_photo']) == true)
          {
            echo "<h1>Изображение не загружено</h1>";
          }
              echo '<img src="images/'.$_SESSION['new_photo'].'" alt="rasp"/>';
          ?>   
          </div>
        </div>
    </div>
    </div>
    <!--Замены-->
    <div class='container'>
    <div class="col-12">
    <div class="row justify-content-center">
      <div class='text-center py-3'><h3>Замены</h3></div>
        <!--1REP-->
        <div class='col-3'>
        <table class='table border'>
        <?php
          $selected_t ='reps';
          $admin->show_replacements($conn,$selected_t,'1');
        ?>
        </table>
        </div>
        <!--2REP-->
        <div class='col-3'>
        <table class='table border'>
        <?php
          $selected_t ='reps';
          $admin->show_replacements($conn,$selected_t,'2');
        ?>
        </table>
        </div>
        <!--3REP-->
        <div class='col-3'>
        <table class='table border'>
        <?php
          $admin->show_replacements($conn,$selected_t,'3');
        ?>
        </table>
        </div>
    </div>
  </div>
    <!-- Вариант 1: Bootstrap в связке с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>