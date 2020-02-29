<?php
     include 'config.php';
     session_start();
     Database::$conn= mysqli_connect("localhost", "root", "Gwalian4.");
     mysqli_select_db( Database::$conn, "cbt");
     $errors= array();
if(isset($_POST["submit"])){ 

     $firstname= mysqli_real_escape_string(Database::$conn, $_POST['firstname']);
     $username=  mysqli_real_escape_string(Database::$conn, $_POST['username']);
     $lastname=  mysqli_real_escape_string(Database::$conn, $_POST['lastname']);
     $password1=  mysqli_real_escape_string(Database::$conn, $_POST['password1']);
     $password2=  mysqli_real_escape_string(Database::$conn, $_POST['password2']);
     $level=  mysqli_real_escape_string(Database::$conn, $_POST['level']);
     $department=  mysqli_real_escape_string(Database::$conn, $_POST['department']);
     $timeleft=4200000;
     $currentquestion=1;
     
    $firstname= stripcslashes($firstname);
    $username= stripcslashes($username);
    $lastname= stripcslashes($lastname);
    $password1= stripcslashes($password1);
    $password2= stripcslashes($password2);
    $level= stripcslashes($level);
    $department= stripcslashes($department);
           // form validation
           if(empty($username)){array_push($errors, "Username is required");};
           if(empty($password1)){array_push($errors, "Password is required");};
           if(empty($firstname)){array_push($errors, "Firstname is required");};
           if($password1 != $password2){array_push($errors, "Passwords do not match");};
   
           //checking for existing user with the same username
           $user_check_query = "SELECT * FROM users WHERE username= '$username' LIMIT 1";
   
           $exist = mysqli_query(Database::$conn, $user_check_query);
           $user = mysqli_fetch_assoc($exist);
           if($user){
               if($user['username']===$username){array_push($errors, "Username already exists.<br>Try <a href='signup.php'>signing up</a> again");}
           }
           //Register the user if there are no errors
   
           if(count($errors)== 0){
               $password = md5($password1); //to encrypt the password
               $query ="INSERT INTO users(username, password, department, firstname, lastname, level, Timeleft,currentquestion) VALUES('$username','$password','$department','$firstname','$lastname','$level','$timeleft','$currentquestion')";  
               mysqli_query(Database::$conn, $query);
               $_SESSION['gwaliusername'] = $username;
               $_SESSION['department']= $row['department'];
               $_SESSION['success'] = "You are now logged in";
               header('location: login.php');     
           }
           include 'errors.php';
        }
