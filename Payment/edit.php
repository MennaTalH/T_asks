<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

$id = $_GET['id']; 

$sql = "select * from payment where id = $id"; 
$op  = mysqli_query($con,$sql);
$payData = mysqli_fetch_assoc($op);
 if($_SERVER['REQUEST_METHOD'] == "POST"){
 
    $Payment_Type	 = Clean($_POST['Payment_Type']);
    $Payment_Status	 = Clean($_POST['Payment_Status']);
    $Payment_Date	 = Clean($_POST['Payment_Date']);
    $Allowed	     = Clean($_POST['Allowed']);
    $errors = [];

    if(!validate($Payment_Type	,1)){
        $errors['Payment_Type	'] = " Payment_Type Required"; 
    }
    if(!validate($Payment_Status)){
        $errors['Payment_Status	'] = " Payment_Status Required"; 
    }
    if (!validate($Payment_Date, 1)) {
        $errors['Payment_Date'] = " Payment_Date Required";
    } elseif (!validate($Payment_Date, 6)) {
        $errors['Payment_Date'] = " Payment_Date Invalid";
    } elseif (!validate($Payment_Date, 7)) {
        $errors['Payment_Date'] = " date must be > current time ";
    }
    if(!validate($Allowed)){
        $errors['Allowed	'] = " Allowed Required"; 
    }
   if(count($errors) > 0 ){
    $_SESSION['Message'] = $errors;
   }else{
   		

   $date = strtotime($date);
    $sql = "update payment set Payment_Type ='$Payment_Type', Payment_Status ='$Payment_Status',Payment_Date= $Payment_Date',Allowed ='$Allowed'where id = $id"; 
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
        <h1 class="mt-4">Payment</h1>
        <ol class="breadcrumb mb-4">
            <?php 
               displayMessages('Dashboard/Edit Payments');
            ?>
        </ol>
        <div class="container">
            <form action="edit.php?id=<?php echo  $payData['id']; ?>" method="post" enctype="multipart/form-data">

               
            <div class="form-group">
                    <label for="exampleInputName">Payment_Type</label>
                    <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="Payment_Type" placeholder="Enter Payment_Type">
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Payment_Status</label>
                    <input type="text" class="form-control"  id="exampleInputName" aria-describedby="" name="Payment_Status" placeholder="Enter Payment_Status">
                </div> 
                <div class="form-group">
                    <label for="exampleInputPassword">Payment_Date</label>
                    <input type="date" class="form-control" id="exampleInputPassword1" name="date">
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Allowed</label>
                    <input type="number" class="form-control"  id="exampleInputName" aria-describedby="" name="Allowed" placeholder="Enter Allowed">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>




    </div>
</main>


<?php

require '../layouts/footer.php';

?>