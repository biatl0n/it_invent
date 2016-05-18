<?php
require 'classes/IT_invent.class.php';
$it_invent = new IT_invent;
$errMsg="";

if(isset($_POST['id_t']) && !isset($_GET['id_delTehn'])){
    $id_p = $it_invent->clearInt($_GET['id_p']);
    $id_t = $it_invent->clearInt($_POST['id_t']);
    header ("Location: ".$_SERVER['PHP_SELF']."?id_p=$id_p&id_t=$id_t");
} 

if (isset($_GET['id_delTehn'])){
    $id_delTehn = $it_invent->clearInt($_GET['id_delTehn']);
    $result = $it_invent->getItemDelTehnInfo($id_delTehn);
}

if (isset($_GET['id_t']) && isset($_GET['id_p']) && !isset($_GET['id_delTehn'])){
    $id_p = $it_invent->clearInt($_GET['id_p']);
    $id_t = $it_invent->clearInt($_GET['id_t']);
    $result = $it_invent->getItemTehnInfo($id_t);
}


if ($_SERVER['REQUEST_METHOD']=='POST' && !isset($_GET['id_delTehn'])){
    if(isset($_POST['movTehn']) && isset($_POST['selectedPoint'])){
        include 'inc/movTehn.inc.php';
    } else {
        $errMsg = "Не выбрана точка назначения...";
    }
}

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['movTehn'])){
    if (isset($_GET['id_delTehn']) && isset($_POST['selectedPoint'])){
        include 'inc/movTehn.inc.php';
    } else { 
        $errMsg = "Не выбрана точка назначения...";
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
    <link rel='stylesheet' type='text/css' href='style.css'>
    <script src="ajax.js"></script>
    <title>IT инвент</title>
</head>
<body>
<?php 
    if ($errMsg!="") echo "<h1 align='center'>".$errMsg."</h1>"
?>
<table border width="100%" cellpadding="0" cellspacing="0"  id="body_table">
    <tr>
        <td id="header" colspan="2">
            <form action="
            <?php 
                if(isset($_GET['id_p'])){
                    $id_p=$_GET["id_p"]; 
                    echo str_replace("moveTehn.php","brows.php?id_p=$id_p",$_SERVER['PHP_SELF']); 
                }else{
                    echo str_replace("moveTehn.php","trash.php",$_SERVER['PHP_SELF']); 
                }
            ?>" 
            method="POST">
                <input id="goHome" type="submit" value="Назад"> 
            </form>
            <h1>Перемещение техники</h1>
        </td> 
    </tr>
    <tr>
        <td valign="top" width="50%">
            <table cellpadding="3px" border id="table">
                <tr>
                    <th colspan="4" align="center">Переместить </th>
                </tr>
                <tr>
                    <th>Категория</th>
                    <th>Модель</th>
                    <th>Инв №</th>
                    <th>Сер №</th>
                </tr>
                <tr>
                    <td>
                        <input type="text" class="edit" readonly value="<?php echo $result[0]['name'];?>" />
                        <input form="sel" type="hidden" class="edit" name="id_tt" value="<?php echo $id_t;?>" />
                    </td>
                    <td><input type="text" class="edit" readonly value="<?php echo $result[0]['model'];?>" /></td>
                    <td><input type="text" class="edit" readonly value="<?php echo $result[0]['invN'];?>" /></td>
                    <td><input type="text" class="edit" readonly value="<?php echo $result[0]['serN'];?>" /></td>
                </tr>
            </table> 
        </td>
        <td valign="top">
            <table cellpadding="3px" border id="table">
                <tr>
                    <th colspan="4">Куда</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>Город</th>
                    <th>Тип</th>
                    <th>Адрес</th>
                </tr>
                    <?php include 'inc/getPointsForMove.inc.php';?>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2"> 
        <form id="sel" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
            <input type="SUBMIT" name="movTehn"  value="Переместить">
        </form>
        </td>
    </tr>
</table>
</body>
</html>
