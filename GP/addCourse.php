<?php
  require "admin/buildAdmin.php";
  require "connect.php";

  getHead("Woodlands: Course (Add Course)", "leader");
  if (isset($_POST['add'])) {
    if ($_POST['name'] == "") {
      $status = 'empty';
    }

    else {
      $insert = $connectSql->prepare("INSERT INTO Course (course_title) VALUE (?)");
      $insert->execute([$_POST['name']]);
      if ($insert) {
        $status = 'success';
      }
    }
  }

  echo "<div class = 'container customAlign'>";
    echo "<div class = 'panel panel-default'>";

      echo "<div class = 'panel-heading'>";
        echo "<p class = 'lead'>Add Course</p>";
      echo "</div>";

      echo "<div class = 'panel-body'>";
        echo "<div class = 'container'>";

          if (isset($status)) {
            if ($status == "empty") {
              echo '<div class="panel panel-danger panelAlign">
                <div class="panel-heading">Error: Invalid course name</div>
              </div>';
            }

            else if ($status == "success") {
              echo '<div class="panel panel-success panelAlign">
                <div class="panel-heading">Success: Course added</div>
              </div>';
            }
          }
          echo "<form method = 'POST' action = 'addCourse.php'>";

            echo "<div class = 'form-group'>";
              echo "<label class = 'control-label col-sm-2'>Course Title / Name: </label>";
                echo "<div class = col-sm-4>";
                  echo "<input type = 'text' class = 'form-control' name = 'name'><br>";
                  echo "<input type = 'submit' class = 'btn btn-primary' name = 'add' value = 'Add'>";
                echo "</div>";
            echo "</div>";
          echo "</form>";

        echo "</div>";

      echo "</div>";
    echo "</div>";
  echo "</div>";
?>
