<?php 
require_once 'connection_bd.php';
require_once 'back_d.php';
?>

<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href='/diplom/css2/style.css' rel="stylesheet">
    <title>Регистрация</title>
  </head>
  <body>
  
</br>
    <div class='container'>
        <div class='row justify-content-center'>
            <div class='col-3'>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Регистрация</li>
                    <li class="breadcrumb-item"><a href="authorization_d.php">Авторизация</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="row justify-content-center ">
                <div class="col-1 px-md-4">
                    <div class="p-1">ФИО</div>
                </div>
                <div class="col-3 px-md-4">
                    <div class="p-1 ">
                        <form method='post'><input type='text' class='form-control-sm' name='new_user_fio'/>
                    </div>
                </div>
        </div>
        <div class="row justify-content-center ">
                <div class="col-1 px-md-4">
                    <div class="p-1">Почта</div>
                </div>
                <div class="col-3 px-md-4">
                    <div class="p-1 ">
                        <input type='text' class='form-control-sm' name='new_user_email'/>
                    </div>
                </div>
        </div>
        <div class="row justify-content-center">
                <div class="col-1 px-md-4">
                    <div class="p-1">Логин</div>
                </div>
                <div class="col-3 px-md-4">
                    <div class="p-1 ">
                        <input type='text' class='form-control-sm' name='new_user_login'/>
                    </div>
                </div>
        </div>
        <div class="row justify-content-center">
                <div class="col-1 px-md-4 ">
                    <div class="p-1">Пароль</div>
                </div>
                <div class="col-3 px-md-4">
                    <div class="p-1 ">
                        <input type='password' class='form-control-sm' name='new_user_pass'/>
                    </div>
                </div>
        </div>
        <div class="container ">
            <div class="row py-2 justify-content-center">
                <div class = "col-3 px-md-4">
                    <input type="submit"  class="btn btn-dark w-100 " name='new_user_reg_butt' value='Зарегистрироваться'></form>
                </div>
                <div class = "col-1 px-md-4"></div>
            </div>
                <!-- Вывод сообщений о регистрации -->
                </br>
                <div class = 'container '>
                    <div class='row justify-content-center'>
                        <div class='col-3 px-md-4'>
                            <a>
                                <p class="text-center">
                                <?php 
                                    if (isset($_POST['new_user_reg_butt']))
                                    {
                                        $reg_fio = $_POST['new_user_fio'];
                                        $reg_email = $_POST['new_user_email'];
                                        $reg_login = $_POST['new_user_login'];
                                        $reg_password = $_POST['new_user_pass'];
                                        $users = new users;
                                        $users ->reg($conn,$reg_fio,$reg_email,$reg_login,$reg_password);
                                        
                                    }
                                ?>
                                </p>
                            </a>
                        </div>
                        <div class = "col-1 px-md-4"></div>
                    </div>
                </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>

