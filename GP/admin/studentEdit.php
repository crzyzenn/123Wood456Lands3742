<?php
  require "buildAdmin.php";
  require "../connect.php";

  getHead("Woodlands: Student (View Records)");


  //Updating record on the database
  if (isset($_POST['Edit'])) {
    $update = $connectSql->prepare("UPDATE Student SET firstname=?, surname=?, gender=? ,dob=?, contact=?, email=? WHERE id=?");
    $update->execute([$_POST['firstname'], $_POST['surname'], $_POST['gender'], $_POST['dob'], $_POST['contact'], $_POST['email'], $_GET['id']]);
    if ($update) {
      echo "<div class = 'container customAlign'>";
        echo '<div class="panel-group">';
          echo '<div class="panel panel-success">';
            echo '<div class="panel-heading">';
              echo 'Success!';
            echo '</div>';
            echo '<div class="panel-body">';
              echo 'Changes has been applied';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      echo "</div>";
    }
  }

  else{
    //To get all the student records from the database
    $id = $_GET['id'];
    $query = $connectSql->query("SELECT * FROM Student WHERE id = '$id'");
    foreach ($query as $key => $value) {
      echo "<div class = 'container customAlign'>";
        echo "<div class = 'panel panel-default'>";
          echo "<div class = 'panel-body'>";
            echo "<p class = 'page-header lead'>Edit (Student Record)</p>";
            echo "<div class = 'container'>";
              echo "<form action = 'studentEdit.php?id=".$_GET['id']."' method = 'POST'>";
              //while ($a = $query) {

              //}
                echo "<div class = 'form-group'>";
                  echo "<label class = 'col-sm-1'>Firstname: </label>";
                  echo "<input type = 'text' class = 'input-group-sm' name = 'firstname' value = '".$value['firstname']."'>";
                echo "</div>";

                echo "<div class = 'form-group'>";
                  echo "<label class = 'col-sm-1'>Surname: </label>";
                  echo "<input type = 'text' class = 'input-group-sm' name = 'surname' value = '".$value['surname']."'>";
                echo "</div>";

                echo "<div class = 'form-group'>";
                  echo "<label class = 'col-sm-1'>Gender: </label>";
                  echo "<input type = 'text' class = 'input-group-sm' name = 'gender' value = '".$value['gender']."'>";
                echo "</div>";

                echo "<div class = 'form-group'>";
                  echo "<label class = 'col-sm-1'>DOB: </label>";
                  echo "<input type = 'date' class = 'input-group-sm' name = 'dob' value = '".$value['dob']."'>";
                echo "</div>";

                echo "<div class = 'form-group'>";
                  echo "<label class = 'col-sm-1'>Contact: </label>";
                  echo "<input type = 'text' class = 'input-group-sm' name = 'contact' value = '".$value['contact']."'>";
                echo "</div>";

                echo "<div class = 'form-group'>";
                  echo "<label class = 'col-sm-1'>E-mail: </label>";
                  echo "<input type = 'email' class = 'input-group-sm' name = 'email' value = '".$value['email']."'>";
                echo "</div>";

                echo "<div class = 'form-group'>";
                  echo "<input type = 'submit' class = 'col-xs-offset-2 btn btn-sm btn-primary' name = 'Edit' value = 'Edit'>";
                echo "</div>";
              echo "</form>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    }
  }
?>
