<?php
include 'config.php';
session_start();
Database::$conn = mysqli_connect("localhost", "root", "Gwalian4.");
mysqli_select_db(Database::$conn, "cbt");
$errors = array();
if (isset($_POST["submit"])) {

    $firstname = mysqli_real_escape_string(Database::$conn, $_POST['firstname']);
    $username =  mysqli_real_escape_string(Database::$conn, $_POST['username']);
    $lastname =  mysqli_real_escape_string(Database::$conn, $_POST['lastname']);
    $password1 =  mysqli_real_escape_string(Database::$conn, $_POST['password1']);
    $password2 =  mysqli_real_escape_string(Database::$conn, $_POST['password2']);
    $level =  mysqli_real_escape_string(Database::$conn, $_POST['level']);
    $department =  mysqli_real_escape_string(Database::$conn, $_POST['department']);
    $timeleft = 4200000;
    $currentquestion = 1;

    $firstname = stripcslashes($firstname);
    $username = stripcslashes($username);
    $lastname = stripcslashes($lastname);
    $password1 = stripcslashes($password1);
    $password2 = stripcslashes($password2);
    $level = stripcslashes($level);
    $department = stripcslashes($department);
    // form validation
    if (empty($username)) {
        array_push($errors, "Username is required");
    };
    if (empty($password1)) {
        array_push($errors, "Password is required");
    };
    if (empty($firstname)) {
        array_push($errors, "Firstname is required");
    };
    if ($password1 != $password2) {
        array_push($errors, "Passwords do not match");
    };

    //checking for existing user with the same username
    $user_check_query = "SELECT * FROM users WHERE username= '$username' LIMIT 1";

    $exist = mysqli_query(Database::$conn, $user_check_query);
    $user = mysqli_fetch_assoc($exist);
    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists.<br>Try <a href='signup.php'>signing up</a> again");
        }
    }
    //Register the user if there are no errors

    if (count($errors) == 0) {
        $password = md5($password1); //to encrypt the password
        $query = "INSERT INTO users(username, password, department, firstname, lastname, level, Timeleft,currentquestion) VALUES('$username','$password','$department','$firstname','$lastname','$level','$timeleft','$currentquestion')";
        mysqli_query(Database::$conn, $query);
        $_SESSION['gwaliusername'] = $username;
        $_SESSION['department'] = $row['department'];
        $_SESSION['success'] = "You are now logged in";
        header('location: login.php');
    } else {
        var_dump($errors);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <script src="js2.js"></script>
    <script src="jquery-3.2.1.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body>
    <div class="bg-contact2" style="background-image: url('images/bg-01.jpg');">
        <div class="container-contact2">
            <div class="wrap-contact2">
                <form onsubmit="return(validate());" action="signup.php" name="userform" method="POST" class="contact2-form validate-form">

                    <span class="contact2-form-title">
                        SIGN UP</span>

                    <div class="wrap-input2 validate-input" data-validate="Userame is required">
                        <label for="Username"><input type="text" name="username" class="input2" minlength="5" required></label>
                        <span class="focus-input2" data-placeholder="USERNAME"></span>
                    </div>
                    <div class="wrap-input2 validate-input" data-validate="Userame is required">
                        <label for="Firstname"><input type="text" name="firstname" class="input2" required></label>
                        <span class="focus-input2" data-placeholder="FIRSTNAME"></span>
                    </div>
                    <div class="wrap-input2 validate-input" data-validate="Userame is required">
                        <label for="Surname"><input type="text" name="lastname" class="input2" required></label>
                        <span class="focus-input2" data-placeholder="SURNAME"></span>
                    </div>
                    <div class="wrap-input2 validate-input" data-validate="Userame is required">
                        <label><b>Department</b>
                            <select id="department" class="input2" name="department">
                                <option value="computer science" selected>Computer Science</option>
                                <option value="geology">Geology</option>
                                <option value="pic">Pure and industrial Chemistry</option>
                                <option value="Statistics">Statistics</option>
                                <option value="Mathematics">Mathematics</option>
                            </select></label>
                    </div>
                    <div class="wrap-input2 validate-input" data-validate="Userame is required">
                        <label><b>Level of Study</b><select id="level" class="input2" name="level">
                                <option value="100" selected>100 level</option>
                                <option value="200">200 level</option>
                                <option value="300">300 level</option>
                                <option value="400">400 level</option>
                            </select></label>
                    </div>
                    <div class="wrap-input2 validate-input" data-validate="Userame is required">
                        <label for="Password"><input type="password" name="password1" class="input2" required id="password1"></label>
                        <span class="focus-input2" data-placeholder="PASSWORD"></span>
                    </div>
                    <div class="wrap-input2 validate-input" data-validate="Userame is required">
                        <label for="Confirm Password"><input type="password" name="password2" class="input2" id="password2" required></label>
                        <span class="focus-input2" data-placeholder="CONFIRM PASSWORD"></span>
                    </div>
                    <input type="submit" value="submit" id="submit" name="submit"><br><br>
                    Already have an account?<br>
                    <a href="login.php">Log In Here</a>
            </div>
        </div>
    </div>
    </div>
    </form>
</body>

</html>