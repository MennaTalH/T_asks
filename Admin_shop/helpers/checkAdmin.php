<?php 

   if($_SESSION['User']['role_id'] != 4){

    header("location: ".url('index.php'));
   
}



?>