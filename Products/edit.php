<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';


$id = $_GET['id'];

$sql = "select * from products where id = $id";
$op = mysqli_query($con, $sql);


if (mysqli_num_rows($op) == 1) {

    $ProData = mysqli_fetch_assoc($op);

      
} 
$sql = 'select * from categoy';
$CatOp = mysqli_query($con, $sql);

require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>



<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit The products</li>

            <?php
            echo '<br>';
            if (isset($_SESSION['Message'])) {
                displayMessages($_SESSION['Message']);
          
                unset($_SESSION['Message']);
            }
            
            ?>

        </ol>
        				

        <div class="card mb-4">

            <div class="card-body">

                <form action="edit.php?id=<?php echo $ProData['id']; ?>" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputName">Name_Product</label>
                        <input type="text" class="form-control" id="exampleInputName" name="Name_Product" aria-describedby=""
                            placeholder="Enter Name_Product" value="<?php echo $ProData['Name_Product']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName">Quantity</label>
                        <input type="number" class="form-control" id="exampleInputName" name="Quantity" aria-describedby=""
                            placeholder="Enter Quantity" value="<?php echo $ProData['Quantity']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName">Price</label>
                        <input type="number" class="form-control" id="exampleInputName" name="Price" aria-describedby=""
                            placeholder="Enter Price" value="<?php echo $ProData['Price']; ?>">
                    </div>



                    <div class="form-group">
                        <label for="exampleInputName"> Description_Product</label>
                        <textarea class="form-control" id="exampleInputName"
                            name="Enter Description_Product"> <?php echo $ProData['Description_Product']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName">  Review_Product</label>
                        <textarea class="form-control" id="exampleInputName"
                            name="Enter Review_Product"> <?php echo $ProData['Review_Product']; ?></textarea>
                    </div>

                   	pro_Image	Category_ID	

                    <div class="form-group">
                        <label for="exampleInputPassword">Category</label>
                        <select class="form-control" id="exampleInputPassword1" name="cat_id">

                            <?php
                               while($data = mysqli_fetch_assoc($CatOp)){
                            ?>

                            <option value="<?php echo $data['id']; ?>" <?php if ($data['id'] == $ProData['cat_id']) {
                                echo 'selected';
                                 } ?>><?php echo $data['title']; ?></option>

                            <?php }
                            ?>

                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputName">Image</label>
                        <input type="file" name="image">
                    </div>

                    <img src="./uploads/<?php echo $ProData['image']; ?>" alt="" height="50px" width="50px"> <br>


                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>





            </div>
        </div>
    </div>
</main>


<?php
require '../layouts/footer.php';
?>
