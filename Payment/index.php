<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

$sql = "select * from payment ";
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
            displayMessages('Dashboard/Display payment');
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
                                <th>Payment_Type</th>
                                <th>Payment_Status</th>
                                <th>Payment_Date</th>
                                <th>Allowed</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Payment_Type</th>
                                <th>Payment_Status</th>
                                <th>Payment_Date</th>
                                <th>Allowed</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>

                        <tbody>

                            <?php

                            while ($data = mysqli_fetch_assoc($op)) {

                            ?>
                                <tr>
                                    <td><?php echo $data['id']; ?></td>
                                    <td><?php echo $data['Payment_Type']; ?></td>
                                    <td><?php echo $data['Payment_Status']; ?></td>
                                    <td><?php echo $data['Payment_Date']; ?></td>
                                    <td><?php echo $data['Allowed']; ?></td>
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