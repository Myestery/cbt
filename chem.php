<?php
include 'includes/functions.php';
Database::initialize();
if (isset($_SESSION['gwaliusername'])) {
  $username =  $_SESSION['gwaliusername'];
  $query = "SELECT * FROM users WHERE username= '$username' ";
  $result = mysqli_query(Database::$conn, $query);
  $row = mysqli_fetch_array($result);
  $_SESSION['Timeleft'] = $row['Timeleft'];
}
if (!isset($_SESSION['gwaliusername'])) {
  if (isset($_POST['expired'])) {
    header('location: chem.php');
    $_SESSION['Timeleft'] = 0;
  }
  $_SESSION['msg'] = "<div id='container'><h2>You must log in first to view this page<h2></div>";
  echo $_SESSION['msg'];
  echo '<br><a href="login.php">Login here</a>';
}
if (isset($_SESSION['gwaliusername'])) {
  if (($_SESSION['Timeleft']) < 1000) {
    $_SESSION['msg'] = "<h2>You have successfully written this examination <h2>";
    echo $_SESSION['msg'];
    echo '<br><a href="realmarker.php">view score</a>';
  }
}
if (isset($_SESSION['Timeleft']))
  if (($_SESSION['Timeleft']) > 1000) :
?>
  <?php
    if (isset($_GET['logout'])) {
      session_destroy();
      unset($_SESSION['gwaliusername']);
      header("location: login.php");
    }
    include 'includes/header.php';

  ?>

  <body onload="gettime();getscore('chemanswers')">
    <?php
    if (isset($_SESSION['gwaliusername'])) :
    ?>
      <script src="js/jquery-3.2.1.min.js"></script>
      <script src="js/ajax.js"></script>
      <script src="js/script.js"></script>
      <script>
        $("title").text("Chemistry");
        var s = setInterval(function() {
          $.post("process.php", {
            timestat: currenttime,
            subject: subject,
            answers: JSON.stringify(Ans)
          });
        }, 9000);
        var Ans = [{
            answer: "0",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          },
          {
            answer: "",
            option: ""
          }
        ];
        var subject = "chem";
      </script>
      <?php topHead('chem'); ?>
      <h3>Chemistry</h3>
      <div id="container">
        Start Immediately, your time is running<b id="current"> </b>
      </div>
      <div>
        <div id="buttoncont"><button onclick="undoColor(); prev()">Prev</button><button onclick="undoColor(); next()">Next</button>
          <button onclick="undoColor();chem(1)" id="1">1</button><button onclick="undoColor(); chem(2);" id="2">2</button><button onclick="undoColor(); chem(3)" id="3">3</button><button onclick="undoColor(); chem(4)" id="4">4</button><button onclick="undoColor(); chem(5)" id="5">5</button><button onclick="undoColor(); chem(6)" id="6">6</button><button onclick="undoColor(); chem(7)" id="7">7</button><button onclick="undoColor(); chem(8)" id="8">8</button><button onclick="undoColor(); chem(9)" id="9">9</button><button onclick="undoColor(); chem(10)" id="10">10</button><button onclick="undoColor(); chem(11)" id="11">11</button><button onclick="undoColor(); chem(12)" id="12">12</button><button onclick="undoColor(); chem(13)" id="13">13</button><button onclick="undoColor(); chem(14)" id="14">14</button><button onclick="undoColor(); chem(15)" id="15">15</button><button onclick="undoColor(); chem(16)" id="16">16</button><button onclick="undoColor(); chem(17)" id="17">17</button><button onclick="undoColor(); chem(18)" id="18">18</button><button onclick="undoColor(); chem(19)" id="19">19</button><button onclick="undoColor(); chem(20)" id="20">20</button><button id="finalsubmit" onclick="promptsubmit()">Submit</button></div>
      </div>
    <?php endif ?>
  <?php endif ?>
  </body>

  </html>