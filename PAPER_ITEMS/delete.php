<?php

require './clasess/items.php';

$ID = $_GET['ID'];
$items = new  items;
$result =  $items->remove($ID);

if($result){
    $_SESSION['Message'] = "Raw Removed";
}else{
    $_SESSION['Message'] = "Error Try Again";
}

header("location: index.php");




?>