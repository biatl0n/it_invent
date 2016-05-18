<?php

if (isset($_REQUEST['addCity'])){
    $data = $it_invent->clearStr($_POST['City']);
    $tableName = "listCity" ;
    $rowName = "City";
    if(empty($data)){
        $errMsg = 'Введите название города!!!';
    }else{
        $double = $it_invent->doubleFinder($tableName, $rowName, $data);
        $double = $double[0];
        if ($double>0){
            $errMsg = 'Такой город уже существует';
        }else{
            $it_invent->addToList($tableName, $rowName, $data);
            header ('Location:'.$_SERVER['PHP_SELF']);
            exit;
        }
    }
}

if (isset($_REQUEST['addPType'])){
    $data = $it_invent->clearStr($_POST['PType']);
    $tableName = "listPType" ;
    $rowName = "p_type";
    if(empty($data)){
        $errMsg = 'Введите тип точки!!!';
    }else{
        $double = $it_invent->doubleFinder($tableName, $rowName, $data);
        $double = $double[0];
        if ($double>0){
            $errMsg = 'Такой тип точек уже существует';
        }else{
            $it_invent->addToList($tableName, $rowName, $data);
            header ('Location:'.$_SERVER['PHP_SELF']);
            exit;
        }
    }
}

if (isset($_REQUEST['addTehn'])){
    $data = $it_invent->clearStr($_POST['Tehn']);
    $tableName = "listTehn" ;
    $rowName = "name";
    if(empty($data)){
        $errMsg = 'Введите наименование техники!!!';
    }else{
        $double = $it_invent->doubleFinder($tableName, $rowName, $data);
        $double = $double[0];
        if ($double>0){
            $errMsg = 'Такой бренд техники уже существует';
        }else{
            $it_invent->addToList($tableName, $rowName, $data);
            header ('Location:'.$_SERVER['PHP_SELF']);
            exit;
        }
    }
}

if (isset($_REQUEST['addModel'])){
    $data = $it_invent->clearStr($_POST['model']);
    if(isset($_POST['choiceTehnListModel'])) {
        $data2 = $it_invent->clearInt($_POST['choiceTehnListModel']);
    }else{$data2 = 0;}

    $tableName = "listModel" ;
    $row_1_Name = "model";
    $row_2_Name = "id_tehn";
    if(empty($data) or !$data2){
        $errMsg = 'Введите наименование модели техники!!!';
    }else{
        $double = $it_invent->doubleFinder($tableName, $row_1_Name, $data);
        $double = $double[0];
        if ($double>0){
            $errMsg = 'Такая модель техники уже существует';
        }else{
            $it_invent->addToList($tableName, $row_1_Name, $data, $row_2_Name, $data2);
            header ('Location:'.$_SERVER['PHP_SELF']);
            exit;
        }
    }
}
?>
