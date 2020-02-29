<?php
    Database::$conn= mysqli_connect("localhost", "root", "Gwalian4.");
    mysqli_select_db( Database::$conn, "cbt");
    session_start();
    $errors= array();
    //Logging in existing user
    if(isset($_POST['submit'])){
     $username= $_POST['username'];
     $password=$_POST['password'];
     
     $username= stripcslashes($username);
     $password= stripcslashes($password);
 
     $username=  mysqli_real_escape_string(Database::$conn, $username);
     $password=  mysqli_real_escape_string(Database::$conn, $password);
     $passworde= md5($password);
 
    $result= mysqli_query(Database::$conn,"SELECT * from users where username ='$username' and password ='$passworde' ")
                    or die("failed to query database" .mysqli_error());
                    $row= mysqli_fetch_array($result);
    if ($row['username'] == $username && $row['password'] == $passworde){  
         echo "Welcome ".$row['username'];
         $_SESSION['department']= $row['department'];
         echo" <br> You are in the department of ".$row['department'];
         $_SESSION['gwaliusername'] = $username;
         $_SESSION['firstname']= $row['firstname'];
         $_SESSION['Timeleft']= $row['Timeleft'];
         header('location: chem.php');
    } else{
            echo "
            <html>
<head>
    <meta charset='utf-8'>
    <meta name='2019' content='Resolution'>
    <title>Wrong Login Details</title>
 <link type='text/css' rel='stylesheet' href='chem/style/style.css'>
 <link href='ico/23.jpg' rel='icon'>
 <link href='ico/23.jpg' rel='apple-touch-icon'>
 <script src='js/chem.js'></script>
 <script src='js/jquery-3.2.1.min.js'></script>
 <script src='js/ajax.js'></script>

 </head>
 <body>
    <h2>Wrong Login Details</h2> 
            <h3>Username and password do not match</h3>
            <br><a href='login.php'>Back to Login</a>";
    }
}else if(isset($_POST['logout'])){
    session_destroy();
    header('location: login.php');
}else{
     echo "Something went wrong
     <br> You are in the wrong place";
}
   ?> 