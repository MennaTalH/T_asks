<?php 
class DB{
    var $Host       = "localhost";
    var $DBUser     = "root";
    var $DBPassword = "";
    var $DBName     = "paper"; 
    var $con        = null;
       function __construct()
       {
        $this->con =  mysqli_connect($this->Host,$this->DBUser,$this->DBPassword,$this->DBName);     
       if(!$this->con){
         die ('Error : '. mysqli_connect_error());    
          }
       }
       function doQuery($sql){
        $op = mysqli_query($this->con,$sql); 
        if($op){
            $status = true;
        }else{
            $status = false;
        }
        return $status;
       }
       function doQuerySelect($sql){
        $result = mysqli_query($this->con,$sql); 
        $data = [];
        while($raw = mysqli_fetch_assoc($result)){
             $data[] = $raw;
        }
        return $data;
       }
       function __destruct()
       {
           mysqli_close($this->con);
       }
}

$obj = new DB();

$sql = "insert into paper_items (title) values ('Image pro')";


$result = $obj->doQuery($sql);

if($result){
    echo '* Data inserted';
}else{
    echo '* error try again';
}


$sql = "delete from paper_items where ID = $ID";


$result = $obj->doQuery($sql);

if($result){
    echo '* Data removed';
}else{
    echo '* error try again';
}




?>