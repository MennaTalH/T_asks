<?php

require 'dbConnect.php';
require 'helpers.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title     = Clean($_POST['title']);
    $content   = Clean($_POST['content']);
    $date      = Clean($_POST['date']);
    $image     = Clean($_POST['image']);  
    $errors = [];
    if (empty($title)) {
        $errors['title'] = "Field Required";
    }
    if (empty($content)) {
        $errors['content'] = "Field Required";
    }
  
    if (empty($date)) {
        $errors['date'] = "Field Required";
    }
    if (empty($image)) {
        $errors['image'] = "Field Required";
    }


    if (count($errors) > 0) {
    
        foreach ($errors as $key => $value) {
           
            echo '* ' . $key . ' : ' . $value . '<br>';
        }
    } else {
        $sql = "insert into user_info (title,content,date) values ('$title','$content','$date')";

        $op  =  mysqli_query($con,$sql);

        mysqli_close($con);

        if($op){
            echo 'Raw Inserted';
        }else{
            echo 'Error Try Again '.mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>The Blog Page</h2>

        <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

            <div class="form-group">
                <label for="exampleInputtitle">Title</label>
                <input type="text" class="form-control" required id="exampleInputtitle"
                 aria-describedby="" name="title" placeholder="Enter The Title">
            </div>


            <div class="form-group">
                <label for="exampleInputEmail">content</label>
                <input type="text" class="form-control" required id="exampleInputcontent" 
                 name="content" placeholder="Enter content">
            </div>

            <div class="form-group">
                <label for="exampleInputdate">Date</label>
                <input type="date" class="form-control"
                 required id="exampleInputdate" name="date" placeholder="date">
            </div>
            <div class="form-group">
                <label for="exampleInputimage">Image</label>
                <input type="file" class="form-control"
                 required id="exampleInputimage" name="image" placeholder="image">
            </div>


            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>