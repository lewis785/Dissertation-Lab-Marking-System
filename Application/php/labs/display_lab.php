<?php
/**
 * Created by PhpStorm.
 * User: Lewis
 * Date: 19/02/2017
 * Time: 00:33
 */
include(dirname(__FILE__)."/../core/connection.php");
include 'already_exists.php';
include 'get_course_id.php';


if(isset($_POST['lab']) && isset($_POST['course']))
{
    $courseID = get_course_id($_POST['course']);
    $labName = $_POST['lab'];

    if(lab_already_exists($courseID,$labName))
    {
        $link = $GLOBALS["link"];
        $retrieveQuestionsQuery = 'select lq.questionNumber, qt.typeName, lq.question, lq.minMark, lq.maxMark from lab_questions as lq
                              join question_types as qt on lq.questionType = qt.questionTypeID
                              join labs on lq.labRef = labs.labID
                              where labs.labName = ? and courseRef = ? 
                              order by lq.questionNumber';
        $retrieveQuestions = mysqli_stmt_init($link);
        mysqli_stmt_prepare($retrieveQuestions, $retrieveQuestionsQuery);
        mysqli_stmt_bind_param($retrieveQuestions, 'si',$labName, $courseID);
        mysqli_stmt_execute($retrieveQuestions);
        $result = mysqli_stmt_get_result($retrieveQuestions);

        $outputHtml = "";
        while ($question = $result->fetch_row()) {
            $outputHtml = $outputHtml . display_question($question);
        }
        echo json_encode(array('html'=>$outputHtml."</div>"));
    }
}
mysqli_close($link);


function display_question($question)
{
    $html = question_start($question);
    switch ($question[1]) {                                       //Case statement checking what type each question is
        case "boolean":                                 //Inserts boolean type questions
            $html = $html . question_boolean();
            break;
        case "scale":                                   //Inserts scale type questions
            $html = $html . question_scale($question[3], $question[4]);
            break;
        case "value":                                   //Inserts value type questions

            break;
        default:
            echo "default";                             //Default if type doesn't exist
    }

    return $html."</div>";
}


function question_start($question){
    $data = '<div class="col-sm-6 col-sm-offset-3 col-mid-8 col-md-offset-2 tile"  id="question-'. $question[0] .'">
                <div class="col-md-5 col-md-offset-1"><label for="sel1">Question Number: <div id="question-number">'.$question[0].'</div></label></div>
                <input type="hidden" name="type[]" value="boolean">
                <div class="form-group row">
                    <label for="question-label-input" class="col-md-12 col-md-offset-1 col-form-label">'.$question[2].'</label>
                </div>';
    return $data;
}

function question_scale($start, $end)
{
    $scale = '<div class="form-group col-md-4 col-md-offset-4">
                <label for="sel1">Select Mark (select one):</label>
                <select class="form-control" name="mark[]" id="sel1">
                <option selected value="no-selection">Select Value</option>';
    for($i = $start; $i<=$end; $i++)
    {
        $scale .= '<option value="'.$i.'">'.$i.'</option>';
    }
    return  $scale.'</select></div>';
}

function question_boolean()
{
    return '<div class="radio">
                <label><input type="checkbox" name="mark[]"></label>
            </div>';
}




