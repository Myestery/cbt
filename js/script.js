$(document).ready(function() {
  setInterval(function() {
    if ($("#current").html().length > 0) {
      x = document.getElementById("current").innerHTML;
      if (Ans[x].answer != "") {
        switch (Ans[x].option) {
          case "a":
            document.getElementsByTagName("input")[0].checked = true;
            break;
          case "b":
            document.getElementsByTagName("input")[1].checked = true;
            break;
          case "c":
            document.getElementsByTagName("input")[2].checked = true;
            break;
          case "d":
            document.getElementsByTagName("input")[3].checked = true;
            break;
        }
      }
      //change button colour if answered
      for (i = 1; i < 31; i++) {
        if (Ans[i].answer != "") {
          $("#" + i).css({
            background: "green"
          });
        }
      }
    }
  }, 500);
  $("#logout").click(function(e) {
    $.post(
      "process.php",
      {
        logout: "logout"
      },
      function(data) {
        if (data == "logged out") {
          window.location.href = "login.php";
        }
      }
    );
  });
});
var currenttime = "";
var expired = "expired";

function abs(x) {
  if (x > 0) {
    return x;
  } else {
    return -x;
  }
}

function undoColor() {
  for (var y = 1; y < 31; y++) {
    $("#" + y).css({
      height: "50px",
      width: "80px"
    });
  }
}

function disptime(time_val) {
  x = setInterval(function() {
    // Find the distance between now and the count down date
    var distance = time_val;

    // Time calculations for days, hours, minutes and seconds
    var hours = Math.floor(
      (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"

    document.getElementById("demo").innerHTML =
      "0" + hours + ":" + minutes + ":" + seconds;

    // return the new time from the function
    time_val = time_val - 1000;
    currenttime = time_val;
    if (time_val < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "EXPIRED";
      finish();
    }
  }, 1000);
}
// function for next and previous buttons
function next() {
  now = parseInt(document.getElementById("current").innerHTML, 10);
  if (now) {
    if (now < 20) {
      chem(++now);
    } else {
      chem(1);
    }
  } else {
    chem(1);
  }
}

function prev() {
  now = parseInt(document.getElementById("current").innerHTML, 10);
  if (now > 1) {
    chem(--now);
  } else {
    chem(20);
  }
}
// update the answers to the object above
function mod(num, reply) {
  Ans[num].option = reply.charAt(reply.length - 1);
  Ans[num].answer = document.getElementById(reply).innerText;
  $.post("process.php", {
    timestat: currenttime,
    subject: subject,
    Answer: JSON.stringify(Ans)
  });
}

function promptsubmit() {
  var prom = confirm("Are you sure you want to submit?");
  if (prom == true) {
    finish();
  }
}

function finish() {
  $.post(
    "process.php",
    {
      timestat: -1000,
      Answer: JSON.stringify(Ans)
    },
    function(params) {
      gettime();
      history.go(0);
    }
  );
}
//09098464316