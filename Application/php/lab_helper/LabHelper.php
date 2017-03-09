<?php

/**
 * Created by PhpStorm.
 * User: Lewis
 * Date: 09/03/2017
 * Time: 13:57
 */

require_once (dirname(__FILE__)."/../core/ConnectDB.php");

class LabHelper
{

    public function getAllLabHelpers()
    {
        $con = new ConnectDB();

        $allLabHelpers = mysqli_stmt_init($con->link);
        mysqli_stmt_prepare($allLabHelpers, "Select ud.firstname, ud.surname, ud.studentID FROM user_details AS  ud
                                              JOIN user_login AS ul ON ud.detailsId = ul.userID
                                              JOIN user_access AS ua ON ul.accessLevel = ua.access_id
                                              WHERE ua.access_name = 'lab helper'");
        mysqli_stmt_execute($allLabHelpers);
        $result = mysqli_stmt_get_result($allLabHelpers);

        $output_array = [];

        while($helper = $result->fetch_row())
            array_push($output_array, $helper);

        return $output_array;
        
    }
    
    public function getCourseLabHelpers($course)
    {
        
    }
    
    

}

$helper = new LabHelper();
print_r($helper->getAllLabHelpers());