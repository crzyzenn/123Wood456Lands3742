<?php
  session_start();


  function getHead($title, $type = null){

    //Page for course leaderes
    if ($type == "leader") {
      echo "<!DOCTYPE html>";
      echo "<html>";
      echo "<head>";
        echo '<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=10">
        <link rel="stylesheet" type = "text/css" href="css/bs1.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>';
      echo "</head>";
      echo "<title>";
        echo $title;
      echo "</title>";
      echo "<body>";
      echo '<!--University logo image-->
        <a href = "index.php"><img src="images/logo.png" id = "headerImage" width = 100px></a>
        <h3 class = "text-justify">Woodlands University & College</h3>

        <div class="container headSpace">';

        if (isset($_SESSION['name'])) {


          echo '<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li><a href = "#" >'.$_SESSION["name"].'</a></li>
                    </ul>
                    <form class = "form-inline pull-right" action = "userPage.php?action=logout" method = "POST">
                      <input type = "submit" class = "btn btn-success" name = "logout" value = "Logout">
                    </form>
                </div>
            </div>
        </nav>';
        echo '
        <div class="col-xs-2 pull-left">
            <ul class="nav nav-stacked adjust">
              <li><a href="studentView.php">Student</a></li>

              <li class = "dropdown">
                <a href="" class = "dropdown-toggle" data-toggle = "dropdown">Course <b class = "caret"></b></a>
                <ul class = "dropdown-menu">
                  <li><a href = "addCourse.php">Add course</a></li>
                  <li><a href = "viewCourse.php">View courses</a></li>
                </ul>
              </li>

              <li class = "dropdown">
                <a href="" class = "dropdown-toggle" data-toggle = "dropdown">Module <b class = "caret"></b></a>
                <ul class = "dropdown-menu">
                  <li><a href = "addModule.php">Add module</a></li>
                </ul>
              </li>

              <li class = "dropdown">
                <a href="" class = "dropdown-toggle" data-toggle = "dropdown">PAT <b class = "caret"></b></a>
                <ul class = "dropdown-menu">
                  <li><a href = "addModule.php">Add module</a></li>
                </ul>
              </li>

              <li class = "dropdown">
                <a href="" class = "dropdown-toggle" data-toggle = "dropdown">Time-table <b class = "caret"></b></a>
                <ul class = "dropdown-menu">
                  <li><a href = "addModule.php">Add module</a></li>
                </ul>
              </li>

              <li class = "dropdown">
                <a href="" class = "dropdown-toggle" data-toggle = "dropdown">Diary <b class = "caret"></b></a>
                <ul class = "dropdown-menu">
                  <li><a href = "addModule.php">Add module</a></li>
                </ul>
              </li>

              <li class = "dropdown">
                <a href="" class = "dropdown-toggle" data-toggle = "dropdown">Report Generation <b class = "caret"></b></a>
                <ul class = "dropdown-menu">
                  <li><a href = "studentView.php">Enter grades</a></li>
                </ul>
              </li>

              <li class = "dropdown">
                <a href="" class = "dropdown-toggle" data-toggle = "dropdown">Attendance records <b class = "caret"></b></a>
                <ul class = "dropdown-menu">
                  <li><a href = "addModule.php">Add module</a></li>
                </ul>
              </li>

              <li class = "dropdown">
                <a href="" class = "dropdown-toggle" data-toggle = "dropdown">Assignments <b class = "caret"></b></a>
                <ul class = "dropdown-menu">
                  <li><a href = "addModule.php">Add module</a></li>
                </ul>
              </li>

              <li class = "dropdown">
                <a href="" class = "dropdown-toggle" data-toggle = "dropdown">Module <b class = "caret"></b></a>
                <ul class = "dropdown-menu">
                  <li><a href = "addModule.php">Add module</a></li>
                </ul>
              </li>

            </ul>
        </div>';
        // <li><a href="#">Menu Item 4</a></li>
        // <li><a href="#">Reviews<span class="badge">20</span></a></li>
      }
    }

    //For admins
    else {
      echo "<!DOCTYPE html>";
      echo "<html>";
      echo "<head>";
        echo '<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=10">
        <link rel="stylesheet" type = "text/css" href="../css/bs1.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="../js/script.js"></script>';
      echo "</head>";
      echo "<title>";
        echo $title;
      echo "</title>";
      echo "<body>";
      echo '<!--University logo image-->
        <a href = "index.php"><img src="../images/logo.png" id = "headerImage" width = 100px></a>
        <h3 class = "text-justify">Woodlands University & College - Admin</h3>

        <div class="container headSpace">';

        if (isset($_SESSION['name'])) {
          # code...

          echo '<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li><a href = "#" >'.$_SESSION["name"].'</a></li>
                    </ul>
                    <form class = "form-inline pull-right" action = "admission.php" method = "POST">
                      <input type = "submit" class = "btn btn-success" name = "logout" value = "Logout">
                    </form>
                </div>
            </div>
        </nav>';
        echo '
        <div class="col-xs-2 pull-left">
            <ul class="nav nav-stacked adjust">
              <li class="dropdown">
                <a href = "" class="dropdown-toggle" data-toggle="dropdown">Admission <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="uploadFile.php">Upload UCAS file</a></li>
                  <li><a href="case.php">Case papers</a></li>
                </ul>
              </li>
              <li><a href="studentView.php">Student</a></li>


              <li><a href="#">Student records</a></li>
              <li><a href="#">Staff records</a></li>

            </ul>
        </div>';
      }
    }
  }


  /*
  $pdo = sql variable to run query on
  $table = name of the table to run the query in
  $field = name of the fields required
  $extra = extra names of the fieldset
  $value = field values for where clause
  $login = to ensure whether the function has to check login process
  */

  function runSelect($pdo, $table, $field, $extra, $value, $login = false){
    if ($extra == '')
      $queryString = 'select '.implode(",",$field)." from ".$table." where ";

    else
      $queryString = 'select '.implode(",", $extra).",".implode(",",$field)." from ".$table." where ";


    //Getting the query right
    for ($i=0; $i < sizeof($field); $i++) {
      if (($i + 1) < sizeof($field)) {
        $queryString .= $field[$i].'='."'".$value[$i]."'".' AND ';
      }
      else {
        $queryString .= $field[$i].'='."'".$value[$i]."'";
      }
    }

    //Executing the query
    $runQuery = $pdo->prepare($queryString);
    $runQuery->execute();

    //Checking user credentials
    if ($login == true) {
      while ($value = $runQuery->fetch()) {
        if ($_POST['id'] == $value['username'] && $_POST['password'] == $value['password']) {
          header("refresh:0;url=admission.php");
          $_SESSION['login'] = 'admin';
          $_SESSION['name'] = $value['firstname']." ".$value['lastname'];
        }
        else {
          alert("Login failed!");
        }
      }
    }

    return $runQuery->fetch();
  }

  function selectAll($pdo, $table, $field, $value){
    if ($field == "" AND $value == "") {
        $query = 'SELECT * FROM '.$table;
    }
    else {
      $query = 'SELECT * FROM '.$table.' WHERE '.$field.'='.$value;
    }
    $pre = $pdo->query($query);

    return $pre;
  }

  function runUpdate($pdo, $table, $field, $value, $constraint, $constraintValue){
    $query = 'UPDATE '.$table.' SET '.$field.'="'.$value.'" WHERE '.$constraint.'="'.$constraintValue.'"';
    $runQuery = $pdo->prepare($query);
    $a = $runQuery->execute();
    return $a;
  }

  function alert($message){
    echo "<script>alert('$message');</script>";
  }

  function checkLoggedIn($head){
    if ($_SESSION['login'] != 'admin') {
      # code...
      alert("Login to continue");
      header("refresh:0;url=index.php");
    }
    else {
      # code...
      getHead("Woodlands: $head");
    }

    //Logout
    if (isset($_POST['logout'])) {
      # code...
      $_SESSION['login'] = '';
      unset($_SESSION['name']);
      unset($_SESSION['changedValue']);
      header("refresh:0;url=index.php");
    }
  }

  function space($number){
    for($i = 0; $i < $number; $i++){
      echo "<br>";
    }
  }

  function direct($url){
    header("refresh:0;url=".$url."");
  }

?>
