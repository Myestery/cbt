<?php
include 'includes/functions.php';
if (!isset($_GET['testToEdit'])) {
    echo '<!DOCTYPE html>
    <html>
    
    <head>
        <meta charset="utf-8">
        <meta name="2019" content="Resolution">
        <meta content="width=device-width,height=device-height initial-scale=1.0">
        <title>Biology</title>
        <link type="text/css" rel="stylesheet" href="style/style.css">
        <link type="text/css" rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
        <link href="ico/23.jpg" rel="icon">
        <link href="ico/23.jpg" rel="apple-touch-icon">
        <script src="http://johnpaul/chem/js/jquery-3.2.1.min.js"></script>
        <script src="js/admin.js">
        </script>
    </head>
    <h3>Create a test</h3>
    <details>
        <summary>More info</summary>
        <div id="create" class="">
            <div class="container">
                <fieldset class="form-group row">
                    <legend class="col-form-legend col-sm-1-12">
                        <b>Course Details</b></legend>
                    <div class="col-sm-1-12">
                        <div class="form-group">
                            <label for="Course Name" class="col-sm-1-12 col-form-label">Course Name</label>
                            <div class="col-sm-1-12">
                                <input type="text" class="form-control" name="Course Name" id="CourseName" placeholder="Course name">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1-12">
                        <div class="form-group">
                            <label for="CourseId">Course code</label>
                            <input type="text" name="" id="CourseId" class="form-control" placeholder="" aria-describedby="helpId">
                            <small id="helpId" class="text-muted">Input a course code</small>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="form-group" id="questionbank">
                    <legend class="col-form-legend col-sm-1-12">
                        <b>Questions</b></legend>
                    <div class="form-group question-group">
                        <label for=" Question1">Question 1</label>
                        <input type="text" name="" id="Question1" class="form-control" placeholder="Question 1" aria-describedby="Question1help">
                        <small id="Question1help" class="text-muted">Input a Question</small>
                        <ul>
                            <li>
                                <div class="form-group">
                                    <label for="Option11">Option 1</label>
                                    <input type="radio" name="question1" value="1">
                                    <input type="text" name="" id="Option11" class="form-control" placeholder="Option 1" aria-describedby="Option1help1">
                                    <small id="Option1help1" class="text-muted">Input an Option</small>
                            </li>
                            <li>
                                <div class="form-group">
                                    <label for="Option21">Option 2</label>
                                    <input type="radio" name="question1" value="2">
                                    <input type="text" name="" id="Option21" class="form-control" placeholder="Option 2" aria-describedby="Option2help1">
                                    <small id="Option2help1" class="text-muted">Input an Option</small>
                            </li>
                            <li>
                                <div class="form-group">
                                    <label for="Option31">Option 3</label>
                                    <input type="radio" name="question1" value="3">
                                    <input type="text" name="" id="Option31" class="form-control" placeholder="Option 3" aria-describedby="Option3help1">
                                    <small id="Option3help1" class="text-muted">Input an Option</small>
                            </li>
                            <li>
                                <div class="form-group">
                                    <label for="Option41">Option 4</label>
                                    <input type="radio" name="question1" value="4">
                                    <input type="text" name="" id="Option41" class="form-control" placeholder="Option 4" aria-describedby="Option4help1">
                                    <small id="Option4help1" class="text-muted">Input an Option</small>
                            </li>
                        </ul>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button class="btn btn-info" id="addbtn">Add</button>
                        <button type="submit" class="btn btn-primary" id="savenew">Save</button>
                        <button class="btn btn-danger" id="removebtn">Remove</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="none" id="errormessage"></div>
    </details>
    <h3>Edit Test</h3>';
    getTestforEditing();
    echo ' <!-- <h3>Add questions to already existing test</h3>
    <h3>Edit test</h3> -->';
} else {
    $testToEdit = $_GET['testToEdit'];
    editTest($testToEdit);
} ?>
<div id="create" class="">
    <div class="container">
        <fieldset class="form-group row">
            <legend class="col-form-legend col-sm-1-12">
                <b>Course Details</b></legend>
            <div class="col-sm-1-12">
                <div class="form-group">
                    <label for="Course Name" class="col-sm-1-12 col-form-label">Course Name</label>
                    <div class="col-sm-1-12">
                        <input type="text" class="form-control" name="Course Name" id="CourseName" placeholder="Course name">
                    </div>
                </div>
            </div>
            <div class="col-sm-1-12">
                <div class="form-group">
                    <label for="CourseId">Course code</label>
                    <input type="text" name="" id="CourseId" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">Input a course code</small>
                </div>
            </div>
        </fieldset>
        <fieldset class="form-group" id="questionbank">
            <legend class="col-form-legend col-sm-1-12">
                <b>Questions</b></legend>
            <div class="form-group question-group">
                <label for=" Question1">Question 1</label>
                <input type="text" name="" id="Question1" class="form-control" placeholder="Question 1" aria-describedby="Question1help">
                <small id="Question1help" class="text-muted">Input a Question</small>
                <ul>
                    <li>
                        <div class="form-group">
                            <label for="Option11">Option 1</label>
                            <input type="radio" name="question1" value="1">
                            <input type="text" name="" id="Option11" class="form-control" placeholder="Option 1" aria-describedby="Option1help1">
                            <small id="Option1help1" class="text-muted">Input an Option</small>
                    </li>
                    <li>
                        <div class="form-group">
                            <label for="Option21">Option 2</label>
                            <input type="radio" name="question1" value="2">
                            <input type="text" name="" id="Option21" class="form-control" placeholder="Option 2" aria-describedby="Option2help1">
                            <small id="Option2help1" class="text-muted">Input an Option</small>
                    </li>
                    <li>
                        <div class="form-group">
                            <label for="Option31">Option 3</label>
                            <input type="radio" name="question1" value="3">
                            <input type="text" name="" id="Option31" class="form-control" placeholder="Option 3" aria-describedby="Option3help1">
                            <small id="Option3help1" class="text-muted">Input an Option</small>
                    </li>
                    <li>
                        <div class="form-group">
                            <label for="Option41">Option 4</label>
                            <input type="radio" name="question1" value="4">
                            <input type="text" name="" id="Option41" class="form-control" placeholder="Option 4" aria-describedby="Option4help1">
                            <small id="Option4help1" class="text-muted">Input an Option</small>
                    </li>
                </ul>
            </div>
        </fieldset>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button class="btn btn-danger" id="remove">Remove this question</button>
            </div>
        </div>
    </div>
</div>
<div class="none" id="errormessage"></div>