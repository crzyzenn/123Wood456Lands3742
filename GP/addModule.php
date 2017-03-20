<?php
  require "admin/buildAdmin.php";
  require "connect.php";

  getHead("Woodlands: Module (Add Module)", "leader");
  if (isset($_POST['add'])) {
    if ($_POST['name'] == "") {
      $status = 'empty';
    }

    else {
      $insert = $connectSql->prepare("INSERT INTO Module (course_id, module_title) VALUE (?, ?)");
      $insert->execute([$_POST['select'], $_POST['name']]);
      if ($insert) {
        $status = 'success';
      }

    }
  }

  $course = selectAll($connectSql, 'Course', "", "");

  echo "<div class = 'container customAlign'>";
    echo "<div class = 'panel panel-default'>";

      echo "<div class = 'panel-heading'>";
        echo "<p class = 'lead'>Add Module</p>";
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
                <div class="panel-heading">Success: Module added</div>
              </div>';
            }
          }

          echo "<form method = 'POST' action = 'addModule.php'>";
            echo "<div class = 'form-group'>";
              echo "<label class = 'control-label col-sm-2'>Select course: <label>";
              space(1);
              echo "<select class = 'form-group' name = 'select'>";
                foreach ($course as $key => $value) {
                  echo "<option value = '".$value['id']."'><a href = 'showDetails.php?id=".$value['id']."'>".$value['course_title']."</option>";
                }
              echo "</select>";
            echo "</div>";

            echo "<div class = 'form-group'>";
              echo "<label class = 'control-label col-sm-2'>Module Title / Name: </label>";
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
