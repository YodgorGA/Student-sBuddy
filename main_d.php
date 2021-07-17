<?php
require_once 'connection_bd.php';
require_once 'back_d.php';
global $admin;
$selected_t = 'news';
$admin= new admin;
session_start();
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
    <title>Главная страница</title>
  </head>
  <body>
    <!--Header-->
    <ul class="nav nav-tabs nav-justified">
      <div class="px-4 py-2 "><a class="navbar-brand text-dark" href="main_d.php">Student's Buddy</a></div>
        <li class="nav-item">
            <a class="nav-link  active text-dark" aria-current="page" href="main_d.php">Главная</a>
        </li>
        <li class="nav-item dropdown ">
            <a class="nav-link  active text-dark" aria-current="page" href="rasp_d.php">Расписание</a>
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
    <!-- Новости -->
    <div class='container'>
      <div class='row justify-content-center'>
      <!--Name_Page-->
        <div class='col-2 px-4 py-5'><h1>Новости</h1></div>
      </div>
      <!--1-->
    <div class='row justify-content-center'>
      <div class='col-3'>
      <table class='table table-striped'>
      <?php 
      $admin->show_news_main($conn,$selected_t,'1');
      ?>
      </table>
      </div>
      <!--2-->
      <div class='col-3'>
      <table class='table table-striped'>
      <?php 
      $admin->show_news_main($conn,$selected_t,'2');
      ?>
      </table>
      </div>
      <!--3-->
      <div class='col-3'>
      <table class='table table-striped'>
      <?php 
      $admin->show_news_main($conn,$selected_t,'3');
      ?>
      </table>
      </div>
      <!--4-->
      <div class='col-3'>
      <table class='table table-striped'>
      <?php 
      $admin->show_news_main($conn,$selected_t,'4');
      ?>
      </table>
      </div>
    </div>
    </div>
    <!--Картиночка-->
    <div class='container'>
      <div class='row'>
        <div class='col py-5'><img src="images/main_n1.png" class="img-fluid" alt="Responsive image"></div>
        <div class='col py-5'><img src="images/main_n2.png" class="img-fluid" alt="Responsive image"></div>
        <div class='col py-5'><img src="images/main_n3.png" class="img-fluid" alt="Responsive image"></div>
      </div>
    
    
    
    </div>
    <!--Footer-->
    <div class="container-fluid fixed-bottom">
        <div class="row border justify-content-center " >
          <div class="col-3 ">
            <p class='text-center w-100 '><br><a href="https://ppk.sstu.ru/">Наш сайт</a></p>
          </div>
          <div class="col-3">
            <p class='text-center w-100 '><br>Student's buddy 2021</p>
          </div>
          <div class="col-3">
            <p class='text-center w-100 '><br><a href="https://vk.com/club112200375">Наша группа в ВК</a></p>
          </div>

        </div>
    </div>
    <!-- Вариант 1: Bootstrap в связке с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>