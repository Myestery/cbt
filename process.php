<?php
session_start();
include 'includes/config.php';
Database::initialize();
$errors = array();
if (isset($_SESSION['gwaliusername'])) {
    if (isset($_POST['timestat']) || isset($_POST['currentquestion']) || isset($_POST['subject'])) {
        $username =  $_SESSION['gwaliusername'];
        $timestat = mysqli_real_escape_string(Database::$conn, $_POST['timestat']);
        $query = "UPDATE users  SET Timeleft = '$timestat' WHERE username = '$username' ";
        mysqli_query(Database::$conn, $query);
        if (isset($_POST['phyAns'])) {
            $phyAns = mysqli_real_escape_string(Database::$conn, $_POST['phyAns']);
            $query2 = "UPDATE users  SET phyanswers = '$phyAns' WHERE username = '$username' ";
            mysqli_query(Database::$conn, $query2);
        }
        if (isset($_POST['currentquestion'])) {
            $username =  $_SESSION['gwaliusername'];
            $currentquestion = mysqli_real_escape_string(Database::$conn, $_POST['currentquestion']);
            $query = "UPDATE users  SET currentquestion = '$currentquestion' WHERE username = '$username' ";
            mysqli_query(Database::$conn, $query);
            echo $currentquestion;
        }
        if (isset($_POST['subject'])) {
            switch ($_POST['subject']) {
                case 'bio':
                    $bioAns =  $_POST['Answer'];
                    mysqli_query(Database::$conn, "UPDATE users  SET bioanswers = '$bioAns' WHERE username = '$username' ");
                    break;
                case 'eng':
                    $engAns =  $_POST['Answer'];
                    mysqli_query(Database::$conn, "UPDATE users  SET enganswers = '$engAns' WHERE username = '$username' ");
                    break;
                case 'chem':
                    $chemAns =  $_POST['Answer'];
                    mysqli_query(Database::$conn, "UPDATE users  SET chemanswers = '$chemAns' WHERE username = '$username' ");
                    break;
                case 'phy':
                    $phyAns =  $_POST['Answer'];
                    mysqli_query(Database::$conn, "UPDATE users  SET phyanswers = '$phyAns' WHERE username = '$username' ");
                    break;
            }
        }
    }
    if (isset($_POST['logout'])) {
        session_destroy();
        echo 'logged out';
    } else {
        echo "Wetin you dey find for here bros?";
    }
}
