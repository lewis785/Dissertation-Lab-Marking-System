<?php

/**
 * Created by PhpStorm.
 * User: Lewis
 * Date: 06/03/2017
 * Time: 13:50
 */

require_once(dirname(__FILE__) . "/../../core/classes/ConnectDB.php");
require_once(dirname(__FILE__) . "/../../core/classes/Security.php");

class Courses extends Security
{

    public function getCourseId($course)
    {
        $con = new ConnectDB();

        $getCourseIDQuery = 'SELECT courseID FROM courses WHERE courseName = ?';
        $getCourseID = mysqli_stmt_init($con->link);
        mysqli_stmt_prepare($getCourseID, $getCourseIDQuery);
        mysqli_stmt_bind_param($getCourseID, 's',$course);
        mysqli_stmt_execute($getCourseID);
        $result = mysqli_stmt_get_result($getCourseID)->fetch_row();

        mysqli_close($con->link);
        return $result[0];
    }

    public function getCourses()
    {
        $con = new ConnectDB();

        $get_courses = mysqli_stmt_init($con->link);


        if ($this->hasGreaterAccessThan("lecturer"))
        {
            mysqli_stmt_prepare($get_courses, "SELECT courseName FROM courses");
        }
        elseif ($this->hasAccessLevel( "lecturer")) {

            mysqli_stmt_prepare($get_courses, "SELECT c.courseName FROM user_login as l
                                              JOIN course_lecturer AS cl ON l.userID = cl.lecturer 
                                              JOIN courses AS c ON cl.course = c.courseID 
                                              WHERE l.username = ?  ORDER BY courseName");
            mysqli_stmt_bind_param($get_courses, 's', $_SESSION["username"]);


        } elseif ($this->hasAccessLevel("lab helper")) {

            mysqli_stmt_prepare($get_courses, "SELECT c.courseName FROM lab_helpers AS lh 
                                        JOIN user_login AS ul ON lh.userRef = ul.userID 
                                        JOIN courses AS c ON lh.course = c.courseID 
                                        WHERE username = ?  ORDER BY courseName");
            mysqli_stmt_bind_param($get_courses, 's', $_SESSION["username"]);
        }
        else
            return [];

        mysqli_stmt_execute($get_courses);
        $result = mysqli_stmt_get_result($get_courses);

        $outputArray = [];
        while($course = $result->fetch_row())
            array_push($outputArray, $course[0]);

        mysqli_close($con->link);
        return $outputArray;
    }

    public function courseFromLabID($labID)
    {
        $con = new ConnectDB();

        $courseFromLabID = 'SELECT c.courseName FROM labs AS l
                        JOIN courses AS c ON l.courseRef = c.courseID
                        WHERE l.labID = ?';                //Query gets course name from lab id
        $getLabID = mysqli_stmt_init($con->link);                                    //Init Prepared Statement
        mysqli_stmt_prepare($getLabID, $courseFromLabID);
        mysqli_stmt_bind_param($getLabID, 'i',$labID);                  //Bind course and lab variables
        mysqli_stmt_execute($getLabID);                                         //Execute Prepared Statement
        $result = mysqli_stmt_get_result($getLabID)->fetch_row();               //Get Result

        mysqli_close($con->link);
        return $result[0];
    }

}