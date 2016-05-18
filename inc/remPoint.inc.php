<?php

$_GET['id_p']=$_POST['id_p'];
$id_p = $_POST['id_p'];
$delReason = $_POST['delReason'];
$delDate = date("Y-m-d H:i:s");

$count = $it_invent->getCount('id_p', 'tehn', $id_p);
if(!$count){
    $it_invent->remPoint($id_p, $delReason, $delDate);
    header ('Location: it_invent.php');
}else{
    $errMsg = "Сперва переместите/удалите технику.";
}
?>
