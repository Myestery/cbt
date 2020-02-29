<?php
    session_start();
    include 'config.php';
    Database::$conn= mysqli_connect("localhost", "root", "Gwalian4.");
    mysqli_select_db( Database::$conn, "cbt");
    $errors= array();
    $username=  $_SESSION['gwaliusername'];
    if(isset($_SESSION['gwaliusername'])){
        $query = "SELECT * FROM users WHERE username= '$username' ";
        $result=mysqli_query(Database::$conn, $query);
        $row= mysqli_fetch_array($result);
        echo $row['Timeleft'];
}else{
    echo'we no c anytin';
}

?>