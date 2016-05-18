<?php
    require 'classes/IT_invent.class.php';
    $it_invent = new IT_invent;
    $errMsg='';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if (isset($_POST['addPoint'])){
            include 'inc/add_point.inc.php';
        }
        if (isset($_REQUEST['addCity']) or 
            isset($_REQUEST['addPType']) or 
            isset($_REQUEST['addTehn']) or 
            isset($_REQUEST['addModel'])){
                Include 'inc/addToList.inc.php';
            }
        if (isset($_REQUEST['remCity']) or 
            isset($_REQUEST['remPType']) or 
            isset($_REQUEST['remTehn']) or 
            isset($_REQUEST['remModel'])){
                Include 'inc/remFromList.inc.php';
           } 
        if (isset($_REQUEST['queryMaker'])){
            header("Location: queryMaker.php");
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
    <link rel='stylesheet' type='text/css' href='style.css'>
    <script src="ajax.js"></script>
    <title>IT инверт</title>
</head>
<body onLoad="addEvent(); fillOpt(document.getElementsByName('choiceTehnListModel')[0].value, 'remFromListModel');">
<?php 
    if ($errMsg!="")
        echo "<H2>".$errMsg."</H2>"; 
?>
<table cellpadding="0" cellspacing="0" id="body_table" border width="100%">
    <tr>
        <td colspan="2" valign="top" align="center" id="header">
            <h1>IT инвент </h1>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <table id="table" valign="top" border style="margin:10px;">
                    <tr>
                       <th> N
                       <th> Город 
                       <th> Тип точки
                       <th> Адрес
                       <th> Основной канал
                       <th> Резервный канал
                    </tr>
                    <?php include 'inc/getPInfo.inc.php';?>
                    <tr valign="top">
                        <td><input type="submit" name="addPoint" value="+">
                        <td><?php $it_invent->makeSelect('listCity'); ?>
                        <td><?php $it_invent->makeSelect('listPType', null, 57); ?>
                        <!-- <td><input type="text" name="adress" size='55'>
                        td><input type="text" name="inet_1" size='24'> 
                        <td><input type="text" name="inet_2" size='24'> -->
                        <td><textarea name="adress" cols='30' rows="1"> </textarea></td>
                        <td><textarea name="inet_1" cols='19' rows="1"> </textarea></td>
                        <td><textarea name="inet_2" cols='19' rows="1"> </textarea></td>
                    </tr>
                </table>
            </form>
        </td>
        <td align="center" valign="top">
            <h3>Поиск и подсчёт техники</h3>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="submit" name="queryMaker" value="Пуск">
            </form>
            <hr>
            <h3>Фильтр</h3>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <table border  id="table" valign="top" style="margin:10px">
                    <tr>
                        <td>Город:</td>
                        <td><?php $it_invent->makeSelect('listCity', 'cityFilter');?></td>
                    </tr>
                    <tr>
                        <td>Тип точки:</td>
                        <td><?php $it_invent->makeSelect('listPType', 'ptypeFilter'); ?></td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2"><input type="submit" name="upFilter" value="Применить"></td>
                    </tr>
                    <tr>
                        <td align="center" colspan="2"><input type="submit" name="disFilter" value="Отменить"></td>
                    </tr>
                </table>
            </form>
            <hr>
            <h3>Редактор справочников</h3>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <table border  id="table" valign="top" style="margin:10px">
                    <tr>
                        <td align="center"  colspan="2"><h3>Города</h3>
                    </tr>
                    <tr>
                        <td><input type="text" name="City" size="24">
                        <td><input type="submit" name="addCity" value="+">
                    </tr>
                    <tr>
                        <td align="left"><?php $it_invent->makeSelect('listCity', 'remFromListCity');?>
                        <td><input type="submit" name="remCity"  value="&nbsp;-">
                    </tr>
                    <tr>
                        <td align="center" colspan="2"><h3>Типы точек</h3>
                    </tr>
                    <tr>
                        <td><input type="text" name="PType" size="24">
                        <td><input type="submit" name="addPType" value="+">
                    </tr>
                     <tr>
                        <td align="left"><?php $it_invent->makeSelect('listPType', 'remFromListPType');?>
                        <td><input type="submit" name="remPType" value="&nbsp;-">
                    </tr>
                    <tr>
                        <td align="center" colspan="2"><h3>Категории техники</h3>
                    </tr>
                    <tr>
                        <td><input type="text" name="Tehn" size="24">
                        <td><input type="submit" name="addTehn" value="+">
                    </tr>
                    <tr>
                        <td align="left"><?php $it_invent->makeSelect('listTehn', 'remFromListTehn');?>
                        <td><input type="submit" name="remTehn" value="&nbsp;-">

                    </tr>
                    <tr>
                        <td align="center" colspan="2"><h3>Модели техникии</h3>
                    </tr>
                    <tr>
                        <td align="left" colspan="2"><?php $it_invent->makeSelect('listTehn', 'choiceTehnListModel'); ?>
                    </tr>
                    <tr>
                        <td><input type="text" name="model" size="24">
                        <td><input type="submit" name="addModel" value="+">
                    </tr>
                    <tr>
                        <td align="left" ><?php $it_invent->makeSelect('listModel', 'remFromListModel');?>
                        <td><input type="submit" name="remModel" value="&nbsp;-">
                    </tr>
                </table>
            </form>
            <hr>
            <h3>Корзина</h3>
            <form action="trash.php" method="POST">
                <input type="submit" name="trash" value="Trash">
            </form>
            <hr>
        </td>
    </tr>
</table>


<!-- _____________________________________________________________________ 


<table>
    <tr>
        <th>point
        <th>tehn
        <th>listTehn
        <th>listModel
        <th>delPoint
        <th>delTehn
    </tr>
    <tr>
        <td valign="top">
            <?php
                echo "<pre>";
                print_r ($it_invent->showTable('point'));
                echo "</pre>";
            ?>
        </td>
        <td valign="top">
            <?php
                echo "<pre>";
                print_r ($it_invent->showTable('tehn'));
                echo "</pre>";
            ?>
        </td>
        <td valign="top">
            <?php
                echo "<pre>";
                print_r ($it_invent->showTable('listTehn'));
                echo "</pre>";
            ?>
        </td>
        <td valign="top">
            <?php
                echo "<pre>";
                print_r ($it_invent->showTable('listModel'));
                echo "</pre>";
            ?>
        </td>
        <td valign="top">
            <?php
                echo "<pre>";
                print_r ($it_invent->showTable('delPoint'));
                echo "</pre>";
            ?>
        </td>
        <td valign="top">
            <?php
                echo "<pre>";
                print_r ($it_invent->showTable('delTehn'));
                echo "</pre>";
            ?>
        </td>
    </tr>
</table>
_____________________________________________________________________________________________-->

</body>
</html>
