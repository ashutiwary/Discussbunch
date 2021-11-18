<?php 
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/discussbunch">Discussbunch</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

<!------------navbar start here -------------------->

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/discussbunch">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About Us</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Python</a>
          <a class="dropdown-item" href="#">Javascript</a>
          <a class="dropdown-item" href="#">Flask</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact US</a>
      </li>
    </ul>
    <div class="row max-2">';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo '<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      <p class="my-0 mx-2">Welcome '. $_SESSION['useremail'].'</p>
      <a href="partials/_logout.php" class="btn btn-primary ml-2">Logout</a>
      </form>';
    }
    else{
    echo '<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
        <button class="btn btn-primary ml-2" data-toggle="modal" data-target="#loginmodal">Login</button>
        <button class="btn btn-primary mx-2" data-toggle="modal" data-target="#signupmodal">Sign Up</button>';
    }
    
      echo  '</div>
            </div>
          </nav>';

 include 'partials/_loginmodal.php';
 include 'partials/_signupmodal.php';
 if (isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
   echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>Success !</strong> You Can now login.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
 }
 
 ?>