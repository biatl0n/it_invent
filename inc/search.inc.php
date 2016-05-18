<?php


if (isset($_POST['invN']) && $_POST['serN']==null){
    $invN=$it_invent->clearStr($_POST['invN']);
    $where = " WHERE invN='$invN'";
    $res = $it_invent->queryMaker($where);
}
    
if (isset($_POST['serN']) && !$_POST['invN']){
    $serN=$it_invent->clearStr($_POST['serN']);
    $where = " WHERE tehn.serN='$serN'";
    $res = $it_invent->queryMaker($where);
}

if ($_POST['serN']!="" && $_POST['invN']!=""){
    $serN=$it_invent->clearStr($_POST['serN']);
    $invN=$it_invent->clearStr($_POST['invN']);
    $where = " WHERE tehn.invN='$invN' and tehn.serN='$serN'";
    $res = $it_invent->queryMaker($where);
}

echo <<<LABEL
<table border id="table">
    <tr>
        <th>Город</th>
        <th>Тип точки</th>
        <th>Адрес</th>
        <th>Наименование</th>
        <th>Модель</th>
        <th>Инв N</th>
        <th>Сер N</th>
    </tr>
LABEL;
if(isset($res)){
    $num_rows = 0;
    foreach($res as $item){
        $num_rows++;
        $city = $item['city'];
        $pType = $item['p_type'];
        $adress = $item['adress'];
        $name = $item['name'];
        $model = $item['model'];
        $invN = $item['invN'];
        $serN = $item['serN'];
        echo <<<LABEL
        <tr class="onMove">
            <td><input type="text" class="edit" value="$city"></td>
            <td><input type="text" class="edit" size="5" value="$pType"></td>
            <td><textarea cols="40"  rows="1" class="edit">$adress</textarea></td>
            <td><input type="text" class="edit" value="$name"></td>
            <td><input type="text" class="edit" value="$model"></td>
            <td><input type="text" class="edit" value="$invN"></td>
            <td><input type="text" class="edit" value="$serN"></td>
        </tr>
LABEL;
    }
}
echo <<<LABEL
    <tr>
        <td colspan='6' align="right"><b>Итого:</b></td>
        <td align='center'><b>$num_rows</b></td>
    </tr>
LABEL;
echo "</table>";






?>
