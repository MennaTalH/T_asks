<?php
$bill = readline ('enter bill:');

$total_cost=0;
if ($bill <=50)
 {
    # code...
    $total_cost += 3.5*$bill;
}
elseif ($bill <=50 && $bill>=150) 
{
    # code...
    $total_cost += 3.5*50;
    $total_cost += 4*($bill-50);
}
else {
    $total_cost += 3.5*50 +4 * 100 ;
    $total_cost += 6.5*($bill - 150);
}
echo $total_cost;



?>