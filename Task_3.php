<?php
$nameErr = $emailErr = $genderErr = $LinkedinErr = $passcodeErr =  "";
$name = $email = $gender = $Address = $Linkedin = $paascode = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
  if (empty($_POST["name"])) {
    $nameErr = "*";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = " ";
    }
  }
  if (empty($_POST["password"])) {
    $passcodeErr = "*";
  } else {
    $paascode = test_input($_POST["password"]);
    
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "*";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "";
    }
  }
    
  if (empty($_POST["Linkedin _ URL"])) {
    $Linkedin = "*";
  } else {
    $Linkedin = test_input($_POST["website"]);
    
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$Linkedin)) {
      $LinkedinErr = " ";
    }    
  }

  if (empty($_POST["Adrress"])) {
    $Address = "";
  } else {
    $Address = test_input($_POST["Adrress"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "*";
  } else {
    $gender = test_input($_POST["gender"]);
  }
  if ($_SERVER['REQUEST_METHOD'] == "POST") 
    if (!empty($_FILES['image']['name'])) {

        $imgName  = $_FILES['image']['name'];
        $imgTemp  = $_FILES['image']['tmp_name'];
        $imgType  = $_FILES['image']['type'];
        $nameArray =  explode('.', $imgName);
        $imgExtension =  strtolower(end($nameArray));
        $imgFinalName = time() . rand() . '.' . $imgExtension;
        $allowedExt = ['png', 'jpg'];
        if (in_array($imgExtension, $allowedExt)) {
            $disPath = 'uploads/' . $imgFinalName;
            if (move_uploaded_file($imgTemp, $disPath)) {
                echo 'File Uploaded';
            } else {
                echo 'Error In Uploading Try Again';
            }
        } else {
            echo 'InValid Extension';
        }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<h2>Registration page </h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Password: <input type="password" name="password" >
  <span class="error">* <?php echo $passcodeErr;?></span>
  <br>
  <br>

  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Linkedin : <input type="text" name="website">
  <span class="error"><?php echo $LinkedinErr;?></span>
  <br><br>
  Address: <textarea name="Address" rows="2" cols="25"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <div class="form-group">
                <label for="exampleInputPassword">Image</label>
                <input type="file" name="image">
            </div>
  <input type="submit" name="submit" value="Submit">  
</form>
</body>
</html>