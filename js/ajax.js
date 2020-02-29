// initialise the default values for answers
var currenttime;

// update the time to the server and send the answered questions and value to the database
var prompt;
//modify the content of the inner div for questions
function loadQuestion(subject, container,x) {
  $("#container").html("Loading");
  $.post("./" + subject + "questions/" + subject + x + ".php", {}, function(
    question
  ) {
    $("#container").html(question);
  });
}
// fetch data and bolden the present question
function chem(x) {
  $.post("process.php", {
    currentquestion: x,
    question: subject,
    json: JSON.stringify(Ans)
  });
  $("#" + x).css({ height: "10%", width: "8%" });
  loadQuestion(subject, "container",x);
}
// get and update the timeleft on the browser screen
function gettime() {
  $.post("http://johnpaul/chem/includes/functions.php", {
    gettime:true,
    currentquestion:true
  },
    function (result) {
    //console.log(result);
      currenttime=parseInt(JSON.parse(result)[0],10);
      chem(parseInt(JSON.parse(result)[1]));
      disptime(currenttime);
    }
  );
}
gettime();
// send the answers in json format back to the browser
function getscore(subject) {
  $.post(
    "http://johnpaul/chem/includes/functions.php",
    {
      answer: subject
    },
    function(result) {
      Ans= JSON.parse(result);
    }
  );
}
$("#finalsubmit").on("click", function() {
  prompt= confirm("Are you sure you want to submit?");
  if (prompt) {
    $.post("process.php", {
      Answers: JSON.stringify(Ans)
    });
    //document.writeln("<h1>Thanks for participating in this test</h1>");
    $('body').append("<h1>Thanks for participating in this test</h1>");
  }
});
function clears() {
  clearInterval(s);
}
