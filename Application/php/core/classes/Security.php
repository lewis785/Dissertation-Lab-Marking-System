<?php

/**
 * Created by PhpStorm.
 * User: Lewis
 * Date: 06/03/2017
 * Time: 14:00
 */

require_once"ConnectDB.php";

class Security
{

    //Returns the access value of an access name
    public function getAccessValue($access_name)
    {
        $con = new ConnectDB();

        $get_access_level = mysqli_stmt_init($con->link);
        mysqli_stmt_prepare($get_access_level, "SELECT access_level FROM user_access WHERE access_name= ?");
        mysqli_stmt_bind_param($get_access_level, 's', $access_name);
        mysqli_stmt_execute($get_access_level);
        $result = mysqli_stmt_get_result($get_access_level);

        mysqli_close($con->link);
        ($result->num_rows === 0) ? $value = -1 : $value = $result->fetch_row()[0];
        return $value;
    }

    //Returns true if user has at least the required access level
    public function hasAccessLevel($access_name)
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();
        $required_access = $this->getAccessValue($access_name);           //Gets access value for required accessname
        return ($_SESSION["accesslevel"] >= $required_access && $required_access >= 0);              //Returns True if useraccess is greater or equal to required accesslevel
    }

    //Returns true if user has a greater access level than passed in
    public function hasGreaterAccessThan($access_name)
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();

        $required_access = $this->getAccessValue($access_name);          //Gets access value for required accessname
        return ($_SESSION["accesslevel"] > $required_access && $required_access >= 0);              //Returns True if useraccess is greater than required accesslevel
    }

    public function getAccessID($accessName)
    {
        $con = new ConnectDB();

        $get_access_level = mysqli_stmt_init($con->link);
        mysqli_stmt_prepare($get_access_level, "SELECT access_id FROM user_access WHERE access_name= ?");
        mysqli_stmt_bind_param($get_access_level, 's', $accessName);
        mysqli_stmt_execute($get_access_level);
        $result = mysqli_stmt_get_result($get_access_level)->fetch_row();

        mysqli_close($con->link);
        return $result[0];

    }

    public function accessNameFromID($accessID)
    {
        $con = new ConnectDB();

        $get_access_level = mysqli_stmt_init($con->link);
        mysqli_stmt_prepare($get_access_level, "SELECT access_name FROM user_access WHERE access_id= ?");
        mysqli_stmt_bind_param($get_access_level, 'i', $accessID);
        mysqli_stmt_execute($get_access_level);
        $result = mysqli_stmt_get_result($get_access_level)->fetch_row();

        mysqli_close($con->link);
        return $result[0];

    }


}