<?php
  require "buildAdmin.php";
  require '../connect.php';
  checkLoggedIn("More details");
?>

<div class="container fullWidth">
  <div class="panel panel-default">
    <div class="panel panel-heading">
      <p>More details - Student ID <?php echo $_GET['id'] ?> </p>
    </div>

    <div class="panel panel-body">

      <table class="table table-bordered myTable">
          <thead>
              <tr>
                <th>S.N</th>
                <th>Case_ID</th>
                <th>Title</th>
                <th>Firstname</th>
                <th>Surname</th>
                <th>Gender</th>
                <th>Father's name</th>
                <th>Mother's name</th>
                <th>Date of birth</th>
                <th>Country</th>
                <th>Postal code</th>
                <th>Home telephone</th>
                <th>Mobile telephone</th>
                <th>E-Mail</th>
                <th>Recent gpa</th>
                <th>Institute name</th>
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
        $getAll = $connectSql->prepare("SELECT * FROM Application WHERE id = ?");
        $getAll->execute([$_GET['id']]);
        echo "<tr>";
        while ($result = $getAll->fetch()) {
          echo "<td>".$result['id']."</td>"; //SN

          echo "<td><a href = 'case.php?id=".$result['id']."'>Create case paper</a></td>"; //CASE ID
          echo "<td>".$result['title']."</td>"; //title
          echo "<td>".$result['firstname']."</td>"; //Firstname
          echo "<td>".$result['surname']."</td>"; //Surname
          echo "<td>".$result['gender']."</td>"; //gender

          echo "<td>".$result['father_name']."</td>";
          echo "<td>".$result['mother_name']."</td>";
          echo "<td>".$result['dob']."</td>";
          echo "<td>".$result['country']."</td>";
          echo "<td>".$result['postal_code']."</td>";
          echo "<td>".$result['home_telephone']."</td>";
          echo "<td>".$result['mobile_telephone']."</td>";


          echo "<td>".$result['email']."</td>"; //email
          echo "<td>".$result['recent_gpa']."</td>"; //Recent gpa
          echo "<td>".$result['institute_name']."</td>"; //Recent gpa

          echo "<td>".$result['passed_year']."</td>"; //Passed year
          echo "<td>".$result['board_name']."</td>"; //Board name
          echo "<td>".$result['exam_number']."</td>"; //Exam number
          echo "<td>".$result['uci']."</td>"; //UCI
          $dup = $connectSql->prepare('SELECT * FROM Student WHERE ID=?');
          $dup->execute([$result['case_id']]);
          $a = $dup->rowCount();
          if ($a == 0) {
           echo "<td><a href = 'uploadFile.php?id=".$result['id']."&objective=verify'>Verify</a></td>";
          }
          else {
           echo "<td>Already added</td>";
          }
          echo "<td>".$result['course_name']."</td>"; //course_name
        }
        echo "</tr>";
      ?>
    </div>
  </div>
</div>
