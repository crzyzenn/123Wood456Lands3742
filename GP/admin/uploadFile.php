<?php
  require "buildAdmin.php";
  checkLoggedIn("Upload File");
?>

<?php
  //Uploading the .CSV file (Application from the UCAS)
  //load the database configuration file
  $enter = true;
  require '../connect.php';

  $enter = false;

  if(!empty($_GET['status'])){
      switch($_GET['status']){
          case 'succ':
              $statusMsgClass = 'alert-success';
              $statusMsg = 'Members data has been inserted successfully.';
              break;
          case 'err':
              $statusMsgClass = 'alert-danger';
              $statusMsg = 'Some problem occurred, please try again.';
              break;
          case 'invalid_file':
              $statusMsgClass = 'alert-danger';
              $statusMsg = 'Please upload a valid CSV file.';
              break;
          default:
              $statusMsgClass = '';
              $statusMsg = '';
      }
  }

  if (isset($_GET['objective'])) {
    if ($_GET['objective'] == 'verify') {
      # code...
      echo "<script>var a = confirm('Are you sure?'); if(a) window.location = 'uploadFile.php?id=".$_GET['id']."&objective=migrate&course_name=".$_GET['course_name']."'; else alert('You have cancelled');</script>";

    }

    //Migrating the data from the application to the students table
    else if ($_GET['objective'] == 'migrate') {
      # code...
      alert("Creating new student");

      //Getting the student's info
      $query = $connectSql->prepare("SELECT * FROM Application WHERE id = ?");
      $query->execute([$_GET['id']]);

      //Getting the course_id from the course table
      $getCourseId = $connectSql->query("SELECT id FROM course WHERE course_title = '".$_GET['course_name']."'");
      $course_id = 0;
      foreach ($getCourseId as $value) {
        $course_id = $value['id']; //Setting the course id
      }


      //Inserting the datat to the student table
      while ($a = $query->fetch()) {
        //Checking duplicates:
        $insert = $connectSql->prepare("INSERT INTO Student(id, gender, firstname, surname, dob, contact, email, course_id) VALUES (?,?,?,?,?,?,?,?)");
        $insert->execute([$a['case_id'], $a['gender'], $a['firstname'], $a['surname'], $a['dob'], $a['mobile_telephone'], $a['email'], $course_id]);
        if ($insert) {
          # code...
          alert("Successful");
        }
      }
    }
  }
?>


<div class="container custom">
    <?php if(!empty($statusMsg)){
        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
    } ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Student list
            <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Import applications</a>
        </div>
        <div class="panel-body">
            <form action="importData.php" method="post" enctype="multipart/form-data">
                <input type="file" class = "form-group" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
            </form>
            <p class = 'page-header lead'>Recent Applications<?php if(isset($_GET['type']) && $_GET['type'] == 1) echo ' (Unconditional)'; else if(isset($_GET['type']) && $_GET['type'] == 2) echo ' (Conditional)'?></p>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">Sort by
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="uploadFile.php?type=1">Unconditional</a></li>
                <li><a href="uploadFile.php?type=2">Conditional</a></li>
                <li><a href="uploadFile.php?type=3">Already created</a></li>
              </ul>
            </div>
            <br><br>
            <table class="table table-bordered myTable">
                <thead>
                    <tr>
                      <th>S.N</th>
                      <th>Case_ID</th>
                      <th>Title</th>
                      <th>Firstname</th>
                      <th>Surname</th>
                      <th>Gender</th>                      
                      <th>E-Mail</th>
                      <th>Recent gpa</th>
                      <th>Passed year</th>
                      <th>Board name</th>
                      <th>Exam number</th>
                      <th>UCI</th>
                      <th>Verification status</th>
                      <th>Course name</th>

                    </tr>
                </thead>
                <tbody>
                  <?php



                    /*
                    *Type - 1 = Conditional
                    *Type - 2 = Unconditional
                    */
                    if (isset($_GET['type'])) {
                      if ($_GET['type'] == 1) {
                        //To get the unconditional members
                        $query = $connectSql->prepare("SELECT * FROM Application WHERE title = '' OR gender = '' OR firstname = '' OR father_name = '' OR mother_name = '' OR dob = '' OR country = '' OR postal_code = '' OR home_telephone = '' OR mobile_telephone = '' OR email = '' OR recent_gpa = '' OR institute_name = '' OR passed_year = '' OR board_name = '' OR exam_number = '' OR uci = '' OR verification_status = ''");
                        $query->execute();

                        while ($row = $query->fetch()) {

                            # code...

                            echo "<tr>";
                             echo "<td>".$row['id']."</td>"; //SN
                              // <!-- Link to create a new case paper for that particular student -->
                              echo "<td><a href = 'case.php?id=".$row['id']."'>Create case paper</a></td>"; //CASE ID
                              echo "<td>".$row['title']."</td>"; //title
                              echo "<td>".$row['firstname']."</td>"; //Firstname
                              echo "<td>".$row['surname']."</td>"; //Surname
                              echo "<td>".$row['gender']."</td>"; //gender
                              echo "<td>".$row['email']."</td>"; //email
                              echo "<td>".$row['recent_gpa']."</td>"; //Recent gpa

                              echo "<td>".$row['passed_year']."</td>"; //Passed year
                              echo "<td>".$row['board_name']."</td>"; //Board name
                              echo "<td>".$row['exam_number']."</td>"; //Exam number
                              echo "<td>".$row['uci']."</td>"; //UCI
                              $dup = $connectSql->prepare('SELECT * FROM Student WHERE ID=?');
                              $dup->execute([$row['case_id']]);
                              $a = $dup->rowCount();
                              if ($a == 0) {
                                echo "<td><a href = 'uploadFile.php?id=".$row['id']."&objective=verify&course_name=".$row['course_name']."'>Verify</a></td>";
                              }
                              else {
                                echo "<td>Already added</td>";
                              }
                              echo "<td>".$row['course_name']."</td>"; //course_name
                            echo "</tr>";
                        }
                      }


                      else if ($_GET['type'] == 2) {

                        //To get the unconditional members
                        $query = $connectSql->prepare("SELECT * FROM Application WHERE title != '' AND gender != '' AND firstname != '' AND father_name != '' AND mother_name != '' AND dob != '' AND country != '' AND postal_code != '' AND home_telephone != '' AND mobile_telephone != '' AND email != '' AND recent_gpa != '' AND institute_name != '' AND passed_year != '' AND board_name != '' AND exam_number != '' AND uci != '' AND verification_status != ''");
                        $query->execute();

                        while ($row = $query->fetch()) {
                            echo "<tr>";
                             echo "<td>".$row['id']."</td>";
                              // <!-- Link to create a new case paper for that particular student -->
                              echo "<td><a href = 'case.php?id=".$row['id']."'>Create case paper</a></td>";
                              echo "<td>".$row['title']."</td>";
                              echo "<td>".$row['firstname']."</td>";
                              echo "<td>".$row['surname']."</td>";
                              echo "<td>".$row['gender']."</td>";

                              echo "<td>".$row['email']."</td>";
                              echo "<td>".$row['recent_gpa']."</td>";

                              echo "<td>".$row['passed_year']."</td>";
                              echo "<td>".$row['board_name']."</td>";
                              echo "<td>".$row['exam_number']."</td>";
                              echo "<td>".$row['uci']."</td>";
                              $dup = $connectSql->prepare("SELECT * FROM Student WHERE ID=?");
                              $dup->execute([$row['case_id']]);
                              $a = $dup->rowCount();
                              if ($a == 0) {
                                echo "<td><a href = 'uploadFile.php?id=".$row['id']."&objective=verify&course_name=".$row['course_name']."'>Verify</a></td>";
                              }
                              else {
                                echo "<td>Already added</td>";
                              }
                              echo "<td>".$row['course_name']."</td>";
                            echo "</tr>";
                        }
                      }

                      else if ($_GET['type'] == 3) {

                        //To get the unconditional members
                        $query = $connectSql->prepare("SELECT * FROM Application WHERE case_id != 0");
                        $query->execute();

                        while ($row = $query->fetch()) {
                            echo "<tr>";
                             echo "<td>".$row['id']."</td>";
                              // <!-- Link to create a new case paper for that particular student -->
                              echo "<td><a href = 'case.php?id=".$row['id']."'>Create case paper</a></td>";
                              echo "<td>".$row['title']."</td>";
                              echo "<td>".$row['firstname']."</td>";
                              echo "<td>".$row['surname']."</td>";
                              echo "<td>".$row['gender']."</td>";
                              echo "<td>".$row['email']."</td>";
                              echo "<td>".$row['recent_gpa']."</td>";

                              echo "<td>".$row['passed_year']."</td>";
                              echo "<td>".$row['board_name']."</td>";
                              echo "<td>".$row['exam_number']."</td>";
                              echo "<td>".$row['uci']."</td>";
                              $dup = $connectSql->prepare("SELECT * FROM Student WHERE ID=?");
                              $dup->execute([$row['case_id']]);
                              $a = $dup->rowCount();
                              if ($a == 0) {
                                echo "<td><a href = 'uploadFile.php?id=".$row['id']."&objective=verify&course_name=".$row['course_name']."'>Verify</a></td>";
                              }
                              else {
                                echo "<td>Already added</td>";
                              }
                              echo "<td>".$row['course_name']."</td>";
                            echo "</tr>";
                        }
                      }
                    }

                    //If the sort button is not used
                    else {
                      //To get the unconditional members
                      $query = $connectSql->prepare("SELECT * FROM Application");
                      $query->execute();

                      while ($row = $query->fetch()) {
                          echo "<tr>";
                           echo "<td>".$row['id']."</td>";
                            // <!-- Link to create a new case paper for that particular student -->
                            echo "<td><a href = 'case.php?id=".$row['id']."'>Create case paper</a></td>";
                            echo "<td>".$row['title']."</td>";
                            echo "<td><a title = 'Click for more details' href = 'moreDetails.php?id=".$row['id']."'>".$row['firstname']."</a></td>";
                            echo "<td>".$row['surname']."</td>";
                            echo "<td>".$row['gender']."</td>";

                            echo "<td>".$row['email']."</td>";
                            echo "<td>".$row['recent_gpa']."</td>";

                            echo "<td>".$row['passed_year']."</td>";
                            echo "<td>".$row['board_name']."</td>";
                            echo "<td>".$row['exam_number']."</td>";
                            echo "<td>".$row['uci']."</td>";
                            $dup = $connectSql->prepare("SELECT * FROM Student WHERE ID=?");
                            $dup->execute([$row['case_id']]);
                            $a = $dup->rowCount();
                            if ($a == 0) {
                              echo "<td><a href = 'uploadFile.php?id=".$row['id']."&objective=verify&course_name=".$row['course_name']."'>Verify</a></td>";
                            }
                            else {
                              echo "<td>Already added</td>";
                            }
                            echo "<td>".$row['course_name']."</td>";

                          echo "</tr>";
                      }
                    }
                  ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
