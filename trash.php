<?php
    require 'classes/IT_invent.class.php';
    $it_invent = new IT_invent;
    $errMsg='';
?>
<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
    <link rel='stylesheet' type='text/css' href='style.css'>
    <script src="ajax.js"></script>
    <script src="java.js"></script>
    <title>IT_INVENT HCFB</title>
</head>
<body style="margin:0">

<table id="boey_table" cellpadding="0" cellspacing="0" border width="100%" >
    <tr>
        <th id="header" colspan="2">
            <form action="it_invent.php" method="POST"> 
                <input id="goHome"  type="submit" value="Назад"> 
            </form>
            <h1>Корзина</h1>
        </th>
    </tr>
    <tr>
        <td width="50%" height="500px" valign="top"> 
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <table border  id="table" width="97%" valign="top" style="margin:10px">
                <tr>
                    <th colspan="8"><h2>Удалённые точки</h2></th>
                </tr>
                <tr>
                    <th>N</th>
                    <th>Город</th>
                    <th>Тип точки</th>
                    <th>Адрес</th>
                    <th>Основной канал</th>
                    <th>Резервный канал</th>
                    <th>Дата удаления</th>
                    <th>Причина удаления</th>
                </tr>
                <?php include "inc/delPointsTable.inc.php"; ?>
            </table>
            <table style="margin:10px;">
                <tr>
                    <td id="td_1"> <input type="submit" name="moveDeletedPoint" value="Восстановить"></td>
                </tr>
            </table>
        </form>
        </td>
        <td height="500px" valign="top"> 
        <form id="delTehn" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <table border  id="table" width="97%" valign="top" style="margin:10px">
                <tr>
                    <th colspan="7"><h2>Удалённая техника</h2></th>
                </tr>
                <tr>
                    <th>N</th>
                    <th>Наименование</th>
                    <th>Модель</th>
                    <th>Инв N</th>
                    <th>Сер N</th>
                    <th>Дата удаления</th>
                    <th>Причина удаления</th>
                </tr>
                <?php include "inc/delTehnTable.inc.php"; ?>
            </table>
            <table style="margin:10px;">
                <tr>
                    <td id="td_1"> <input type="submit" name="moveDeletedTehn" value="Переместить" onClick="movDelTehn();"></td>
                </tr>
            </table>
        </form>
        </td>
    </tr>
</table>

</body>
</html>
