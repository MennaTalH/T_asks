<?php
session_start();
if($_POST){
    $errors = [];
    $success = [];
    if(empty($_POST['name'])){
        $errors['name'] = "<div class='alert alert-danger'> Enter Valid Name </div>";
    }
    if(empty($_POST['address'])){
        $errors['address'] = "<div class='alert alert-danger'> Enter Valid Address </div>";
    }
    if(empty($_POST['gender'])){
        $errors['gender'] = "<div class='alert alert-danger'> Enter Valid Gender </div>";
    }
    if(empty($errors)){
        $_SESSION['user']->name = $_POST['name'];
        $_SESSION['user']->address = $_POST['address'];
        $_SESSION['user']->gender = $_POST['gender'];
        $success['updated'] = "<div class='alert alert-success'> Data Updated Successfully </div>";
    }
    $_SESSION['errors'] = $errors;
    $_SESSION['success'] = $success;
    header('location:../profile.php');die;
}else{
    echo "Method Not Allowed";die;
}