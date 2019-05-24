<?php
   $hostname_login = "localhost";
   $database_login = "capa";
   $username_login = "root";
   $password_login = "michi";
   $login = mysqli_connect($hostname_login, $username_login, $password_login) or trigger_error(mysql_error(),E_USER_ERROR);
   mysqli_select_db($login,$database_login);
   
?>