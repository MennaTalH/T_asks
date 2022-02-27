<?php  
 class Validator{
    function Clean($input, $flag = 0)
{
    $input =  trim($input);
    if ($flag == 0) {
        $input =  filter_var($input, FILTER_SANITIZE_STRING);   
    }
    return $input;
}
function validate($input,$flag){
    $status = true;
      switch ($flag) {
          case 1:
               if(empty($input)){
                  $status = false;
               }
              break;
        case 2: 
            if(!filter_var($input,FILTER_VALIDATE_STRING)){
                $status = false;
            }
            break;
        case 3:  
            if(strlen($input)<6){
                $status = false;
            }    
            break;
        case 4: 
            if(!filter_var($input,FILTER_VALIDATE_STRING)){
                $status = false;
            }    
            break;
            

        case 5: 
            $nameArray =  explode('.', $input);
            $imgExtension =  strtolower(end($nameArray));
            $allowedExt = ['png', 'jpg'];
            if (!in_array($imgExtension, $allowedExt)) {
                $status = false;
            }
          break;
            case 6:          
                   if(!preg_match('/^01[0-2,5][0-9]{8}$/',$input)){
                    $status = false;
                   }
                break;       

}

return $status;
}

 }