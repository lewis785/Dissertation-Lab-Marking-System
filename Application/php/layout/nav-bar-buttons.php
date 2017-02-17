
<?php
include(dirname(__FILE__)."/../core/connection.php");
include(dirname(__FILE__)."/../core/check_access_level.php");

$nav_bar_content = '<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li id="profilebtn"><a href="#">Profile</a></li>
                            <li><a href="#">something</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li id="signoutbtn"><a href="../../php/core/signout.php">Signout</a></li>
                        </ul>
                    </li>
                    <li class="active"><a href="home.php" >Home</a></li>';




if(get_access_value($link,"lecturer") <= $_SESSION["accesslevel"])
{
    $nav_bar_content = '<li><a href="*"> Marking Section </a></li>' . $nav_bar_content;

    $nav_bar_content =    '<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Labs<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Lab Results</a></li>
                                <li><a href="#">List of Labs</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="labmaker.php">Make Lab</a></li>
                                <li><a href="#">Edit Lab</a></li>


                                <li id="signoutbtn"><a href="../../php/core/signout.php">Signout</a></li>
                            </ul>
                        </li>'. $nav_bar_content;

    if(get_access_value($link,"admin") <= $_SESSION["accesslevel"])
    {
    $nav_bar_content = '<li><a href="admin.php"> Admin Section </a></li>' . $nav_bar_content;
    }

}



echo $nav_bar_content;



mysqli_close($link);