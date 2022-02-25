<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
$id = $_GET['id']; 
$sql = "select * from roles where id = $id"; 
$op  = mysqli_query($con,$sql);
$roleData = mysqli_fetch_assoc($op);
 if($_SERVER['REQUEST_METHOD'] == "POST"){
    $title = Clean($_POST['title']);
    $errors = [];
    if(!validate($title,1)){
        $errors['Title'] = " Title Required"; 
    }
   if(count($errors) > 0 ){
    $_SESSION['Message'] = $errors;
   }else{
    $sql = "update roles set title =  '$title' where id = $id"; 
    $op  = mysqli_query($con,$sql); 
    if($op){
        $message = ["Raw Updated"];
        $_SESSION['Message'] = $message;
        header("Location: index.php");
        exit();
    }else{
        $message = ["Error Try Again"];
        $_SESSION['Message'] = $message;
    }
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
             displayMessages('Dashboard/Edit Role');
            ?>
        </ol>
        <div class="container">
            <form action="edit.php?id=<?php echo  $roleData['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputName">Title</label>
                    <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="title" value = "<?php echo $roleData['title'];?>" placeholder="Enter RoleTitle">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</main>
<?php
require '../layouts/footer.php';
?>