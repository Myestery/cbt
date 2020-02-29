<?php
    session_start();
    include 'config.php';
    mysqli_select_db( Database::$conn, "cbt");
    $errors= array();
    $username=  $_SESSION['gwaliusername'];
    if(isset($_SESSION['gwaliusername'])){
        if(isset($_POST['answer'])){
        $query = "SELECT * FROM users WHERE username= '$username' ";
        $result=mysqli_query(Database::$conn, $query);
        $row= mysqli_fetch_array($result);
        echo $row[$_POST['answer']];
    }
}else{
    echo'we no c anytin';
}

?>