<?php
  require "buildAdmin.php";
  require "../connect.php";

  getHead("Woodlands: Admin");
?>
<div class = "jumbotron jumbotronSpace">
  <form class="form-horizontal" method = "POST" action = "index.php">
    <p class = "lead text-center">Login</p>
    <?php
      if (isset($_POST['submit'])) {
          if (empty($_POST['id'])) {
            # code...
            echo '<div class="panel panel-danger">
            <div class="panel-heading">Error:</div>
            <div class="panel-body">Enter username / id.</div>
            </div>';
          }
          else if (empty($_POST['password'])) {
            # code...
            echo '<div class="panel panel-danger">
            <div class="panel-heading">Error:</div>
            <div class="panel-body">Enter password.</div>
            </div>';
          }

          else {
              $table = "admin";
              $pdo = $connectSql;
              $field = ['username', 'password'];
              $extra = ['firstname', 'lastname'];
              $value =[$_POST['id'], $_POST['password']];
              runSelect($pdo, $table, $field, $extra, $value, true);

          }
      }
    ?>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Username / ID:</label>
      <div class="col-sm-8">
        <input type="text" name = "id" class="form-control" id="email" placeholder="Enter University ID">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-8">
        <input type="password" name = "password" class="form-control" id="pwd" placeholder="Enter password">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox"> Remember me</label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name = "submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>
