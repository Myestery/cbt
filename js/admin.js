$(document).ready(function () {
  let questionlength = 1;
  $("#addbtn").click(function (e) {
    e.preventDefault();
    questionlength++;
    $("#questionbank").append(
      '<div class="form-group question-group"><label for="Question' +
      questionlength +
      '">Question ' +
      questionlength +
      '</label><input type="text" id="Question' +
      questionlength +
      '" class="form-control" placeholder="Question' +
      questionlength +
      ' " aria-describedby="Question' +
      questionlength +
      'help"><small id="Question' +
      questionlength +
      'help " class="text-muted ">Input a Question</small> <ul><li><div class = "form-group" > <label for = "Option1' +
      questionlength +
      '"> Option 1 </label> <input type="radio" name="question' +
      questionlength +
      '" value="1"><input type="text " id="Option1' +
      questionlength +
      '" class="form-control" placeholder="Option 1" aria - describedby="Option1help1' +
      questionlength +
      '"> <small id="Option1help1' +
      questionlength +
      '" class="text-muted"> Input an Option </small> </li><li><div class = "form-group" > <label for = "Option2' +
      questionlength +
      '"> Option 2 </label><input type="radio" name="question' +
      questionlength +
      '" value="2"><input type="text" id="Option2' +
      questionlength +
      '" class="form-control" placeholder="Option 2" aria - describedby="Option2help' +
      questionlength +
      '"> ' +
      '<small id="Option2help' +
      questionlength +
      '" class="text-muted"> Input an Option </small> </li><li><div class = "form-group" > <label for = "Option3' +
      questionlength +
      '"> Option 3 </label><input type="radio" name="question' +
      questionlength +
      '" value="3"><input type="text" id="Option3' +
      questionlength +
      '" class="form-control" placeholder="Option 3" aria - describedby="Option3help' +
      questionlength +
      '"> <small id="Option3help' +
      questionlength +
      '" class="text-muted"> Input an Option </small> </li><li><div class = "form-group" > <label for = "Option4' +
      questionlength +
      '"> Option 4 </label><input type="radio" name="question' +
      questionlength +
      '" value="4"><input type="text" id="Option4' +
      questionlength +
      '" class="form-control" placeholder="Option 4" aria - describedby="Option4help' +
      questionlength +
      '"> <small id="Option4help' +
      questionlength +
      '" class="text-muted"> Input an Option </small> </li> </ul> </div > '
    );
  });
  $("#removebtn").click(function (e) {
    e.preventDefault();
    $(".question-group")
      .eq(questionlength - 1)
      .remove();
    questionlength--;
  });
  $("#savenew").click(function (e) {
    e.preventDefault();
    $("#errormessage").html("");
    let readytosend = true;
    let errors=[];
    // check if all the questions have answers
    for (let x = 0; x < questionlength; x++) {
      if ($("input[name='question" + (x + 1) + "']:checked").val() == undefined) {
        errors.push("Question " +( x+1 )+ " is not answered");
        readytosend = false;
      }
    }
    // check if all the questions have options and questions
    for (let x = 0; x < questionlength; x++) {
      if ($("#Question" + (x + 1)).val() == undefined) {
        errors.push("Question " + (x+1) + " does not have a question");
        readytosend = false;
        break;
      } 
      for(let y=1;y<5;y++){
        if($("#Option"+y+""+(x + 1)).val()==""){
          errors.push("Question " + (x+1) + " does not have an Option "+y+"");
          readytosend=false;
          //hh
        }
      }
    }

    //save question and answer to json
    if(readytosend){
    let questions = [];
    let answers = [];
    for (let x = 0; x < questionlength; x++) {
      let question = $("#Question" + (x + 1)).val();
      let option1 = $("#Option1" + (x + 1)).val();
      let option2 = $("#Option2" + (x + 1)).val();
      let option3 = $("#Option3" + (x + 1)).val();
      let option4 = $("#Option4" + (x + 1)).val();
      let current = {
        "question": question,
        "option1": option1,
        "option2": option2,
        "option3": option3,
        "option4": option4
      };
      questions.push(current);
      let currentans = {
        "question": x + 1,
        "answer": $("input[name='question" + (x + 1) + "']:checked").val()
      };
      answers.push(currentans);
    }
    $.post("http://johnpaul/chem/includes/functions.php", {
      questions: JSON.stringify(questions),
      answers: JSON.stringify(answers),
      coursecode: $("#CourseId").val(),
      coursename: $("#CourseName").val()
    }, function (data) {
      console.log(data);
    });
  }else{
      for(let error of errors){
        $("#errormessage").toggleClass("none");
        $("#errormessage").append("<p>"+error+"</p>");
      }
      window.scrollTo(0, document.documentElement.scrollHeight);
  }
  });

});