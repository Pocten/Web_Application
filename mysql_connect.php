<?php
  $user = 'iastrnik';
  $password = 'webove aplikace';
  $db = 'iastrnik';
  $host = 'localhost';

  $dsn = 'mysql:host='.$host.';dbname='.$db;
  $pdo = new PDO($dsn, $user, $password);
?>
