<?php
session_start();
include 'includes/config.php';
Database::initialize();
$errors = array();
$results = array();
$username = $_SESSION['gwaliusername'];
if (isset($_SESSION['gwaliusername'])) {
    if (isset($_POST['answer'])) {
        $query = "SELECT * FROM users WHERE username= '$username' ";
        $result = mysqli_query(Database::$conn, $query);
        $row = mysqli_fetch_array($result);
        echo $row[$_POST['answer']];
    }
    if (isset($_POST['gettime'])) {
        $query = "SELECT * FROM users WHERE username= '$username' ";
        $result = mysqli_query(Database::$conn, $query);
        $row = mysqli_fetch_array($result);
        array_push($results, $row['Timeleft']);
        array_push($results, $row['currentquestion']);
        echo (json_encode($results));
    }
}
