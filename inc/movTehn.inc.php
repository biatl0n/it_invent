<?php

if (isset($_POST['id_tt']))
    $id_t=$_POST['id_tt'];

if (isset($_POST['selectedPoint']))
    $id_p=$_POST['selectedPoint'];

if (isset($_GET['id_delTehn']))
    $id_delTehn2=$_GET['id_delTehn'];


if($id_t!=NULL && $id_p!=NULL && $id_delTehn2==NULL){
    if ($it_invent->movTehn($id_t, $id_p)){
        $ref = str_replace("moveTehn.php","brows.php?id_p=$id_p", $_SERVER['PHP_SELF']);
        header("Location: ".$ref);
    }
}

if($id_delTehn2!=NULL && $id_p!=NULL){
   if ($it_invent->movDelTehn($id_delTehn, $id_p)){
        $ref = str_replace("moveTehn.php","brows.php?id_p=$id_p", $_SERVER['PHP_SELF']);
        header("Location: ".$ref);
   }
}

?>
