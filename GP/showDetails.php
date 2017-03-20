<?php
  require "admin/buildAdmin.php";
  require "connect.php";

  getHead("Woodlands: Student (View Records)", "leader");

  if (isset($_POST['add'])) {
    if ($_POST['name'] == "") {
      $status = 'empty';
    }

    else {
      $insert = $connectSql->prepare("INSERT INTO Grade (student_id, course_id, module_id, grade) VALUE (?, ?, ?, ?)");
      $insert->execute([$_GET['id'], $_GET['course_id'], $_POST['select'], $_POST['name']]);
      if ($insert) {
        $status = 'success';
      }
    }
  }


  $student = selectAll($connectSql, 'Student', 'id', $_GET['id']);
  $course = selectAll($connectSql, 'Course', "", "");
  $module = selectAll($connectSql, 'Module', 'course_id', $_GET['course_id']);


  echo "<div class = 'container customAlign'>";
    echo "<div class = 'panel panel-default'>";
      echo "<div class = 'panel-heading'>";
        $a = 0;
        $courseName = "";
        foreach ($student as $key => $value) {
          $a = $value['course_id'];
            foreach ($course as $key => $name) {
              if ($a == $name['id']) {
                $courseName = $name['course_title'];
              }
            }
            echo "Grades: ( ".$value['firstname']." ".$value['surname']." | Course - ".$courseName." )";
        }

      echo "</div>";
      echo "<div class = 'panel-body'>";
        echo "<div class = 'container'>";
          if (isset($status)) {
            if ($status == "empty") {
              echo '<div class="panel panel-danger panelAlign">
                <div class="panel-heading">Error: Invalid grade</div>
              </div>';
            }

            else if ($status == "success") {
              echo '<div class="panel panel-success panelAlign">
                <div class="panel-heading">Success: Grade added</div>
              </div>';
            }
          }
          echo "<div class = 'form-group'>";
            echo "<form method = 'POST' action = 'showDetails.php?id=".$_GET['id']."&course_id=".$_GET['course_id']."'>";
              echo "<div class = 'form-group'>";
                echo "<label class = 'control-label col-sm-2'>Select module: <label>";
                space(1);
                echo "<select class = 'form-group' name = 'select'>";
                  foreach ($module as $key => $value) {
                    echo "<option value = '".$value['module_id']."'><a href = 'showDetails.php?id=".$value['module_title']."'>".$value['module_title']."</option>";
                  }
                echo "</select>";
              echo "</div>";

              echo "<div class = 'form-group'>";
                echo "<label class = 'control-label col-sm-2'>Enter grade: </label>";
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
  echo "</div>";
?>
