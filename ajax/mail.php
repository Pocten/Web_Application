<?php
  $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
  $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
  $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_STRING));

  $error = '';
  if(strlen($username) <= 3)
    $error = 'Zadejte jmeno';
  else if(strlen($email) <= 3)
    $error = 'Zadejte e-mail';
  else if(strlen($mess) <= 3)
    $error = 'Zadejte svoji zprávu';

  if($error != '') {
    echo $error;
    exit();
  }

  $my_email = "neohawk51@gmail.com";
  $subject = "=?utf-8?B?".base64_encode("Новое сообщение с сайта")."?=";
  $headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n";

  mail($my_email, $subject, $mess, $headers);

  echo 'Hotovo';
?>
