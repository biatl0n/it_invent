<?php

$id_city = $it_invent->clearInt($_POST['listCity']);
$id_p_type = $it_invent->clearInt($_POST['listPType']);
$adress = $it_invent->clearStr($_POST['adress']);
$inet_1 = $it_invent->clearStr($_POST['inet_1']);
$inet_2 = $it_invent->clearStr($_POST['inet_2']);

if(empty($adress) or empty($inet_1) or empty($id_city) or empty($id_p_type)){
    $errMsg = 'Заполнены не все обязательные поля (город, тип точки, адрес, интернет)';
}else{
    if ($id_city=='1' or $id_p_type=='7') {
        $errMsg = "Слад уже существует";    
    } else {
        $it_invent->addPoint($adress, $id_city, $id_p_type, $inet_1, $inet_2);
        header ('Location:'.$_SERVER['PHP_SELF']);
        exit;
    }
}

?>
