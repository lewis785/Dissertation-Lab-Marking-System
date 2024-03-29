<?php

/**
 * Created by PhpStorm.
 * User: Lewis
 * Date: 07/03/2017
 * Time: 13:22
 */

require_once(dirname(__FILE__) . "/../../core/classes/ConnectDB.php");
require_once(dirname(__FILE__) . "/../../labs/classes/Lab.php");
require_once "LabStats.php";


class LecturerResults extends LabStats
{


    private $lab;

    function __construct()
    {
        $this->lab = new Lab();
    }

    public function displayLabResults()
    {
        $con = new ConnectDB();

        $courses = $this->lab->getCourses();
        $resultsTable = "";

        $id = 0;
        foreach ($courses as $course) {
            $labs = $this->lab->getLabs($course);
            $students = $this->lab->getStudents($course);
            $studentSelector = $this->create_student_selector($students, $course);

            $resultsTable .= "<div class='col-md-12 results-course-row'><div class='col-md-6 col-md-offset-3'>$course</div></div><ul class='labs-list'>";


            if(sizeof($labs)>0) {
                foreach ($labs as $lab) {
                    $resultsTable .= $this->get_lab_summary($con->link, $course, $lab[0], $id);

                    $statsArea = "<div id='stats-area' class='col-md-12'></div>";
                    $studentArea = "<div class='col-md-8 col-sm-12 col-xs-12' id='student-info'>
                                <div class='col-md-12' id='student-name'>No Student Selected</div>
                                <div class='col-md-12' id='student-stats'>
                                    <div class='col-md-6' id='stats-mark'></div>
                                    <div class='col-md-6' id='stats-percentage'></div>
                                </div>
                                <div class='col-md-12 col-sm-12 col-xs-12' id='student-answers'></div>
                             </div>";

                    $id++;
                    $resultsTable .= $statsArea . $studentSelector . $studentArea . "</li>";
                }
            }
            else{
                $resultsTable .= "<li class='col-md-12 results-lab-row' id='result-row-$id' '>
                                    <div class='result-align-center result-summary col-md-12 col-sm-12 col-xs-12'>
                                        No Lab Exists For Course
                                    </div>
                                   </li>";
            }
                $resultsTable .= "</ul>";



        }
        mysqli_close($con->link);
        return $resultsTable;
    }




    private function create_student_selector($studentArray, $course){

        $selector = "<div class='col-md-4'><label>Student select list:</label>
                   <select class='col-md-12 student-selector form-control' size='8' multiple onchange='display_student_result(this, \"$course\", this.value)'>
                   <option selected value='no-selection'>No Student</option>";
        while ($student = $studentArray->fetch_row())
        {
            $selector.="<option value='$student[2]'>$student[0] $student[1]</option>";
        }
        $selector .= "</select></div>";
        return $selector;
    }



    private function get_lab_summary($link, $course, $lab, $id)
    {
        $stats = $this->get_lab_stat($link, $course, $lab);

        $output ="<li class='col-md-12 results-lab-row' id='result-row-$id' '>
                            <div class='result-align-center result-summary col-md-12'>
                                <div id='result-row-arrow-$id' class='result-align-center col-md-1 col-sm-1 col-xs-1  glyphicon glyphicon-triangle-right'></div>
                                <span class='col-md-2 col-sm-6 col-xs-10 '>Lab Name: <span id='lab-name'>$lab</span></span>
                                <span class='col-md-3 col-sm-5'>Students Marked: $stats[2] / $stats[3]</span>
                                <span class='col-md-3 '>Marked Average: $stats[0]</span>
                                <span class='col-md-3 '>Overall Average: $stats[1]</span>

                            </div>";

        return $output;
    }

}

//$result = new LecturerResults();
//echo ($result->displayLabResults());