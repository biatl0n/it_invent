<?php

$delDate = date("Y-m-d H:i:s");
$delReason = $_POST['delReason'];
if(isset($_POST['id_t'])){
    $tehn = $it_invent->remTehn($_POST['id_t'], $delReason, $delDate);
    header ('Location:'.$_SERVER['REQUEST_URI']);
} else { $errMsg="Объект не выбран";}

?>
