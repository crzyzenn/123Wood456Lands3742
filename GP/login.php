<?php
  require "build.php";
  getHead("Woodlands:Login");


  //Get the data from the database
  $loginData = $connectSql->query("SELECT username, password FROM Staff where username = '".$_POST['email']."'");
  if (isset($_POST['submit'])) {
    $status = "";
    foreach ($loginData as $value) {
      if ($value['username'] == $_POST['email'] && $value['password'] == $_POST['pwd']) {
        $status = true;
      }

      else {
        $status = false;
      }
    }

    if ($status) {
      alert("Logged in");
      $_SESSION['name'] = $value['username'];
      redirect("userPage.php?type=staff");
    }

    else {
      alert("Username/Password incorrect");
      redirect("index.php");
    }

  }
?>
