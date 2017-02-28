<?php
  session_start();


  function getHead($title){
    echo "<!DOCTYPE html>";
    echo "<html>";
    echo "<head>";
      echo '<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=10">
      <link rel="stylesheet" type = "text/css" href="../css/bootstrap6.css">
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
            <li class="active"><a href="#">Menu 1</a></li>
            <li><a href="#">Menu Item 2</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admission <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="uploadFile.php">Upload UCAS file</a></li>
                <li><a href="case.php">Case papers</a></li>
              </ul>
            </li>
            <li><a href="#">Menu Item 4</a></li>
            <li><a href="#">Reviews<span class="badge">20</span></a></li>
          </ul>
      </div>';
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

  // function selectAll($pdo, $field, $value){
  //   $query = 'SELECT * FROM '.$pdo.' WHERE '.$field.'='.$value;
  //   $pre = $pdo->prepare($query);
  //   $exec = $pre->execute();
  //   return $exec->fetch();
  // }

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
?>
