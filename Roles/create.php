<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

 if($_SERVER['REQUEST_METHOD'] == "POST"){
 
    $title = Clean($_POST['title']);
    $errors = [];

    if(!validate($title,1)){
        $errors['Title'] = " Title Required"; 
    }

   if(count($errors) > 0 ){
    $_SESSION['Message'] = $errors;
   }else{
    
    $sql = "insert into roles (title) values ('$title')"; 
    $op  = mysqli_query($con,$sql); 

    if($op){
        $message = ["Raw Inserted"];
    }else{
        $message = ["Error Try Again"];
    }

      $_SESSION['Message'] = $message;

   }

 } 
require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <?php 
               displayMessages('Dashboard/Add Role');
            ?>
        </ol>
        <div class="container">
            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputName">Title</label>
                    <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="title" placeholder="Enter RoleTitle">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</main>
<?php
require '../layouts/footer.php';
?>