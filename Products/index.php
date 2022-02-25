<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';


  if($_SESSION['User']['cat_id'] == 4){

    $sql = "select products.* , categoy.title as CatTitle from products 
        join categoy on  products.cat_id = categoy.id ";
        
  }else{

    $user_id = $_SESSION['User']['id'];
    $sql = "select products.* , categoy.title as CatTitle from products 
    join categoy on  products.cat_id = categoy.id ";


  }


$op  = mysqli_query($con, $sql);


require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>


<main>
    <div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <?php

           
              displayMessages('Dashboard/Display Products');

            ?>
        </ol>





        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name_Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Description_Product</th>
                                <th>Review_Product</th>
                                <th>Category_ID</th>
                                <th>Image</th>
                                <th>Action</th>		
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>ID</th>
                                <th>Name_Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Description_Product</th>
                                <th>Review_Product</th>
                                <th>Category_ID</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>

                        <tbody>

                            <?php

                            while ($data = mysqli_fetch_assoc($op)) {

                            ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['Name_Product']; ?></td>
                                    <td><?php echo $data['Price']; ?></td>
                                    <td><?php echo $data['Description_Product']; ?></td>
                                    <td><?php echo $data['Review_Product']; ?></td>
                                    <td><?php echo $data['Category_ID']; ?></td>
                                    <td> <img src="./uploads/<?php echo $data['image']; ?>" height="50" width="50"> </td>

                                    <td>
                                        <a href='delete.php?id=<?php echo $data['id'];  ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                        <a href='edit.php?id=<?php echo $data['id'];  ?>' class='btn btn-primary m-r-1em'>Edit</a>

                                    </td>

                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


<?php

require '../layouts/footer.php';

?>