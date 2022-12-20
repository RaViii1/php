<?php
 require_once "UserLog.php";
 session_start();
 echo "<h2>Informacje tylko dla uprawnionych</h2>";
 //sprawdzenie zmiennej sesji
 if (isset($_SESSION["userOK"])) {
    $user = unserialize($_SESSION["userOK"]);
    echo "Użytkownik zalogowany jako:" .$user->getName(). "<br/>";
    echo "Informacje tylko dla zalogowanych użytkowników ...";
 } else {
    echo "<h2>Użytkownik niezalogowany</h2>";
    echo "Tylko zalogowani użytkownicy mogą oglądać tę stronę";
 }
 echo "<br /><a href=\"loginForm.php\"> Powrót do strony głównej</a>";
?>