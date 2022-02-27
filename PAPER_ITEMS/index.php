<?php
   require './clasess/items.php';

   $items = new  items;
   $data =  $items->showData();

?>
<!DOCTYPE html>
<html>

<head>
    <title>items</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Read Students </h1>
            <br>

        </div>
      <?php 
      
         if(isset($_SESSION['Message'])){

            echo $_SESSION['Message'];
           
            unset($_SESSION['Message']); 
        }
      
      ?>
        <a href="create.php">+ Account</a>

        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <th>ID</th>
                <th>title</th>
                <th>content</th>
                <th>image</th>
                <th>action</th>
            </tr>

            <?php
            foreach ($data as $key => $value) {
    
            ?>
            <tr>
                <td><?php  echo $value['ID']; ?></td>
                <td><?php  echo $value['title'];   ?></td>
                <td><?php  echo $value['content']; ?></td>
                <td> <img src=./uploads/<?php echo $data['image']; ?>> </td>

                <td>
                    <a href='delete.php?ID=<?php echo $value['ID']  ?>' class='btn btn-danger m-r-1em'>Delete</a>
                </td>
            </tr>

            <?php  } 
            ?>
        </table>

            </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>