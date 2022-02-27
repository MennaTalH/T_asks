<?php 
session_start();
require 'validator.php';
require 'dbConnection.php';
class items{
    private $title;
    private $content;
    private $image; 
    private $result = null;
    public function paper($data){ 
     $validator = new Validator;
     $this->title      = $validator->Clean($data['title']); 
     $this->content    = $validator->Clean($data['content']);
     $this->image      = $validator->Clean($data['image']);   
     $errors = [];
     if(!$validator->validate($this->title,1)){
        $errors['title'] = "Field Required";
     }elseif(!$validator->validate($this->title,8)){
        $errors['title'] = "Invalid String";
     }
     if(!$validator->validate($this->content,1)){
        $errors['content'] = "Field Required";
     }elseif(!$validator->validate($this->email,2)){
        $errors['content'] = "Invalid content";
     }
     if (!$validator->validate($this->image)) {
      $errors['Image']  = "Image Required";
  } elseif (!$validator->validate($this->image)) {
      $errors['Image']  = "Image : Invalid Extension";
  }
 
     if(count($errors) > 0 ){
        $this->result = $errors;
    }else{ 
       $dbObj = new DB;
       $sql = "insert into paper_items (title,content,image) values ('$this->title','$this->content','$this->image')";
       $op = $dbObj->doQuery($sql); 
       if($op){
           $this->result = ["Success" => "data Inserted"];
       }else{
        $this->result = ["Error" => "Error Try Again"];
       }
    }
        return $this->result;
}
    public function showData(){
      $dbObj = new DB;
      $sql = "select * from paper_items"; 
      $result = $dbObj->doQuerySelect($sql);
      return $result;
    }
    public function remove($id){
      $dbObj = new DB;
      $sql = "delete from paper_items where ID = $ID"; 
      $this->result = $dbObj->doQuery($sql); 
        return $this->result; 

    }

}


?>