<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Discussbunch-Online Discussion Forum</title>
</head>

<body>
    <?php include 'partials/_header.php';?>
    <?php include 'partials/_dbconnect.php';?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id"; 
    $result = mysqli_query($conn, $sql);
    $noresult = true;
    while ($row = mysqli_fetch_assoc($result)){
        $noresult = false;
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>
    
    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //insert thread into db
        $th_title= $_POST['title']; 
        $th_desc= $_POST['desc'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if($showAlert){
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success! </strong> Your Thread has benn added Please Wait for community to respond
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';
        }
    }
    ?>
    
    <!-- category container start here  -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forum</h1>
            <p class="lead"><?php echo $catdesc; ?>r</p>
            <hr class="my-4">
            <p>No Spam / Advertising / Self-promote in the forums. ...
                Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Do not PM users asking for help. ...
                Remain respectful of other members at all times.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<div class="container">
            <h1 class="py-2">Start a discussion</h1>
            <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                        placeholder="Title">
                    <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                        possible</small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Thread Description</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
    }
    else{
        echo '
        <div class="container">
        <h1 class="py-2">Start a discussion</h1>
        <p class="lead">You are not logged in. Please login to be able to start a discussion</p>
        </div>';
    }
    ?>

    <div class="container" id="ques">
        <h1 class="py-2">Browse Questions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id"; 
        $result = mysqli_query($conn, $sql);
        $noresult = true;
        while ($row = mysqli_fetch_assoc($result)){
            $noresult = false;
            $id =$row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_time = $row['timestamp'];

        echo '<div class="media my-3">
            <img class="mr-3" src="img/userdefault.png" width="54px" alt="user image">
            <div class="media-body">
            <p class="font-weight-bold my-0">Anonymous User at ' .$thread_time. '</p>
                <h5 class="mt-0"><a href="thread.php?threadid=' . $id . '">' . $title . '</a></h5>
                ' . $desc . '
            </div>
        </div>';
        }
   
        if($noresult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
            <p>No Threads Found<p>
            <p class="lead">Be the first person to ask the question</p>
            </div>
        </div>';
        }
        ?>



    </div>

    <?php include 'partials/_footer.php';?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>