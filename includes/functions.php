<?php
include 'config.php';
Database::initialize();
session_start();
$errors = array();
$results = array();
if (isset($_SESSION['gwaliusername'])) {
    $username = $_SESSION['gwaliusername'];
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
if (isset($_POST['coursecode'])) {
    $coursecode = $_POST['coursecode'];
    $courseTitle = $_POST['coursename'];
    $questions = addslashes($_POST['questions']);
    $answers = addslashes($_POST['answers']);
    $query = "INSERT INTO cbt_test VALUES('$coursecode','$courseTitle','$questions','$answers')";
    mysqli_query(Database::$conn, $query);
    echo $query;
    if (mysqli_affected_rows(Database::$conn) > 0) {
        echo 'test created';
    }
}

function topHead($subject)
{
    $array = array('eng', 'phy', 'bio', 'chem');
    $subjects = array('eng' => 'English', 'phy' => 'Physics', 'bio' => 'Biology', 'chem' => 'Chemistry');
    echo '
    <header>';
    for ($i = 0; $i < count($array); $i++) {
        if ($array[$i] != $subject) {
            echo "<a href=" . $array[$i] . ".php class='sublink btn-info'>" . $subjects[$array[$i]] . "</a>";
        }
    }
    echo '<button id="logout" class="btn btn-danger">Logout</button><span id="span">Time Left : <span id="demo">01:59:59</span></span></header>';
}
function getTestforEditing()
{
    $query = "SELECT *from cbt_test";
    $array = mysqli_fetch_all(mysqli_query(Database::$conn, $query));
    echo '<table class="table table-bordered table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>Course Name</th>
            <th>Course Title</th>
            <th>No of Questions</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>';
    for ($i = 0; $i < count($array); $i++) {
        echo ' <tr>
        <td scope="row">' . $array[$i][0] . '</td>
        <td>' . $array[$i][1] . '</td>
        <td>' . count(json_decode($array[$i][3])) . '</td>
        <td><a href="http://johnpaul/chem/admin.php?testToEdit=' . $array[$i][0] . '">Edit</a></td>
    </tr>';
    }
    echo '</tbody>
    </table>';
}
function editTest($testToEdit)
{
    $query = "SELECT *from cbt_test WHERE Course_code = '$testToEdit'";
    $array = mysqli_fetch_array(mysqli_query(Database::$conn, $query));
    $questions = $array[2];
    $questions = json_decode($questions);
    echo'';
}
