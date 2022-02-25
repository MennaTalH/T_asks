<?php
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkAdmin.php';
$id = $_GET['id'];
$sql = "select * from users where id = $id";
$op = mysqli_query($con, $sql);
$UserData = mysqli_fetch_assoc($op);

$sql = "select * from roles";
$role_op  = mysqli_query($con, $sql);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name     = Clean($_POST['name']);
    $email    = Clean($_POST['email']);
    $role_id  = Clean($_POST['role_id']);
    $errors = [];
    if (!validate($name, 1)) {
        $errors['Name'] = " Title Required";
    }
    if (!validate($email, 1)) {
        $errors['Email'] = " Email Required";
    } elseif (!validate($email, 2)) {
        $errors['Email'] = " Email Invalid Field";
    }
    if (!validate($role_id, 1)) {
        $errors['Role'] = " Role Required";
    } elseif (!validate($role_id, 4)) {
        $errors['Role'] = " Role Invalid";
    }
    if (validate($_FILES['image']['name'], 1)) {

        if (!validate($_FILES['image']['name'], 5)) {
            $errors['Image']  = "Image : Invalid Extension";
        }
    }
    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        if (validate($_FILES['image']['name'], 1)) {
            $image = uploadFile($_FILES);
            if (!empty($image)) {
                unlink('./uploads/' . $UserData['image']);
            }
        } else {
            $image = $UserData['image'];
        }
        $sql = "update users  set name =  '$name' , email = '$email' , role_id = $role_id , image = '$image' where id = $id";
        $op  = mysqli_query($con, $sql);

        if ($op) {
            $message = ["Raw Updated"];
            $_SESSION['Message'] = $message;

            header("Location: index.php");
            exit();
        } else {
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
            <form action="edit.php?id=<?php echo  $UserData['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="name" value="<?php echo $UserData['name'] ?>" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $UserData['email'] ?>" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword">Role Type</label>
                    <select class="form-control" name="role_id">

                        <?php
                        while ($Role_data = mysqli_fetch_assoc($role_op)) {
                        ?>

                            <option value="<?php echo $Role_data['id']; ?>" <?php if ($UserData['role_id'] == $Role_data['id']) {
                           echo 'selected';
                              } ?>><?php echo $Role_data['title']; ?></option>

                        <?php }  ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword">Image</label>
                    <input type="file" name="image">
                </div>
                <br>
                <img src="./uploads/<?php echo $UserData['image']; ?>" height="50" width="50" alt="">
                <br>

                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
</main>
<?php
require '../layouts/footer.php';
?>