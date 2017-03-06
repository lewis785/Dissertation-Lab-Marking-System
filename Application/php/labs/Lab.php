<?php

/**
 * Created by PhpStorm.
 * User: Lewis
 * Date: 06/03/2017
 * Time: 17:54
 */

require_once (dirname(__FILE__)."/../core/ConnectDB.php");

class Lab
{
    function lab_total_mark($courseName, $labName)
    {
        $con = new ConnectDB();

        $labTotalMark = mysqli_stmt_init($con->link);
        mysqli_stmt_prepare($labTotalMark, "SELECT SUM(maxMark) FROM lab_questions as lq 
                                        JOIN labs AS l ON lq.labRef = l.labID
                                        JOIN courses AS c ON l.courseRef = c.courseID
                                        WHERE c.courseName = ? AND l.labName = ? ");
        mysqli_stmt_bind_param($labTotalMark, "ss", $courseName, $labName);

        if(mysqli_stmt_execute($labTotalMark))
        {
            $result = mysqli_stmt_get_result($labTotalMark)->fetch_row();
            mysqli_close($con->link);
            return ($result[0]);
        }
        mysqli_close($con->link);
        return -1;
    }

}