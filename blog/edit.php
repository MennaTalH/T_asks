<?php
require 'dbConnect.php';
require 'helpers.php';

$id = $_GET['id'];

$sql = "select id,name,email from users where id = $id";
$op  = mysqli_query($con,$sql);

$data= mysqli_fetch_assoc($op); 

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title     = Clean($_POST['title']);
    $content    = Clean($_POST['content']);

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
        $sql = "update user_info set title = '$title' , content = '$content' , date = ' $date ' ,image ='$image' where  id = $id";

        $op  =  mysqli_query($con,$sql);


        if($op){

          $_SESSION['Message']  = 'Raw Updated'; 

          header("Location: index.php");

        }else{
            echo 'Error Try Again '.mysqli_error($con);
        }

        mysqli_close($con);

    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Update Data</h2>

        <form action="edit.php?id=<?php echo $id;?>" method="post">

            <div class="form-group">
                <label for="exampleInputtitle">title</label>
                <input type="text" class="form-control" required id="exampleInputtitle"
                 aria-describedby="" name="title"  value= "<?php echo $data['title'];?>"  placeholder="Enter the title">
            </div>


            <div class="form-group">
                <label for="exampleInputcontent">Content</label>
                <input type="text" class="form-control" required id="exampleInputcontent"
                  name="content" value= "<?php echo $data['content'];?>" placeholder="Enter The Content">
            </div>

             <div class="form-group">
                <label for="exampleInputdate">Date</label>
                <input type="date" class="form-control" required id="exampleInputdate"
                 name="date" placeholder="date">
            </div> 

            <div class="form-group">
                <label for="exampleInputimage">Image</label>
                <input type="file" class="form-control"
                 required id="exampleInputimage" name="image" placeholder="image">
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>


</body>

</html>