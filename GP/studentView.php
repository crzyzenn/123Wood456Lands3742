<?php
  require "admin/buildAdmin.php";
  require "connect.php";

  getHead("Woodlands: Student (View Records)", "leader");

  //To get the course title


  //To get all the student records from the database
  if (isset($_GET['sortby'])) {
    if ($_GET['sortby'] == 'name') {
      $query = $connectSql->query("SELECT * FROM Student ORDER BY firstname");
    }

    else if ($_GET['sortby'] == 'id') {
      $query = $connectSql->query("SELECT * FROM Student ORDER BY id");
    }

    else if ($_GET['sortby'] == 'male') {
      $query = $connectSql->query("SELECT * FROM Student WHERE gender = 'male'");
    }

    else if ($_GET['sortby'] == 'female') {
      $query = $connectSql->query("SELECT * FROM Student WHERE gender = 'female'");
    }
  }
  else
    $query = $connectSql->query("SELECT * FROM Student");


  echo "<div class = 'container customAlign'>";
    echo "<div class = 'panel panel-default'>";
      echo "<div class = 'panel-heading'>";
        if (isset($_GET['sortby'])) {
          if ($_GET['sortby'] == 'name') {
            echo "<p class = 'page-header lead'>Select student (Name)</p>";
          }

          else if ($_GET['sortby'] == 'id') {
            echo "<p class = 'page-header lead'>Select student (ID)</p>";
          }

          else if ($_GET['sortby'] == 'male') {
            echo "<p class = 'page-header lead'>Select student (Gender - Male)</p>";
          }

          else if ($_GET['sortby'] == 'female') {
            echo "<p class = 'page-header lead'>Select student (Gender - Female)</p>";
          }
        }
        else
          echo "<p class = 'page-header lead'>Select student</p>";
        echo "</div>";
        echo "<div class = 'panel-body'>";
        echo "<div class = 'dropdown'>";
          echo "<button class = 'btn btn-secondary dropdown-toggle' type = 'button' data-toggle = 'dropdown'>Sort by <span class = 'caret'></span></button>";
          echo "<ul class = 'dropdown-menu'>";
            echo "<li><a href = 'studentView.php?sortby=name'>Name</a></li>";
            echo "<li><a href = 'studentView.php?sortby=id'>ID</a></li>";
            echo "<li><a href = 'studentView.php?sortby=male'>Gender - M</a></li>";
            echo "<li><a href = 'studentView.php?sortby=female'>Gender - F</a></li>";
          echo "</ul>";
        echo "</div>";
        space(2);
        echo "<table class = 'table table-bordered'>";
          echo "<thead>";
            echo "<tr>";
              echo "<th>ID</th>";
              echo "<th>First name</th>";
              echo "<th>Surname</th>";
              echo "<th>Course</th>";
              echo "<th>Action</th>";
            echo "</tr>";
          echo "</thead>";
          echo "<tbody>";
          foreach ($query as $value) {

            $result = $connectSql->query("SELECT course_title FROM Course WHERE id = ".$value['course_id']);
            $title = "";
            foreach ($result as $val) {
              $title = $val['course_title'];
            }
            echo "<tr>";
              echo "<td>".$value['ID']."</td>";
              echo "<td><a href = 'showDetails.php?id=".$value['ID']."'>".$value['firstname']."</a></td>";
              echo "<td><a href = 'showDetails.php?id=".$value['ID']."'>".$value['surname']."</td>";              
              echo "<td>".$title."</td>";
              echo "<td>
                      <a href = 'showDetails.php?id=".$value['ID']."&course_id=".$value['course_id']."'>Enter grades</a>
                    </td>";
            echo "</tr>";
          }
          echo "</tbody>";
        echo "</table>";
      echo "</div>";
    echo "</div>";
  echo "</div>";
?>
