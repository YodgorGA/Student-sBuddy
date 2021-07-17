<?php
require_once 'connection_bd.php';
require_once 'back_d.php';
session_start();
$mark_date='';
/*Выбор таблицы*/
$selected_t = 'ino';
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
    <title>Иностранный язык</title>
  </head>
  <body>
   <!--Header-->
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
    <div class='row justify-content-center'>
        <div class='col-4 px-4 py-5'><h1><?php $admin = new admin; $admin->show_title($selected_t)?></h1></div>
      </div>
    <!--Поиск-->
    <div class='container'>
    <form method='post'>  
    <div class='row py-3 justify-content-center'>
      <div class='col-3'> 
          <input type='text' class='form-control w-100' placeholder='Введите дату' name='mark_date_search'/>
        </div>
        <div class='col-3'>
          <input type='submit' class='btn btn-success w-100'  name='get_date' value='Поиск'/>
        </div>
          </form>
      </div>
    </div>
    <!--Кнопки админки-->
    <div class='container-fluid'>
      <div class='row justify-content-center'>
      <div class='col-2'>
        <button class="btn btn-dark w-100" type="button" data-bs-toggle="collapse" data-bs-target="#new_mark" aria-expanded="false" aria-controls="new_mark">Добавить</button>
      </div>
      <div class='col-2'>
        <button class="btn btn-dark w-100" type="button" data-bs-toggle="collapse" data-bs-target="#drop_mark" aria-expanded="false" aria-controls="drop_mark">Удалить</button>
      </div>
      <div class='col-2'>
        <button class="btn btn-dark w-100" type="button" data-bs-toggle="collapse" data-bs-target="#edit_mark" aria-expanded="false" aria-controls="edit_mark">Изменить</button>
      </div>
      </div>
    </div>
    <div class='container'>
    <!--Таблица-->
    <?php 
    ?>
        <div class='row py-3 justify-content-center'>
          <table class='table border'>
            <thead>
              <tr>
                <th>№</th>
                <th>ФИО студента</th>
                <th>
                  <!--Дата в таблице-->
                  <?php
                    if(isset($_POST['get_date']))
                    {
                      $_SESSION['mark_date_search'] = $_POST['mark_date_search'];
                      echo $_SESSION['mark_date_search'];
                    }
                    
                  ?>
                </th>
              </tr>
            </thead>
            <tbody>
            <tr>
              <!--Отрисовка таблицы-->
                <?php
                $admin = new admin;
                  if (empty($mark_date_search) == true)
                  {
                    $mark_date_search = "1";
                  }            
                  if(isset($_POST['get_date']))
                  {
                    $mark_date_search = $_POST['mark_date_search'];
                  }
                  $admin->show_talbe($conn,$selected_t,$mark_date_search);
                
                ?>
            </tr>
            </tbody>
          </table>
        </div>
    </div>
    <!--Админская панель-->
    <div class="container-fluid fixed-bottom">
        <div class="row border  justify-content-center " >
          <div class="col-3">
            <div class="collapse" id="new_mark">
              <div class="card card-body">
                <form name='add_mark' method='post'>
                  <input class='form-control' type='text' name='id_st_add' placeholder='Номер студента'/>
                  <input class='form-control' type='text' name='mark_date_add' placeholder='Дата занятия'/>
                  <input class='form-control' type='text' name='mark_add' placeholder='Оценка'/>
                  <input class='btn btn-success w-100' type='submit' name='add_butt' value='Добавить'/>
                </form>
                <?php 
                  if(isset($_POST['add_butt']))
                  {
                    $admin = new admin; 
                    $id_st=$_POST['id_st_add'];
                    $mark_date = $_POST['mark_date_add'];
                    $mark=$_POST['mark_add'];
                    $admin->add_mark($conn,$selected_t,$id_st,$mark,$mark_date);
                  }
                ?>
              </div>
            </div>
          </div>
          <div class="col-3">
          <div class="collapse" id="drop_mark">
              <div class="card card-body">
                <form name='drop_mark' method='post'>
                  <input class='form-control' type='text' name='id_st_drop' placeholder='Номер студента'/>
                  <input class='form-control' type='text' name='mark_data_drop' placeholder='Дата занятия'/>
                  <input class='btn btn-success w-100' type='submit' name='drop_butt' value='Удалить'/>
                </form>
                <?php
                if(isset($_POST['drop_butt']))
                { 
                  $id_st = $_POST['id_st_drop'];
                  $mark_data = $_POST['mark_data_drop'];
                  $admin = new admin;
                  $admin->drop_mark($conn,$selected_t,$id_st,$mark_data);
                }
                ?>
              </div>
            </div>
          </div>

          <div class="col-3">
          <div class="collapse" id="edit_mark">
              <div class="card card-body">
                <form name='edit_mark' method='post'>
                  <input class='form-control' type='text' name='id_st_edit' placeholder='Номер студента'/>
                  <input class='form-control' type='text' name='mark_data_edit' placeholder='Дата занятия'/>
                  <input class='form-control' type='text' name='mark_edit' placeholder='Оценка'/>
                  <input class='btn btn-success w-100' type='submit' name='edit_butt' value='Изменить'/>
                </form>
                <?php 
                if(isset($_POST['edit_butt']))
                {
                  $id_st = $_POST['id_st_edit'];
                  $mark_data = $_POST['mark_data_edit'];
                  $value=$_POST['mark_edit'];
                  $admin = new admin;
                  $admin->change_mark($conn,$selected_t,$id_st,$mark_data,$value);
                }
                ?>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- Вариант 1: Bootstrap в связке с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>