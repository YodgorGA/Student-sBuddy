<?php
require_once 'connection_bd.php';
require_once 'back_d.php';
session_start();
global $admin;
$admin = new admin;
$_SESSION['loggined_user'] ='';
$_SESSION['is_loggined'] ='';
$_SESSION['is_admin']='';
?>

<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href='/diplom/css2/style.css' rel="stylesheet">
    <title>Авторизация</title>
  </head>
  <body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</br>
    <div class='container'>
            <div class='row justify-content-center'>
                <div class='col-3'>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="registration_d.php">Регистрация</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Авторизация </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container px-4">
            <div class="row  justify-content-center ">
                    <div class="col-1 px-md-4">
                        <div class="p-1">Логин</div>
                    </div>
                    <div class="col-3 px-md-4">
                        <div class="p-1 ">
                            <form method='post'><input type='text' class='form-control-sm' name='auth_user_login'/>
                        </div>
                    </div>
            </div>
            <div class="row  justify-content-center ">
                    <div class="col-1 px-md-4 ">
                        <div class="p-1">Пароль</div>
                    </div>
                    <div class="col-3 px-md-4">
                        <div class="p-1 ">
                            <input type='password' class='form-control-sm' name='auth_user_pass'/>
                        </div>
                    </div>
            </div>
        <div class="container ">
            <div class="row  py-2 justify-content-center">
                <div class = "col-3 px-md-4">
                    <input type="submit" class="btn btn-dark w-100 " name='auth_user_butt' value='Войти'></form>
                    </div>
                        <div class = "col-1 px-md-4">
                    </div>
            </div>  
        </div>
        </br>
            <div class = 'container '>
                    <div class='row justify-content-center'>
                        <div class='col-3 px-md-4'>
                            <a>
                                <p class="text-center">
                                <?php 
                                    if (isset($_POST['auth_user_butt']))
                                    {
                                        $login = $_POST['auth_user_login'];
                                        $password = $_POST['auth_user_pass'];
                                        $_SESSION['user_login'] = $login;
                                        $_SESSION['user_password'] = $password;
                                        if($login == 'qwertyuiop' && $password == 'qwertyuiop')
                                        {
                                            $_SESSION['is_admin']= true;
                                        }
                                        $users = new users;
                                        $users ->auth($conn,$login,$password);
                                        $_SESSION['loggined_user'] = $login;
                                        $_SESSION['is_loggined'] = true;
                                        
                                        
                                    }
                                ?>
                                </p>
                            </a>
                        </div>
                    <div class = "col-1 px-md-4"></div>
                </div>
            </div>
    </div>
  </body>
</html>