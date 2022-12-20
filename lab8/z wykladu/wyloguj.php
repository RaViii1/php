<?php
 require_once "UserLog.php";
 session_start();
 if (isset($_SESSION["userOK"])) {
 $old_user = unserialize($_SESSION["userOK"]); //czy było logowanie
 if ($old_user != null) {
 echo "<p>Wylogowano użytkownika:".$old_user->getName()."</p>";
 unset($_SESSION["userOK"]);
 $old_user->logout();
 }
 }
else echo "Użytkownik niezalogowany.<br />";
?>
<p><a href="loginForm.php"> Powrót do strony logowania </a></p>