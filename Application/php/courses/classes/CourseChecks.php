<?php

/**
 * Created by PhpStorm.
 * User: Lewis
 * Date: 06/03/2017
 * Time: 14:12
 */
require_once(dirname(__FILE__) . "/../../core/classes/ConnectDB.php");
require_once "Courses.php";

class CourseChecks extends Courses
{

    //Returns true if user is a lecturer of the course
    public function isLecturerOfCourse($course)
    {
        if ($this->hasAccessLevel("admin"))
            return true;
        else if($this->hasAccessLevel("lecturer")) {
            $con = new ConnectDB();

            $check_if_course_lecturer = mysqli_stmt_init($con->link);
            mysqli_stmt_prepare($check_if_course_lecturer, "SELECT count(*) FROM user_login AS l
                                              JOIN course_lecturer AS cl ON l.userID = cl.lecturer 
                                              JOIN courses AS c ON cl.course = c.courseID 
                                              WHERE l.username = ? AND c.courseName = ?");
            mysqli_stmt_bind_param($check_if_course_lecturer, 'ss', $_SESSION["username"], $course);
            mysqli_stmt_execute($check_if_course_lecturer);
            $result = mysqli_stmt_get_result($check_if_course_lecturer);
            $lecturerCount = $result->fetch_row();

            mysqli_close($con->link);

            return $lecturerCount[0] === 1;
        }
        else
            return false;
    }


    //Returns true if user is a lab helper of the course
    public function isLabHelperOfCourse($course)
    {
        $con = new ConnectDB();

        $check_if_lab_helper = mysqli_stmt_init($con->link);                                             //Init prepared statement
        mysqli_stmt_prepare($check_if_lab_helper, "SELECT count(*) FROM lab_helpers AS lh
                                                  JOIN courses AS c ON c.courseID = lh.course 
                                                  JOIN user_login AS ul ON lh.userRef = ul.userID 
                                                  WHERE ul.username = ? AND c.courseName = ?");
        mysqli_stmt_bind_param($check_if_lab_helper, 'ss', $_SESSION["username"], $course);         //Provides session and course as inputs for query
        mysqli_stmt_execute($check_if_lab_helper);                                                  //Executes the prepared statement
        $result = mysqli_stmt_get_result($check_if_lab_helper);                                     //Get Results of Query
        $helperCount = $result->fetch_row();                                                        //Fetches first row of result

        mysqli_close($con->link);
        return $helperCount[0] === 1;                                                               //Returns true if count equals 1
    }


    //Checks if user is allowed to mark course returns true if they are
    public function canMarkCourse($course)
    {
        if($this->hasAccessLevel("admin"))
            return true;

        if ($this->hasAccessLevel("lecturer")) {                                                  //Checks if user is a lecturer
            return $this->isLecturerOfCourse($course);                                           //Returns true if user is lecturer of specified course
        } elseif ($this->hasAccessLevel("lab helper")) {                                          //Checks if user is a lab helper
            return $this->isLabHelperOfCourse($course);                                          //Returns true if user is lab helper of specified course
        }
    }

}
