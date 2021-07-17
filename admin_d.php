<?php
require_once 'connection_bd.php';
require_once 'back_d.php';
session_start();
global $admin;
$admin = new admin;
$mark_date='';
/*Выбор таблицы*/
$selected_t = 'news';
$admin = new admin; 
?>
<!doctype html>
<html lang="ru">
  <head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="scripts/user_show.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Управление</title>
  <body>
    <!--Header-->
    <ul class="nav nav-tabs nav-justified">
      <div class="px-4 py-2 "><a class="navbar-brand text-dark" href="main_d.php">Student's Buddy</a></div>
        <li class="nav-item">
            <a class="nav-link  active text-dark" aria-current="page" href="admin_d.php">Управление</a>
        </li>
        <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle text-dark active" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Журнал</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="l_TRPO_d.php">Технология разработки ПО</a></li>
              <li><a class="dropdown-item" href="l_ISRPO_d.php">Инструментальные средства разработки ПО</a></li>
              <li><a class="dropdown-item" href="l_INO_d.php">Иностранный язык</a></li>
              <li><a class="dropdown-item" href="l_FIZRA_d.php">Физическая культура</a></li>
              <li><a class="dropdown-item" href="l_PPP_d.php">Пакеты прикладных программ</a></li>
              <li><a class="dropdown-item" href="l_MM_d.php">Математические методы</a></li>
              <li><a class="dropdown-item" href="l_DS_d.php">Документация и сертификация</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
          <button class="btn btn-white text-dark nav-link dropdown-toggle border w-100" data-bs-toggle="dropdown" role="button" aria-expanded="false">
            <?php 
            $_SESSION['is_loggined'] = false;
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
    <!--Вывод названия-->
    <div class="container" >
      <div class='row '>
          <div class='col-2 py-5'><h2>Новости</h2></div>
      </div>
    </div>
    <!--Вывод рабочей панели-->
    <div class='container'>
    <div class="col-12">
      <div class="row justify-content-center">
        
        <div class='col-3'>
        <table class='table border'>
        <?php 
          $admin->show_news_admin($conn,$selected_t,'1');
        ?>
        </table>
          <button class="btn btn-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#New_1" aria-expanded="false" aria-controls="collapseExample">
          Редактировать
          </button>
          <div class="collapse" id="New_1">
          <div class="card card-body">
            <form method='post'>  
                  <div class="col"><input type='text' class='form control w-100' name='news_title1' placeholder="Название новости"></div>
                  <div class="col"><textarea maxlength="150" type='text' class='form control w-100' name='news_content1' placeholder="Содержание новости"></textarea></div>
                  <div class="col"><input type='submit' class='btn btn-dark w-100' name='edit_new1' value="Обновить"></div>
            </form>
          </div>
        </div>
        <?php 
        if(isset($_POST['edit_new1']))
        {
          $nt1=$_POST['news_title1'];
          $nc1=$_POST['news_content1'];
          $post_index = '1';
          $admin->edit_news($conn,$selected_t,$nt1,$nc1,$post_index);
        }
        ?>
    </div>
    <div class='col-3'>
    <table class='table border'>
      <?php   
          $admin->show_news_admin($conn,$selected_t,'2');
        ?>
    </table>
          <button class="btn btn-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#New_2" aria-expanded="false" aria-controls="collapseExample">
          Редактировать
          </button>
          <div class="collapse" id="New_2">
          <div class="card card-body">
            <form method='post'>  
                  <div class="col"><input type='text' class='form control w-100' name='news_title2' placeholder="Название новости"></div>
                  <div class="col"><textarea maxlength="150" type='text' class='form control w-100' name='news_content2' placeholder="Содержание новости"></textarea></div>
                  <div class="col"><input type='submit' class='btn btn-dark w-100' name='edit_new2' value="Обновить"></div>
            </form>
          </div>
        </div>
        <?php 
        if(isset($_POST['edit_new2']))
        {
          $nt2=$_POST['news_title2'];
          $nc2=$_POST['news_content2'];
          $post_index = '2';
          $admin->edit_news($conn,$selected_t,$nt2,$nc2,$post_index);
        }
        ?>
    </div>
    <div class='col-3'>
    <table class='table border'>
    <?php 
          $admin->show_news_admin($conn,$selected_t,'3');
        ?>
    </table>
          <button class="btn btn-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#New_3" aria-expanded="false" aria-controls="collapseExample">
          Редактировать
          </button>
          <div class="collapse" id="New_3">
          <div class="card card-body">
            <form method='post'>  
                  <div class="col"><input type='text' class='form control w-100' name='news_title3' placeholder="Название новости"></div>
                  <div class="col"><textarea maxlength="150" type='text' class='form control w-100' name='news_content3' placeholder="Содержание новости"></textarea></div>
                  <div class="col"><input type='submit' class='btn btn-dark w-100' name='edit_new3' value="Обновить"></div>
            </form>
          </div>
        </div>
        <?php 
        if(isset($_POST['edit_new3']))
        {
          $nt3=$_POST['news_title3'];
          $nc3=$_POST['news_content3'];
          $post_index = '3';
          $admin->edit_news($conn,$selected_t,$nt3,$nc3,$post_index);
        }
        ?>
    </div>
    <div class='col-3'>
    <table class='table border'>
    <?php 
          $admin->show_news_admin($conn,$selected_t,'4');
        ?>
    </table>
          <button class="btn btn-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#New_4" aria-expanded="false" aria-controls="collapseExample">
          Редактировать
          </button>
          <div class="collapse" id="New_4">
          <div class="card card-body">
            <form method='post'>  
                  <div class="col"><input type='text' class='form control w-100' name='news_title4' placeholder="Название новости"></div>
                  <div class="col"><textarea maxlength="150" type='text' class='form control w-100' name='news_content4' placeholder="Содержание новости"></textarea></div>
                  <div class="col"><input type='submit' class='btn btn-dark w-100' name='edit_new4' value="Обновить"></div>
            </form>
          </div>
        </div>
        <?php 
        if(isset($_POST['edit_new4']))
        {
          $nt4=$_POST['news_title4'];
          $nc4=$_POST['news_content4'];
          $post_index = '4';
          $admin->edit_news($conn,$selected_t,$nt4,$nc4,$post_index);
        }
        ?>
    </div>
  </div>
  <!--Расписание-->
  <div class='container'>
      <div class='row'>
          <div class='col-2 py-5'><h2>Расписание</h2></div>
      </div>
      <div class='row justify-content-center'>
          <div class='col-12'>
            <div class='text-center'>
            <?php 
              if(isset($_POST['sent_new_photo']))
              {
                $new_photo = $_POST['uploaded_photo'];
                $_SESSION['new_photo'] = $new_photo;
                $selected_t = 'images';
                $admin->edit_rasp($conn,$selected_t,$new_photo);
                echo '<img src="images/'.$_SESSION['new_photo'].'" alt="rasp" />';
              }
            ?>   
            </div>
          </div>
      </div>
  </div>
  <!--Загрузка изображений-->
  <div class='cointainer'>
        <div class='row py-3 justify-content-center'>
          <div class='col-4'>
            <form method='post' class='form'>
            <div class="form-group">
            <input type="file" name='uploaded_photo' class="form-control" id="exampleFormControlFile1" >
            <input type='submit' name='sent_new_photo' class='form-control' value='Загрузить'>
            </form>
            </div>
          </div>
        </div>
  </div>
    </div>
  <!--Изменение замен-->
  <div class='container'>
    <div class="col-12">
    <div class="row justify-content-center">
        <!--1REP-->
        <div class='col-3'>
        <table class='table border'>
        <?php
          $selected_t ='reps';
          $admin->show_replacements($conn,$selected_t,'1');
        ?>
        </table>
        <form method='post'>
        <input type='text' class='form-control' name='rep_date1' placeholder="Дата замены">
        <textarea type='text' class='form-control' name='rep_content1' placeholder="Содержание изменения"></textarea> 
        <input type='submit' class='btn btn-dark w-100' name="upd_rep1" value='Обновить'>
        </form>
        <?php
        if(isset($_POST['upd_rep1']))
        {
          $selected_t='reps';
          $rep_date = $_POST['rep_date1'];
          $rep_content = $_POST['rep_content1'];
          $rep_id = '1';
          $admin->upd_replacements($conn,$selected_t,$rep_date,$rep_content,$rep_id);
        }
        ?>
        </div>
        <!--2REP-->
        <div class='col-3'>
        <table class='table border'>
        <?php
          $selected_t ='reps';
          $admin->show_replacements($conn,$selected_t,'2');
        ?>
        </table>
        <form method='post'>
        <input type='text' class='form-control' name='rep_date2' placeholder="Дата замены">
        <textarea type='text' class='form-control' name='rep_content2' placeholder="Содержание изменения"></textarea> 
        <input type='submit' class='btn btn-dark w-100' name="upd_rep2" value='Обновить'>
        </form>
        <?php
        if(isset($_POST['upd_rep2']))
        {
          $selected_t='reps';
          $rep_date = $_POST['rep_date2'];
          $rep_content = $_POST['rep_content2'];
          $rep_id = '2';
          $admin->upd_replacements($conn,$selected_t,$rep_date,$rep_content,$rep_id);
        }
        
        ?>
        </div>
        <!--3REP-->
        <div class='col-3'>
        <table class='table border'>
        <?php
          $admin->show_replacements($conn,$selected_t,'3');
        ?>
        </table>
        <form method='post'>
        <input type='text' class='form-control' name='rep_date3' placeholder="Дата замены">
        <textarea type='text' class='form-control' name='rep_content3' placeholder="Содержание изменения"></textarea> 
        <input type='submit' class='btn btn-dark w-100' name="upd_rep3" value='Обновить'>
        </form>
        <?php
        if(isset($_POST['upd_rep3']))
        {
          $selected_t ='reps';
          $rep_date = $_POST['rep_date3'];
          $rep_content = $_POST['rep_content3'];
          $rep_id = '3';
          $admin->upd_replacements($conn,$selected_t,$rep_date,$rep_content,$rep_id);
          
        }
        
        ?>
        </div>
    </div>
  </div>

    <!-- Вариант 1: Bootstrap в связке с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>