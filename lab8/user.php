<?php
 include_once('klasy/Baza.php');
class User {
    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;
    protected $userName;
    protected $passwd;
    protected $fullName;
    protected $email;
    protected $date;
    protected $status;
    function __construct($userName, $fullName, $email, $passwd ){
            $this->status=User::STATUS_USER;
            $this->userName=$userName;
            $this->passwd=password_hash($passwd, PASSWORD_BCRYPT);
            $this->date = date("Y-m-d");
            $this->fullName=$fullName;
            $this->email=$email;
    }
    Public function show() {
            $t = '<p>Username: ' . $this->userName . ',';
            $t .= '<p>Full name: ' . $this->fullName . ',';
            $t .= '<p>Password: ' . $this->passwd . ',';
            $t .= '<p>E-Mail: ' . $this->email . ',';
            $t .= '<p>Date: ' . $this->date . ',';
            if($this->status==2){
                $t .= 'Admin';
            }
            else{
                $t .= 'User';
            }
            $t .= '</p>';
            echo $t;
    }
    public function setUserName($newName){
        $this->userName = $newName;
    }
    public function setFullName($newfullName){
        $this->fullName = $newfullName;
    }
    public function setEmail($newEmail){
        $this->email = $newEmail;
    }
    public function setPassword($newpasswd){
        $this->passwd = password_hash($newpasswd, PASSWORD_BCRYPT);
    }
    public function setStatus($newStatus){
        if($newStatus != User::STATUS_ADMIN && $newStatus != User::STATUS_USER){
            $newStatus = USER::STATUS_USER;
        }
        $this->status = $newStatus;
    }
    public function getUserName(){
        return $this->userName;
    }
    public function getFullName(){
        return $this->fullName;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getDate(){
        return $this->date;
    }
    public function getPassword(){
        return $this->passwd;
    }
    public function getStatus(){
        return $this->status;
    }
    function toArray(){
        $arr=[
        "userName" => $this->userName,
        "fullName" => $this->fullName,
        "passwd" => $this->passwd,
        "email" => $this->email,
        "date" => $this->date,
        "status" => $this->status,
        ];
        return $arr;
    }
    public function saveDB($db){
        $uN = $this->getUserName();
        $fn = $this->getFullName();
        $em = $this->getEmail();
        $paswd = $this->getPassword();
        $st= $this->getStatus();
        $dt = $this->getDate();
        $sql ="INSERT INTO users VALUES (NULL, '$uN', '$fn', '$em', '$paswd','$st','$dt')";
        $db->insert($sql);
    }
     static public function getAllUsersFromDb($db){
        echo $db->select("select userName,fullName, email from users", ["userName","fullName","email"]);
    }
}
?>