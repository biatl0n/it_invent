<?php
    require 'classes/IT_invent.class.php';
    $it_invent = new IT_invent;
    $errMsg = '';
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['remPoint'])){
            include 'inc/remPoint.inc.php';
        }
        if(isset($_POST['remTehn'])){
            include 'inc/remTehn.inc.php';
        }
        if(isset($_POST['newTehn'])){
            include 'inc/addTehn.inc.php';
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
    <link rel='stylesheet' type='text/css' href='style.css'>
    <script src="ajax.js"></script>
    <script src="java.js"></script>
    <script>
        function onPointDelete()
        {
           if(confirm("Удалить?")){return true;}
           else {return false;}
        }
        function onTehnDelete()
        {
            if(confirm("Удалить? Техника будет перемещена в корзину."))
                {
                }
            else {return false;}
        }
    </script> 
    <title>IT инвент</title>
</head>
<body onLoad="addEventTehn(); fillOpt(document.getElementsByName('addTehn')[0].value, 'addModel');" >
    <?php 
        if ($errMsg!="")
            echo "<h1 align='center'>".$errMsg."</h1>"
    ?>
    <table border cellpadding="0" cellspacing="0"  id="body_table">
        <tr>
            <td id="header" colspan="2">
                <form action="it_invent.php" method="POST"> 
                    <input id="goHome" type="submit" value="Назад"> 
                </form>
                <h1>Подробно о точке</h1>
            </td> 
        </tr>
        <tr>
            <td valign="top" width="50%">
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                    <?php include "inc/getItemPointInfo.inc.php" ?>
                    <table style="margin: 10px;">
                        <tr>
                        <?php
                            if ($_GET['id_p']!='1'){
                                echo "
                                <td> 
                                    Причина удаления:<input type='text' name='delReason' value='Закрытие точки'> 
                                </td>
                                <td> 
                                    <input type='submit' name='remPoint' value='Удалить' onClick=\"return onPointDelete();\"><br> 
                                </td>";
                            }
                        ?>
                        </tr>
                    </table>
                </form>
            </td>
            <td valign="top">
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                <table border  id="table" valign="top" style="margin:10px">
                    <tr>
                        <th>&nbsp;
                        <th>N
                        <th>Категория
                        <th>Модель
                        <th>Инв N
                        <th>Сер N
                    </tr>
                    <?php include 'inc/getTInfo.inc.php'; ?>
                     <tr>
                        <td>&nbsp;
                        <td><input type="submit" name="newTehn" value="+">
                            <input type="hidden" name="id_p" value="<?php echo $_GET['id_p']; ?>">
                        <td><?php $it_invent->makeSelect('listTehn', 'addTehn'); ?>
                        <td><?php $it_invent->makeSelect('listModel', 'addModel'); ?>
                        <td><input type="text" name="invN" size="25">
                        <td><input type="text" name="serN" size="25">
                    </tr>
                 </table>
                 </form>

                <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="POST" id="delTehn">
                    <table style="margin: 10px;" >
                        <tr>
                            <td> Причина удаления:<input type="text" name="delReason" value="Техническая неисправность"> </td>
                            <td><input type="submit" name="remTehn" value="Удалить" onClick="return onTehnDelete();"> </td>
                        </tr>
                        <tr>
                            <td colspan="2"> 
                                <input type="hidden" name="id_p" value="<?php echo $_GET['id_p']; ?>">
                                <input type="submit" name="moveTehn" value="Переместить" onClick="movTehn();">  
                                <input type="button" name="Go" value="Изменить" onClick="unlockText()">
                            </td>
                        </tr>
                    </table>
                </form>

            </td>
        </tr>
    </table>
</body>
</html>
