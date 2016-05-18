<?php

if(isset ($_REQUEST['remCity'])){
    $data = $it_invent->clearInt($_POST['remFromListCity']);
    if($data==1){
        $errMsg = "Заблокировано. Обратитесь к администратору";    
    } else {
        $tableName = "listCity";
        $rowName = "id_city";
        if(empty($data)){
            $errMsg = 'Значение не выбрано!!!';
        }else{
            if (!$it_invent->getCount($rowName, 'point', $data)){
                $it_invent->remFromList($tableName, $rowName, $data);
                header ('Location: it_invent.php');
            }else{
                $errMsg = 'Нельзя удалить город пока к нему привязана хоть одна точка!!!';
            }
        }
    }
}


if(isset ($_REQUEST['remPType'])){
    $data = $it_invent->clearInt($_POST['remFromListPType']);
    if($data>=0 && $data<=7){
        $errMsg = "Заблокировано. Обратитесь к администратору.";
    } else {
        $tableName = "listPType";
        $rowName = "id_p_type";
        if(empty($data)){
            $errMsg = 'Значение не выбрано!!!';
        }else{
            if (!$it_invent->getCount($rowName, 'point', $data)){
                $it_invent->remFromList($tableName, $rowName, $data);
                header ('Location: it_invent.php');
            }else{
                $errMsg = "Имеются связанные с объектом строки!";
            }
        }
    }
}

if(isset($_REQUEST['remTehn'])){
    $data = $it_invent->clearInt($_POST['remFromListTehn']);
    if($data>=100 && $data<=106){
        $errMsg = "Заблокировано. Обратитесь к администратору.";
    } else {
        $tableName = "listTehn";
        $rowName = "id_tehn";
        if(empty($data)){
            $errMsg = 'Значение не выбрано!!!';
        }else{
            if (!$it_invent->getCount($rowName, 'tehn', $data) and
            !$it_invent->getCount($rowName, 'listModel', $data)){
                $it_invent->remFromList($tableName, $rowName, $data);
                header ('Location: it_invent.php');
            }else{
                $bla = $it_invent->getCount($rowName, 'tehn', $data);
                $errMsg = "Имеются связанные с объектом строки! $bla";
            }
        }
    }
}

if(isset($_REQUEST['remModel'])){
    $data = 0;
    if(isset($_POST['remFromListModel']))
        $data = $it_invent->clearInt($_POST['remFromListModel']);
    if($data>=0 && $data<=140){
        $errMsg = "Заблокировано. Обратитесь к администратору.";
    } else {
        $tableName = "listModel";
        $rowName = "id_model";
        if(empty($data)){
            $errMsg = 'Значение не выбрано!!!';
        }else{
            if (!$it_invent->getCount($rowName, 'tehn', $data)){
                $it_invent->remFromList($tableName, $rowName, $data);
                header ('Location: it_invent.php');
            }else{
                $errMsg = "Имеются связанные с объектом строки!";
            }
        }
    }
}
?>
