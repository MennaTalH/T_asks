<?php
$title = "Profile";
include_once "layouts/header.php";
include_once "middlewares/auth.php"; 
include_once "layouts/nav.php";

?>
<div class="contianer">
  <div class="row">
    <div class="offset-3 col-6">
      <form action="post/profile.php" method="post">
        <div class="row">
          <div class="col-12 text-center text-success h1 mt-5">
            My Profile
          </div>
          <div class="col-12">
              <?php 
                if(!empty($_SESSION['success'])){
                    echo $_SESSION['success']['updated'];
                }

                if(!empty($_SESSION['errors'])){
                    foreach ($_SESSION['errors'] as $key => $value) {
                      echo $value;
                    }
                }
              ?>
          </div>
          <div class="offset-4 col-4 my-5">
              <img src="assets/images/<?= $_SESSION['user']->image ?>" class="w-100 rounded-circle" alt="<?= $_SESSION['user']->name ?>">
              <input type="file" name="" id="">
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="">Name</label>
              <input type="text" name="name" value="<?= $_SESSION['user']->name ?>" id="" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="">Address</label>
              <input type="text" name="address" value="<?= $_SESSION['user']->address ?>" id="" class="form-control"
               placeholder="" aria-describedby="helpId">
            </div>
            <div class="col-6">
            <div class="form-group">
              <label for="">Linkedin</label>
              <input type="text" name="linkedin" value="<?= $_SESSION['user']->address ?>" id="" class="form-control"
               placeholder="" aria-describedby="helpId">
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="">Gender</label>
              <select class="form-control" name="gender" id="">
                <option <?php if($_SESSION['user']->gender == 'm'){ echo "selected"; } ?> value="m">Male</option>
                <option <?= ($_SESSION['user']->gender == 'f') ? 'selected' : '' ?> value="f">Female</option>
              </select>
            </div>
          </div>
          <div class="col-12 text-center">
            <button class="d-block m-auto btn btn-outline-dark"> Update My Profile </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
include_once "layouts/footer.php";
unset($_SESSION['errors']);
unset($_SESSION['success']);
?>