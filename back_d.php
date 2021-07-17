<?php 
require_once 'connection_bd.php';


class users{
   public function auth($conn,$login,$password)
   {
     $log_chek_q = "select user_name from users where user_name = '$login'";
     $log_chek_res = mysqli_query($conn,$log_chek_q);
     if ($log_chek_res == false)
     {
        echo 'Такой пользователь не зарегистрирован';
     }
     else 
     {
         $auth_query = "select user_name,user_password from users where user_name ='$login' and user_password ='$password'";
         $auth_res = mysqli_query($conn,$auth_query);
         if ($auth_res == true)
         {
            
            $_SESSION['user_login'] = $login;
            $_SESSION['user_password'] = $password;
            $_SESSION['loggined_user'] = $login;
            $_SESSION['is_loggined'] = true;
            if($_SESSION['is_admin'] == true)
            {
               header('location:l_TRPO_d.php');
            }
            else
            {
               header ('Location:main_d.php');
            }
         }
         else
         {
            echo 'Вы ввели неверный логин или пароль';
         }
      }
   
   }
   public function reg($conn,$fio,$email,$login,$password)
   {
         $err = false;
      /*Валидация ФИО*/
      if( !preg_match("/[а-я А-Я]+\s/",$fio)){
         
         echo 'ФИО должны содержать только буквы русского языка';
         $err = true;
      }
      if( !preg_match("/[а-я А-Я]{10,32}+\s/",$fio)){
      }
      else {
         echo " <br>ФИО должен содержать 10-32 символа";
         $err = true;
      }
      /*Валидация логина */
      if( preg_match("/[a-z A-Z 0-9]/",$login)){
      }
      else {
         echo '<br>Логин может содержать только буквы английского алфавита и цифры';
         $err = true;
      }
      if( preg_match("/[a-z A-Z 0-9]{6,32}/",$login)){
      }
      else {
         echo " <br>Логин должен содержать 6-32 символа";
         $err = true;
      }
      /*Валидация email */
      if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
         echo '<br>Неправильный формат введенного адреса электронной почты';
         $err = true;
      }
      /*Валидация пароля*/
      if( strlen($password) >5 && strlen($password) <33)
      {
         
      }
      else 
      {
         echo '<br>Пароль должен быть 6 символов или длиннее, до 32';
         $err = true;
      }
      if ($is_email_exist = mysqli_query($conn,"select email from users where email ='$email'") == false)
      {
         echo '<br>Такой адрес электронной почты уже использовался при регистрации';
         $err = true;
      }
      if ($is_login_exist = mysqli_query($conn,"select user_name from users where user_name ='$login'") == false)
      {
         echo '<br>Такой логин уже использовался при регистрации';
         $err = true;
      }
      if ($err == false)
      {
         $reg_query = "insert into users(full_name,email,user_name,user_password) values ('$fio','$email','$login','$password')";
         $reg_chek = mysqli_query($conn,$reg_query);
         if ($reg_chek)
         {
               header('location:authorization_d.php');
         }
      }

   }


   
}

  class admin 
 {
   public function add_student ($conn,$fio)
   {  
      $add_st_q = "insert into students (full_name) values ('$fio')";
      $adding = mysqli_query($conn,$add_st_q);
      if (!$adding)
      {
         echo 'Данные не добавлены';
      }
   }
   public function add_mark ($conn,$selected_t,$id_st,$mark,$mark_date)

   {
     
      $mark1 = $mark;
      settype($mark1,'integer');
      $mark1 ++;
      settype($mark1,'string');
      $query = "insert into $selected_t (id_st,mark,mark_date) values ('$id_st','$mark1','$mark_date')";
      $add_res = mysqli_query($conn,$query);
      if($add_res == true)
      {
         echo '<p class="text-center">Данные успешно добавлены</p>';
         
      }
      else 
      {
         echo '<p class="text-center">Данные не добавлены</p>';
      
      }
      
   }

   public function drop_mark ($conn, $selected_t,$id_st,$mark_date)
   {
      $query = "delete from $selected_t where id_st='$id_st' and mark_date='$mark_date'" ;
      $drop_res = mysqli_query($conn,$query);
      if($drop_res == true)
      {
         echo '<p class="text-center">Данные успешно удалены</p>';
      }
      else 
      {
         echo '<p class="text-center">Данные не удалены</p>';
      }
   }
   
   public function change_mark ($conn,$selected_t,$id_st,$mark_date,$value)
   {
      $query = "update $selected_t set mark = '$value' where mark_date ='$mark_date' and id_st = '$id_st'";
      $change_res = mysqli_query($conn,$query);
      if($change_res == true)
      {
         echo '<p class="text-center">Данные успешно обновлены</p>';
      }
      else 
      {
         echo '<p class="text-center">Данные не обновлены</p>';
      }
   }

   public function show_talbe($conn,$selected_t,$mark_date)
   {
      
      /*Вывод студентов*/
      $stud_q = "select * from students";
      $stud_q_res = mysqli_query($conn,$stud_q);
      /*Вывод оценок*/
      $mark_count_value = mysqli_num_rows($stud_q_res);
      for( $id_st = 1; $id_st <=$mark_count_value ; $id_st ++)
      {
      $mark_q = "select mark from $selected_t where id_st ='$id_st' and mark_date = '$mark_date'";
      $mark_q_res = mysqli_query($conn,$mark_q);
      $row = mysqli_fetch_row($stud_q_res);
      if($row_m = mysqli_fetch_row($mark_q_res))
      {
         echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row_m[0].'</td></tr>';
      }
      else 
      {
         echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td></td></tr>';
      }
      
      }
      
      
   }
   public function show_title($title)
   {
      switch ($title)
      {
         case 'trpo':
            echo 'Технология разработки ПО';
            break;
         case 'isrpo':  
            echo 'Инструментальные средства разработки ПО';
            break;
         case 'ino':
            echo 'Иностранный язык';
            break;
         case 'fizra':
            echo 'Физическая культура';
            break;
         case 'ppp':
            echo 'Пакеты прикладных программ';
            break;
         case 'mm':
            echo 'Математические методы';
            break;
         case 'ds':
            echo 'Документация и сертификация ПО';
            break;
            
      }
   }

   public function show_news_main($conn,$selected_t,$post_index)
   {
      $query = "select * from $selected_t where id_new = '$post_index'";
      $res_q =  mysqli_query($conn,$query);
      $row = mysqli_fetch_row($res_q);
      echo "
      
      <tr class='border'>
         <th  class='text-center' scope='row'>".$row[1]."</td>
      </tr>
      <tr class='border'>
         <td >".$row[2]."</td>
      </tr>
   ";
   }

   public function show_news_admin($conn,$selected_t,$post_index)
   {
      $query = "select * from $selected_t where id_new = '$post_index'";
      $res_q =  mysqli_query($conn,$query);
      $row = mysqli_fetch_row($res_q);
      echo "
      
         <tr class='border'>
            <td >".$row[1]."</td>
         </tr>
         <tr class='border'>
            <td>".$row[2]."</td>
         </tr>
      ";
   }

   public function edit_news($conn,$selected_t,$nt,$nc,$post_index)
   {
      $query = "update $selected_t set title_new = '$nt', content_new = '$nc' where id_new = '$post_index'";
      $q_res = mysqli_query($conn,$query);
      if(!$q_res)
      {
         echo 'Данные не обновлены';
      }
   }

   public function edit_rasp($conn,$selected_t,$new_photo)
   {
      $query_add = "insert into $selected_t values ('$new_photo')";
      $res_q_add = mysqli_query($conn,$query_add);
   }
   
   public function show_replacements($conn,$selected_t,$rep_id)
   {
      $query = "select * from $selected_t where id_rep = '$rep_id'";
      $res_q =  mysqli_query($conn,$query);
      if(!$res_q)
      {
         echo 'Что-то пошло не так';
      }
      else{
      $row = mysqli_fetch_row($res_q);
      echo "
      
         <tr class='border'>
            <td >".$row[1]."</td>
         </tr>
         <tr class='border'>
            <td>".$row[2]."</td>
         </tr>
      ";
      }
   }

   public function upd_replacements($conn,$selected_t,$rep_date,$rep_content,$rep_id)
   {
      $query = "update $selected_t set rep_date = '$rep_date', rep_content = '$rep_content' where id_rep = '$rep_id'";
      $res_q = mysqli_query($conn,$query);
      if(!$res_q)
      {
         echo 'Замены не были изменены';
      }
   }

 }
?>
