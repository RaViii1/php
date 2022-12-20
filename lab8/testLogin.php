<?php
 include_once 'klasy/Baza.php';
 include_once 'user.php';
 include_once 'UserManager.php';
 $db = new Baza("localhost", "root", "", "klienci");
 $um = new UserManager();
 session_start();
 $IdUser=$um->getLoggedInUser($db, session_id());
 if($IdUser != -1 ){ //jeżeli jest -1 to znaczy że rekord jest pusty
    echo "<a href='processLogin.php?akcja=wyloguj' > Wyloguj</a> </p>";
    echo "<h3>Dane zalogowanego użytkownika: </h3>";
    echo "ID użytkownika: "  .$IdUser;
    echo "<p>Szczegółowe informacje: </p>";
    echo $db->select("select userName,fullName, email from users where id = $IdUser", ["userName","fullName","email"]);
    echo "<h3>I inne informacje dla zalogowanego użytkownika...: </h3>";
 }
else{
    $um->loginForm();
}
?>