<?php

$ini_array = parse_ini_file("tehn.ini", true);
$i=0;

foreach($ini_array as $key=>$value){
    foreach ($value as $key2=>$val2){
        echo "id=".$i." ".$key.", ".$val2."<br>";
    }
    echo "<br>";
    $i++;
}

$ini_array = parse_ini_file("point.ini");

foreach($ini_array as $key=>$value){
    echo $key.' '.$value.'<br>';
}


?>
