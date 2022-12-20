<?php
class Baza {
private $mysqli; //uchwyt do BD
public function __construct($serwer, $user, $pass, $baza) {
    $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
    /* sprawdz połączenie */
    if ($this->mysqli->connect_errno) {
        printf("Nie udało sie połączenie z serwerem: %s\n",
        $mysqli->connect_error);
        exit();
    }else{
        echo "<p>Udało sie połączenie z serverem</p>";
        $sql = "INSERT INTO klienci (Nazwisko, age, Kraje, email, jezyki, metoda) VALUES ('John', '21', 'Niemcy','john@example.com', 'C', 'Visa' )";
    
    }
    /* zmien kodowanie na utf8 */
    if ($this->mysqli->set_charset("utf8")) {
    //udało sie zmienić kodowanie
    }
} //koniec funkcji konstruktora

function __destruct() {
$this->mysqli->close();

}
public function select($sql, $pola) {
//parametr $sql – łańcuch zapytania select
//parametr $pola - tablica z nazwami pol w bazie
//Wynik funkcji – kod HTML tabeli z rekordami (String)
$tresc = "";
if ($result = $this->mysqli->query($sql)) {
    $ilepol = count($pola); //ile pól
    $ile = $result->num_rows; //ile wierszy
    // pętla po wyniku zapytania $results
    $tresc.="<table><tbody>";
    while ($row = $result->fetch_object()) {
        $tresc.="<tr>";
        for ($i = 0; $i < $ilepol; $i++) {
            $p = $pola[$i];
            $tresc.="<td>" . $row->$p . "</td>";
        }
        $tresc.="</tr>";
    }
    $tresc.="</table></tbody>";
    $result->close(); /* zwolnij pamięć */
    }
    return $tresc;
    }
    
    public function delete($sql) {
        if( $this->mysqli->query($sql)) return true; else return false;
    }
    public function insert($sql) {
    if( $this->mysqli->query($sql)) return true; else return false;
    $stmt = $bd->prepare("INSERT INTO USERS (login, pass) VALUES (?, ?)");
    $stmt->bindParam(1, $login);
    $stmt->bindParam(2, $pass);
    // dodanie jednego wiersza:
    $login = 'ola';
    $pass = 'ola123';
    $stmt->execute();
    }
    public function getMysqli() {
        return $this->mysqli;
    }
    
    function dodajdoBD($bd){
        //pobierz dane z formularza, dokonaj ich walidacji
        $args = [
            'Nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
            'age' => FILTER_SANITIZE_NUMBER_INT,
            'jezyki' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,'flags' => FILTER_REQUIRE_ARRAY],
            'Kraje' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'e-mail' => FILTER_SANITIZE_EMAIL,
            'metoda' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        ];
        //przefiltruj dane z GET/POST zgodnie z ustawionymi w $args filtrami:
        $dane = filter_input_array(INPUT_POST, $args);
        //pokaż tablicę po przefiltrowaniu - sprawdź wyniki filtrowania:
        var_dump($dane);
        //Sprawdź czy dane w tablicy $dane nie zawierają błędów walidacji:
        $errors = "";
        foreach ($dane as $key => $val) {
            if ($val === false or $val === NULL) {
                $errors .= $key . " ";
            }
            }
            if ($errors === "") {
                $nazw = $dane['Nazwisko'];
                $wiek = $dane['age'];
                $kraj = $dane['Kraje'];
                $email = $dane['e-mail'];
                $kurs = (implode(",", $dane['jezyki']));
                $metoda = $dane['metoda'];
                $sql ="INSERT INTO klienci VALUES (NULL, '$nazw', '$wiek', '$kraj', '$email', '$kurs', '$metoda')";
                // 'bbbp@ollub.pl', 'Java,CPP', 'Przelew');
                //i wywołaj metodę:
                $bd->insert($sql);
                echo "<p>Dodano: </p>";
                var_dump($dane);
            
            } else {
                echo "<br>Nie poprawnie dane: " . $errors;
            }
       
       
        }

        public function selectUser($login, $passwd, $tabela) {
            //parametry $login, $passwd , $tabela – nazwa tabeli z użytkownikami
            //wynik – id użytkownika lub -1 jeśli dane logowania nie są poprawne
            $id = -1;
            $sql = "SELECT * FROM $tabela WHERE userName='$login'";
            if ($result = $this->mysqli->query($sql)) {
                     $ile = $result->num_rows;
                     if ($ile == 1) {
                        $row = $result->fetch_object(); //pobierz rekord z użytkownikiem
                        $hash = $row->passwd;
                         //sprawdź czy pobrane hasło pasuje do tego z tabeli bazy danych:
                         if (password_verify($passwd, $hash)){
                                 $id = $row->id; //jeśli hasła się zgadzają - pobierz id
                             }
                     }
                 }
            return $id; //id zalogowanego użytkownika(>0) lub -1
        }
}
?>