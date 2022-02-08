<?php
$char = 'd';
$the_next_char = ++$char; 
 
if(strlen($the_next_char)> 1)   
{
 $the_next_char = $the_next_char[0];
 }
echo $the_next_char."\n";
?>