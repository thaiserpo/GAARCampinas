<?php
  $login_cookie = $_COOKIE['login'];
    if(isset($login_cookie)){
      echo"Bem-Vindo, $login_cookie <br>";
      echo"Nosso site está em construção, em breve novidades";
    }
?>