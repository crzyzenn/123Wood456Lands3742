<?php
  require 'admin/buildAdmin.php';
  
  require 'connect.php';

  //To logout
  if (isset($_GET['action'])) {
    unset($_SESSION['name']);
    alert("You have been logged out");
    redirect("index.php");
  }

  getHead("Woodlands: Staff", "leader");

?>
