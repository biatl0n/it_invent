<?php
    require 'classes/IT_invent.class.php';
    $it_invent = new IT_invent;
    $id_tehn = $_GET['sel'];
    $newArr = array();

    $arr = ($it_invent->fillModelsAjax($id_tehn));
    foreach ($arr as $item){
        $newArr[$item['id_model']]=$item['model'];
    }

    $arr = json_encode($newArr);
    echo $arr;
?>
