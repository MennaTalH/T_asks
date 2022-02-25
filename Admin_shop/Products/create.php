<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';


$sql = "select * from products";
$catOp  = mysqli_query($con, $sql);


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $Name_Product   = Clean($_POST['Name_Product ']);
    $Quantity       = Clean($_POST[Quantity]);
    $Price          = Clean($_POST[Price]);
    $Description_Product   = Clean($_POST['Description_Product']);
    $Review_Product        = Clean($_POST['Review_Product']);
    $Category_ID           = Clean($_POST['Category_ID']);

    $errors = [];
    
    if (!validate($Name_Product)) {
        $errors['Name_Product'] = " Name_Product Required";
    }
  
    if (!validate($Quantity)) {
        $errors[Quantity] = " Quantity Required";
    }

    
    if (!validate($Price)) {
        $errors[Price] = " Price Required";
    }
    if (!validate($Description_Product)) {
        $errors['Description_Product'] = " Description_Product Required";
    }
    if (!validate($Review_Product)) {
        $errors['Review_Product'] = " Review_Product Required";
    }


    if (!validate($Category_ID, 1)) {
        $errors['Category_ID'] = " Category_ID Required";
    } elseif (!validate($Category_ID, 4)) {
        $errors['Category_ID'] = " Category_ID Invalid";
    }

    if (!validate($_FILES['image']['name'], 1)) {
        $errors['Image']  = "Image Required";
    } elseif (!validate($_FILES['image']['name'], 5)) {
        $errors['Image']  = "Image : Invalid Extension";
    }


    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
      
        $image = uploadFile($_FILES);

        if (empty($image)) {
            $_SESSION['Message'] = ["Error In Uploading File Try Again"];
        } else {

         //   $date = strtotime($date);

            $user_id = $_SESSION['User']['id'];
         $sql = "insert into products (Name_Product,Quantity,Price ,Description_Product,Review_Product,Image ,Category_ID) 
            values ('$Name_Product',$Quantity,$Price ,'$Description_Product','$Review_Product','$Image' ,$Category_ID	)";
         						
            $op  = mysqli_query($con, $sql);

            if ($op) {
                $message = ["Raw Inserted"];
            } else {
                $message = ["Error Try Again"];
            }

            $_SESSION['Message'] = $message;
        }
    }
}



#############################################################################################

require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <?php
            displayMessages('Add Your Products');
            ?>
        </ol>
        						Category_ID	
        <div class="container">
            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputName">Name_Product</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="Name_Product" placeholder="Enter Name_Product">
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Quantity</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="Quantity" placeholder="Enter Quantity">
                </div>
                <div class="form-group">
                    <label for="exampleInputName">Price</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="Price" placeholder="Enter Price">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail">Description_Product</label>

                    <textarea name="Description_Product" class="form-control" id="" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail">Review_Product</label>

                    <textarea name="Review_Product" class="form-control" id="" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword">Ctegory</label>
                    <select class="form-control" name="cat_id">

                        <?php
                        while ($Cat_data = mysqli_fetch_assoc($catOp)) {
                        ?>

                            <option value="<?php echo $Cat_data['id']; ?>"><?php echo $Cat_data['title']; ?></option>

                        <?php }  ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword">Image</label>
                    <input type="file" name="image">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>




    </div>
</main>


<?php

require '../layouts/footer.php';

?>