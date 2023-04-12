<?php
   session_start();
   unset($_SESSION["id"]);
   unset($_SESSION["name"]);
   unset($_SESSION['role']);
   
   echo 'You have cleaned session';
   header("Location:/faion/index.php/");
?>