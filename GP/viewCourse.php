<?php
  require "admin/buildAdmin.php";
  require "connect.php";

  getHead("Woodlands: Course (Add Course)", "leader");




  if (isset($_GET['action'])) {
      //To delete a course

      //Confirm
      if ($_GET['action'] == 'del') {
         echo "<script>var a = confirm('Are you sure? '); if(a) window.location = 'viewCourse.php?id=".$_GET['id']."&action=confirm';</script>";
      }

      //If course deletion is confirmed
      else if ($_GET['action'] == 'confirm') {
        $deleteQuery = $connectSql->prepare("DELETE FROM Course WHERE id = ?");
        $deleteQuery->execute([$_GET['id']]);
        if ($deleteQuery) {
          echo "<script>window.location = 'viewCourse.php?status=success'</script>";
        }
      }
  }


  //To edit a course
  if (isset($_POST['submit'])) {
    $edit = $connectSql->prepare("UPDATE Course SET course_title = ? WHERE id = ?");
    $edit->execute([$_POST['title'], $_GET['id']]);

    if ($edit) {
      echo "<script>window.location = 'viewCourse.php?status=edited'</script>";
    }
  }

  if(isset($_GET['status'])){
      switch($_GET['status']){
          case 'success':
              $statusMsgClass = 'alert-success';
              $statusMsg = 'Successfully deleted.';
              break;
          case 'edited':
              $statusMsgClass = 'alert-success';
              $statusMsg = 'Successfully edited.';
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

  //To edit a course



  //Get courses from the Course table
  $course = selectAll($connectSql, "Course", "", "");



  echo "<div class = 'container customAlign'>";
    echo "<div class = 'panel panel-default'>";

      echo "<div class = 'panel-heading'>";
        echo "<p class = 'lead'>Available courses</p>";
      echo "</div>";

      echo "<div class = 'panel-body'>";
        if(!empty($statusMsg)){
            echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
        }
        echo "<table class = 'table table-bordered'>";
        echo "<thead>";
          echo "<th>Course ID</th>";
          echo "<th>Course title</th>";
          echo "<th>Action</th>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($course as $value) {
          echo "<tr>";
            echo "<td>".$value['id']."</td>";

            if (isset($_GET['action'])) {
              if ($_GET['id'] == $value['id']) {
                if ($_GET['action'] == 'edit') {
                  echo "<form action = 'viewCourse.php?id=".$value['id']."' method = 'POST'>";
                    echo "<td><input type = 'text' name = 'title' value = ".$value['course_title']."></td>";
                    echo "<td><input class = 'btn btn-primary' type = 'submit' name = 'submit' value = 'Apply'></td>";
                  echo "</form>";
                }
              }
              else {
                  echo "<td>".$value['course_title']."</td>";
                  echo "<td><a title = 'Delete' class = 'btn btn-md btn-danger' href = 'viewCourse.php?action=del&id=".$value['id']."'><span class = 'glyphicon glyphicon-remove'></span></a> <a title = 'Edit' class = 'btn btn-md btn-default' href = 'viewCourse.php?action=edit&id=".$value['id']."'><span class = 'glyphicon glyphicon-edit'></span></a> </td>";
              }
            }
            else {
                echo "<td>".$value['course_title']."</td>";
                echo "<td><a title = 'Delete' class = 'btn btn-md btn-danger' href = 'viewCourse.php?action=del&id=".$value['id']."'><span class = 'glyphicon glyphicon-remove'></span></a> <a title = 'Edit' class = 'btn btn-md btn-default' href = 'viewCourse.php?action=edit&id=".$value['id']."'><span class = 'glyphicon glyphicon-edit'></span></a> </td>";
            }


          echo "</tr>";
        }
        echo "</tbody>";
      echo "</div>";
    echo "</div>";
  echo "</div>";
?>
