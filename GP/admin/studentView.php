<?php
  require "buildAdmin.php";
  require "../connect.php";

  getHead("Woodlands: Student (View Records)");
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
            echo "<p class = 'page-header lead'>Showing student records (Name)</p>";
          }

          else if ($_GET['sortby'] == 'id') {
            echo "<p class = 'page-header lead'>Showing student records (ID)</p>";
          }

          else if ($_GET['sortby'] == 'male') {
            echo "<p class = 'page-header lead'>Showing student records (Gender - Male)</p>";
          }

          else if ($_GET['sortby'] == 'female') {
            echo "<p class = 'page-header lead'>Showing student records (Gender - Female)</p>";
          }
        }
        else
          echo "<p class = 'page-header lead'>Showing student records</p>";
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
              echo "<th>Gender</th>";
              echo "<th>E-mail</th>";
              echo "<th>Date of Birth</th>";
              echo "<th>Contact no.</th>";
              echo "<th>Course ID</th>";
              echo "<th>Action</th>";
            echo "</tr>";
          echo "</thead>";
          echo "<tbody>";
          foreach ($query as $value) {
            echo "<tr>";
              echo "<td>".$value['ID']."</td>";
              echo "<td><a href = 'showDetails.php?id=".$value['ID']."'>".$value['firstname']."</a></td>";
              echo "<td><a href = 'showDetails.php?id=".$value['ID']."'>".$value['surname']."</td>";
              echo "<td>".$value['gender']."</td>";
              echo "<td>".$value['email']."</td>";
              echo "<td>".$value['dob']."</td>";
              echo "<td>".$value['contact']."</td>";
              echo "<td>".$value['course_id']."</td>";
              echo "<td>
                      <div class = 'dropdown'>
                        <button class = 'btn btn-secondary dropdown-toggle' type = 'button' data-toggle = 'dropdown'>Select <span class = 'caret'></span></button>
                        <ul class = 'dropdown-menu'>
                          <li><a href = 'studentEdit.php?id=".$value['ID']."'>Edit</a></li>
                          <li><a href = 'showDetails.php?id=".$value['ID']."&course_id=".$value['course_id']."'>Enter grades</a></li>
                          <li><a href = 'showDetails.php?id=".$value['ID']."'>Enter attendance</a></li>
                          <li><a href = 'showDetails.php?id=".$value['ID']."'>View Performance</a></li>
                        </ul>
                      </div>
                    </td>";
            echo "</tr>";
          }
          echo "</tbody>";
        echo "</table>";
      echo "</div>";
    echo "</div>";
  echo "</div>";
?>
