<?php
  session_start(); 
  require 'connect.php';
  function getHead($title){
    echo "<!DOCTYPE html>";
    echo "<html>";
    echo "<head>";
      echo '<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=10">
      <link rel="stylesheet" type = "text/css" href="css/bootstrap.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
    echo "</head>";
    echo "<title>";
      echo $title;
    echo "</title>";
    echo "<body>";
  }

  function getFoot(){
      echo "</body>";
    echo "</html>";
  }


  function alert($message){
    echo "<script>alert('".$message."');</script>";
  }

  function redirect($url){
    header("refresh:0;url=".$url."");
  }
?>
