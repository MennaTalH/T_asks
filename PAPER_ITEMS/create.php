<?php
require './clasess/items.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $student = new items; 
     $data = $student->paper($_POST);
     foreach($data as $key => $value){
         echo '* '.$key.' : '.$value.'<br>';
     }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Items Of Paper</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Items Of Paper</h2>
        <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputName">Title</label>
                <input type="text" class="form-control"  id="exampleInputtitle" aria-describedby="" name="title" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="exampleInputcontent">Content</label>
                <input type="content" class="form-control"  id="exampleInputcontent" aria-describedby="" name="content" placeholder="Enter content">
            </div>

        
            <div class="form-group">
                    <label for="exampleInputImage">Image</label>
                    <input type="file" name="image">
                </div>





            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>


</body>

</html>