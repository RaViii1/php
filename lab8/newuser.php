<?php
include_once "klasy/Baza.php";
$db = new Baza('localhost', 'root', '', 'klienci');
$pass= password_hash('user', PASSWORD_DEFAULT);
$date=date("Y-m-d H:i:s");
$sql = "INSERT INTO users VALUES(NULL, 'user','user', 'user@gmail.com', '$pass' , '0' , '$date')";
$db->insert($sql);
$pass= password_hash('admin', PASSWORD_DEFAULT);
$date=date("Y-m-d H:i:s");
$sql = "INSERT INTO users VALUES(NULL, 'admin','admin', 'admin@gmail.com', '$pass' , '1' , '$date')";
$db->insert($sql);
?>