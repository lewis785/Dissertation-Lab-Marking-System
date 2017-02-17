

<?php include "../../php/core/verify.php"; ?>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Admin Terminal">
    <meta name="author" content="Lewis McNeill">

    <!--CSS Links -->
    <link href="../../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../../admincss/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="../../css/sidebar.css" rel="stylesheet">
    <link href="../../css/main.css" rel="stylesheet">

    <!--JS Links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.js"></script>
    <script src="../../js/admins.js"></script>
    <script src="../../js/navbar.js"></script>
    <script src="../../js/sidebar.js"></script>
    <script src="../../js/question_adding.js"></script>
    <script src="../../js/labs/lab_sidebar.js"></script>

    <!--JavaScripts -->
    <script type="text/javascript">include_navbar();</script>
<!--    <script type="text/javascript">include_sidebar("sidebar_area");</script>-->
    <script type="text/javascript">make_lab_layout("sidebar_area");</script>
    <script type="text/javascript">include_bottom_navbar();</script>

    <title>Home Page</title>
</head>

<body>

<div id="navbar_area"></div>

<div class="container-fluid">
    <div class="row">

        <div id="sidebar_area"></div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<!--            Main area top-->
            <div class="page-header col-md-12">
                <div class="form-group col-md-4 col-md-offset-1">
                    <label for="course-input" class="col-md-4 col-form-label">Course:</label>
                    <div class="col-md-8">
                        <select class="form-control " name="access" id="sel1">
                            <option selected value="no-selection">Select Access Level</option>
                            <?php include "../../php/labs/get_courses.php"; ?>
                        </select>
                    </div>
                </div>


                <div class="form-group col-md-4 col-md-offset-2 ">
                    <label for="labname-input" class="col-md-3 col-form-label">Lab Title</label>
                    <div class="col-md-9">
                        <input class="form-control" type="text" value="" name="lab-name" id="labname-input">
                    </div>
                </div>
            </div>






            <div class="col-lg-12" id="main-text-area">

            </div>
        </div>

    </div>
</div>

<footer class="panel-footer" id="bottom-nav-area" ></footer>

</body>
</html>