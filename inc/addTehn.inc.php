<?php


if(isset($_POST['id_p']))
    $id_p = $it_invent->clearInt($_POST['id_p']);
if(isset($_POST['addTehn']))
    $id_tehn = $it_invent->clearInt($_POST['addTehn']);
if(isset($_POST['addModel']))
    $id_model = $it_invent->clearInt($_POST['addModel']);
if(isset($_POST['invN']))
    $invN = $it_invent->clearStr($_POST['invN']);
if(isset($_POST['serN']))
    $serN = $it_invent->clearStr($_POST['serN']);


if(isset($id_model) && isset($id_tehn)){
    if ($it_invent->addTehn($id_p, $id_tehn, $id_model, $invN, $serN)){
        header('Location:'.$_SERVER['REQUEST_URI']);
        exit;
    } else {
        $errMsg = "Техника с таким инвентарным/серйныйм уже имеется.";
    }
}else{
    $errMsg = "Необходимо выбрать категорию и модель!";
}

?>
