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
    <script src="../../js/admin/admin_panel.js"></script>


    <!--JavaScripts -->
    <script type="text/javascript">include_navbar("admin");</script>
    <script type="text/javascript">getAccessOptions();</script>
<!--    <script type="text/javascript">include_sidebar("sidebar_area");</script>-->


    <title>Admin Page</title>
</head>

<body>

<div id="navbar_area"></div>

<div class="container-fluid">
    <div class="row">

        <div class="col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2 main">
            <h1 class="page-header">Lab Management Table</h1>

            <div class="col-md-12" id="admin-panel">

                <button type="button" class="btn btn-default admin-panel-btn col-md-6 col-md-offset-3">Manage User</button>
                <button type="button" class="btn btn-default admin-panel-btn col-md-6 col-md-offset-3">Manage Database</button>

            </div>





            <form method="post" action="../../php/admin/adduser.php">
                <div class="form-group row">
                    <label for="firstname-label-input" class="col-2 col-form-label">Firstname</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" name="firstname" id="firstname-input">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="surname-label-input" class="col-2 col-form-label">Surname</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" name="surname" id="surname-input">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="matric-label-input" class="col-2 col-form-label">Matriculation Number</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="" name="matric" id="matric-input">
                    </div>
                </div>

                <div class="form-group">
                    <label for="sel1">Select list (select one):</label>
                    <select class="form-control access-selector" name="access" id="">
                        <option selected value="no-selection">Select Access Level</option>

                    </select>
                </div>

                <div class="form-group row">
                    <div class="col-10">
                        <input class="form-control" type="submit" value="Submit">
                    </div>
                </div>
            </form>






            <div class="col-lg-12">

            </div>


            <form class="form-horizontal" action="../../php/core/cvs_handling.php" method="post" name="upload_excel" enctype="multipart/form-data">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Form Name</legend>

                    <!-- File Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="filebutton">Select File</label>
                        <div class="col-md-4">
                            <input type="file" name="file" id="file" class="input-large">
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                        <div class="col-md-4">
                            <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                        </div>
                    </div>

                </fieldset>
            </form>




            <form class="form-horizontal" action="../../php/core/cvs_handling.php" method="post" name="upload_excel"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="submit" name="Export" class="btn btn-success" value="export to excel"/>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


</body>
</html>