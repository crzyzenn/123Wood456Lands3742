<?php
  require "buildAdmin.php";
  require '../connect.php';
  $res = "";
  $success = false;
  $sent = false;

  //Checking if the admin is logged in
  checkLoggedIn("Create case paper");
  if (!isset($_GET['submit']) && !isset($_GET['applyEdit'])) {

    // To generate the unique id for each new student
    //Viewing the maximum valued case_id field from the Application table - Check if a case number exists
    $result = $connectSql->query("SELECT MAX(case_id)case_id FROM Application");

    //Getting the results from the query
    foreach ($result as $value) {

      /* If not any case_id has been set from the table, then setting the first case_id
      * If case_id is available, selects the max case_id and adds it by 1 and adds it as the new id
      */
      //Generating a new id

      if ($_GET['id'] == 1) {
        $a = runUpdate($connectSql, 'Application', 'case_id', '16400001', 'id', '1');
      }

      else{
        //Selecting the case_id column from the Application table of that particular student
        $a = runSelect($connectSql, 'Application', ['id'], ['case_id'], [$_GET['id']], $login = false);

        if ($a['case_id'] == 0) {
          alert("Creating a new id");
          $new_id = $value['case_id'] + 1;
          runUpdate($connectSql, 'Application', 'case_id', $new_id, 'id', $_GET['id']);
        }
      }
    }
  }

  //If the edit value is submitted - For condtional form
  if (isset($_GET['submit'])) {
     $_SESSION['changedValue'] = $_GET['template'];
     $success = true;
  }

  //For unconditonal form
  ///To get the changes applied - edit form data
  if (isset($_GET['applyEdit'])) {

     $_SESSION['changed'] = $_GET['template'];
  }

  //When missing documents are set
  if (isset($_GET['missing'])) {
    if (isset($_GET['applyEdit'])) {
      # code...
      alert("Gone to apply");
       $_SESSION['changed'] = $_GET['template'];
    }
    else {
      # code...
      $_SESSION['changed'] = $_GET['template'];
    }

     $success = true;
  }


  /*Print feature
  *When the print button is clicked
  *unsets the edited values and moves to the default one
  */
  if (isset($_POST['print'])) {
    $sent = true;
    unset($_SESSION['changed']);
    unset($_SESSION['changedValue']);
  }

?>

<div class = 'container default'>
  <div class="panel panel-default">
    <ul class="nav nav-tabs height">
      <li class="active"><a data-toggle="tab" href="#home">Conditional letter</a></li>
      <li><a data-toggle="tab" href="#faq">Un-Conditional letter</a></li>
    </ul>

    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
        <div class="form-group">
            <p class = "page-item">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">View template</button>
              <button type="submit" class="btn btn-primary" onclick="printThis('conditional');"><span class = 'glyphicon glyphicon-print'></span> Print</button>

              <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h3 class="modal-title lead">Letter template</h3>
                    </div>
                    <div class="modal-body">
                      <ul class="nav nav-tabs adjust">
                        <li class="active"><a data-toggle="tab" href="#view">View</a></li>
                        <li><a data-toggle="tab" href="#edit">Edit</a></li>
                      </ul>
                      <div class="tab-content">
                        <div id = "view" class="tab-pane fade in active">
                          <?php
                            if (isset($_SESSION['changedValue'])) {
                                  echo $_SESSION['changedValue'];
                            }

                            else {
                                  echo '<p class = "text-justify">';
                                  $let = $connectSql->prepare("SELECT firstname, surname, country, case_id FROM Application WHERE id=?");
                                  $let->execute([$_GET['id']]);
                                  while ($a = $let->fetch()) {
                                    # code...
                                    $res =  $a['firstname']." ".$a['surname']."<br>";
                                    $res .= $a['country']."<br>";
                                    $res .=  "U.I.D = ".$a['case_id']."<br><br>";
                                    $res .=  "Dear ".$a['firstname'].",<br>";
                                    $res .= "<br>
                                    We are pleased to inform you that you have been offered a spot in the class of 2017 for the university of Woodlands.<br>
                                    After receiving your application and all the supporting documents, we have determined that you are exactly the kind of student that we are looking for.
                                    Attached to this letter you will find a full admissions package, along with specific information on how to accept this offer.<br>
                                    We ask that you respond within 4 weeks of time as well as appear in the welcome week with the necessary documents and qualifications.
                                    <br><br>
                                    Once again, congratulations. We hope to hear from you soon!<br><br>
                                    Sincerely,<br>
                                    University of Woodlands Admissions</p>";

                                    echo $res;
                                  }
                              }
                            ?>


                        </div>

                        <div id="edit" class="tab-pane fade in">
                          <form class="form-group" action="case.php?id=<?php if(isset($_GET['id'])) echo $_GET['id'];?>" method="GET">
                            <div class="form-group">
                              <?php
                                if (isset($_SESSION['changedValue'])) {
                                  # code...
                                  echo '<textarea name="template" rows="17" cols="80">'.$_SESSION['changedValue'].'</textarea>';
                                }
                                else {
                                  # code...
                                  echo '<textarea name="template" rows="8" cols="80">'.$res.'</textarea>';
                                }

                              ?>
                              <input type="submit" class = "btn btn-primary" name="submit" value="Apply">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
                    </div>
                  </div>

                </div>
              </div>

          </div>
      </div>

      <div id="faq" class="tab-pane fade in">
        <p class = "page-item">
          <form class="form-group" action="case.php?id=1" method="POST">
            <div class = 'form-group'>
              <label class = "control-label" for="missing">Report missing: </label>
              <input type="text" class = "" name="miss" value="">
              <input type="submit" class = "btn btn-primary" name="missing" value="Submit">
              <button type="submit" class="btn btn-primary" onclick="printThis('Unconditional');"><span class = 'glyphicon glyphicon-print'></span> Print</button>
            </div>
          </form>
          <div class="form-group">
              <p class = "page-item">
                <button type="button" class="btn btn-info btn-primary" data-toggle="modal" data-target="#my">View template</button>

                <!-- Modal -->
                <div class="modal fade" id="my" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title lead">Letter template</h3>
                      </div>
                      <div class="modal-body">
                        <ul class="nav nav-tabs adjust">
                          <li class="active"><a data-toggle="tab" href="#viewUnconditional">View</a></li>
                          <li><a data-toggle="tab" href="#editing">Edit</a></li>
                        </ul>
                        <div class="tab-content">
                          <div id = "viewUnconditional" class="tab-pane fade in active">
                            <?php
                              if (isset($_SESSION['changed'])) {
                                    echo $_SESSION['changed'];
                              }

                              else {
                                echo '<p class = "text-justify">';
                                $let = $connectSql->prepare("SELECT firstname, surname, case_id, country FROM Application WHERE id=?");
                                $let->execute([$_GET['id']]);
                                while ($a = $let->fetch()) {
                                  # code...
                                  $res =  $a['firstname']." ".$a['surname']."<br>";
                                  $res .= $a['country']."<br>";
                                  $res .=  "U.I.D =".$a['case_id']."<br><br>";
                                  $res .=  "Dear ".$a['firstname'].",<br>";
                                  $res .= "<br>After receiving your application and all the supporting documents, we have found out that some of the documents are missing out. These would be:";

                                  if (isset($_POST['missing'])) {
                                    $res .= "<br>".$_POST['miss']."<br><br>";
                                  }

                                  $res .= "<br>We ask that you respond to this letter as soon as possible and send us a proper complete application. We hope to hear from you soon! </p>";
                                  echo $res;

                                }
                              }
                              ?>
                          </div>

                          <div id="editing" class="tab-pane fade in">
                            <form class="form-group" action="case.php?id=1" method="GET">
                              <div class="form-group">
                                <?php
                                  if (isset($_SESSION['changed'])) {
                                    # code...
                                    echo '<textarea name="template" rows="17" cols="80">'.$_SESSION['changed'].'</textarea>';
                                  }
                                  else {

                                    echo '<textarea name="template" rows="8" cols="80">'.$res.'</textarea>';
                                  }

                                ?>
                                <input type="submit" class = "btn btn-primary" name="applyEdit" value="Apply">
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
                      </div>
                    </div>

                  </div>
                </div>

            </div>

      </div>

    </div>


    <?php
      // When the changes has been applied - Edit
      if ($success) {
        # code...
        echo '<div class="panel-group">';
          echo '<div class="panel panel-success">';
            echo '<div class="panel-heading">';
              echo 'Success!';
            echo '</div>';
            echo '<div class="panel-body">';
              echo 'View template again to see the changes.';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      }

      // When the email has been sent
      else if ($sent) {
        # code...
        echo '<div class="panel-group">';
          echo '<div class="panel panel-success">';
            echo '<div class="panel-heading">';
              echo 'Success!';
            echo '</div>';
            echo '<div class="panel-body">';
              echo 'The letter has been sent';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      }

    ?>



  </div>
</div>
