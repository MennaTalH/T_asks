<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';

$sql = "select * from roles";
$rolesOp  = mysqli_query($con, $sql);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name     = Clean($_POST['name']);
    $password = Clean($_POST['password'], 1);
    $email    = Clean($_POST['email']);
    $role_id  = Clean($_POST['role_id']);

    $errors = [];
    
    if (!validate($name, 1)) {
        $errors['Name'] = " Name Required";
    }elseif (!validate($name, 8)) {
        $errors['Name'] = " name Invalid String  ";
    }
    if (!validate($email, 1)) {
        $errors['Email'] = " Email Required";
    } elseif (!validate($email, 2)) {
        $errors['Email'] = " Email Invalid Field";
    }

    if (!validate($password, 1)) {
        $errors['Password'] = " Password Required";
    } elseif (!validate($password, 3)) {
        $errors['Password'] = " Password Length Must be >= 6 Chars";
    }
    if (!validate($role_id, 1)) {
        $errors['Role'] = " Role Required";
    } elseif (!validate($role_id, 4)) {
        $errors['Role'] = " Role Invalid";
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

        if (empty($image) ) {
            $_SESSION['Message'] = ["Error In Uploading File Try Again"];
        } else {

            $password = md5($password);
            $sql = "insert into users (name,email,password,role_id,image) values ('$name' , '$email' ,'$password',$role_id,'$image')";
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
require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <?php

            displayMessages('Dashboard/Add User');

            ?>
        </ol>
        <div class="container">


            <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="name" placeholder="Enter Name">
                </div>



                <div class="form-group">
                    <label for="exampleInputEmail">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword">New Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                </div>




                <div class="form-group">
                    <label for="exampleInputPassword">Role Type</label>
                    <select class="form-control" name="role_id">

                        <?php
                        while ($Role_data = mysqli_fetch_assoc($rolesOp)) {
                        ?>

                            <option value="<?php echo $Role_data['id']; ?>"><?php echo $Role_data['title']; ?></option>

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