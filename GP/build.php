<?php
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
    echo '<!--University logo image-->
      <a href = "index.php"><img src="images/logo.png" id = "headerImage" width = 100px></a>
      <h3 class = "text-justify">Woodlands University & College</h3>

      <div class="container headSpace">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
        <li><a data-toggle="tab" href="#contact">Contact Us</a></li>
        <li><a data-toggle="tab" href="#faq">FAQs</a></li>
        <li><a data-toggle="tab" href="#login">Login</a></li>
      </ul>

      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <!-- Carousel -->
          <!-- Surround everything with a div with the class carousel slide -->
          <div id="theCarousel" class="carousel slide" data-ride="carousel">

            <!-- Define how many slides to put in the carousel -->
            <ol class="carousel-indicators">
              <li data-target="#theCarousel" data-slide-to="0" class="active"> </li >
              <li data-target="#theCarousel" data-slide-to="1"> </li>
              <li data-target ="#theCarousel" data-slide-to="2"> </li>
            </ol >

            <!-- Define the text to place over the image -->
            <div class="carousel-inner">
              <div class="item active" >
              <div class ="slide1"><img id = "carouselImage" src="images/a.jpg"></div>
              <div class="carousel-caption">
                <h1 class = "lead">Welcome to Woodlands university</h1>
                <p><a href="#" class="btn btn-primary btn-sm">Apply Now</a></p>
              </div>
            </div>
            <div class="item">
            <div class="slide2"><img id = "carouselImage" src="images/b.jpg"></div>
            <div class="carousel-caption">
              <h1 class = "lead">Different courses to choose from</h1>
              <p><a href="#" class="btn btn-primary btn-sm">See our courses</a></p>
            </div>
            </div>
            <div class="item">
            <div class="slide3"><img id = "carouselImage" src="images/c.jpg"></div>
            <div class="carousel-caption">
            <h1 class = "lead">Queries?</h1>
            <p><a href = "#" class="btn btn-primary btm-sm">Contact Us</a></p>
            </div>
            </div>
            </div>

            <!-- Set the actions to take when the arrows are clicked -->
            <a class="left carousel-control" href="#theCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"> </span>
            </a>
            <a class="right carousel-control" href="#theCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
            </div>
        </div>
        <div id="contact" class="tab-pane fade">
          <h3>Menu 1</h3>
          <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <div id="faq" class="tab-pane fade">
          <h3>Menu 2</h3>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
        </div>
        <div id="login" class="tab-pane fade">
          <div class = "jumbotron jumbotronSpace">
            <form class="form-horizontal" method = "POST" action = "login.php">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">ID:</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="email" placeholder="Enter University ID">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="pwd" placeholder="Enter password">
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
                  <button type="submit" class="btn btn-default">Submit</button>
                </div>
              </div>
            </form>
          </div>
          </div>
        </div>
      </div>
    </div>';

  }
?>
