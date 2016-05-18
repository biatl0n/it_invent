<?php
$listCity = $_POST['listCity'];
$listPType = $_POST['listPType'];
$addTehn = $_POST['addTehn'];
$addModel = $_POST['addModel'];

if($listCity!='NULL' && ($listPType=='NULL'&& $addTehn=="NULL" && $addModel=="0")){
    $where = " WHERE id_city='$listCity' ORDER BY listCity.city";
    $res = $it_invent->queryMaker($where);
}

if($listPType!='NULL' && ($listCity=='NULL'&& $addTehn=="NULL" && $addModel=="0")){
    $where = " WHERE id_p_type='$listPType' ORDER BY listCity.city";
    $res = $it_invent->queryMaker($where);
}

if($addTehn!='NULL' && ($listCity=='NULL'&& $listPType=="NULL" && $addModel=="0")){
    $where = " WHERE listTehn.id_tehn='$addTehn' ORDER BY listCity.city";
    $res = $it_invent->queryMaker($where);
}

if($addTehn!='NULL' && $addModel!='0' && ($listCity=='NULL'&& $listPType=="NULL")){
    $where = " WHERE listTehn.id_tehn='$addTehn' and listModel.id_model='$addModel' ORDER BY listCity.city";
    $res = $it_invent->queryMaker($where);
}

if($listCity!='NULL' && $listPType!='NULL' && ($addTehn=='NULL'&& $addModel=="0")){
    $where = " WHERE listCity.id_city='$listCity' and listPType.id_p_type='$listPType' ORDER BY listCity.city";
    $res = $it_invent->queryMaker($where);
}

if($listCity!='NULL' && $addTehn!='NULL' && ($listPType=='NULL'&& $addModel=="0")){
    $where = " WHERE listCity.id_city='$listCity' and listTehn.id_tehn='$addTehn' ORDER BY listCity.city";
    $res = $it_invent->queryMaker($where);
}

if($addTehn!='NULL' && $addModel!='0' && $listCity!='NULL' && ($listPType=="NULL")){
    $where = " WHERE listCity.id_city='$listCity'  and listTehn.id_tehn='$addTehn' and listModel.id_model='$addModel' ORDER BY listCity.city";
    $res = $it_invent->queryMaker($where);
}

if($listPType!='NULL' && $addTehn!='NULL' && ($listCity=='NULL'&& $addModel=="0")){
    $where = " WHERE listPType.id_p_type='$listPType' and listTehn.id_tehn='$addTehn' ORDER BY listCity.city";
    $res = $it_invent->queryMaker($where);
}

if($addTehn!='NULL' && $addModel!='0' && $listPType!='NULL' && ($listCity=="NULL")){
    $where = " WHERE listPtype.id_p_type='$listPType'  and listTehn.id_tehn='$addTehn' and listModel.id_model='$addModel' ORDER BY listCity.city";
    $res = $it_invent->queryMaker($where);
}

if($listCity!='NULL' && $listPType!='NULL' && $addTehn!='NULL' && ($addModel=="0")){
    $where = " WHERE listCity.id_city='$listCity' and listPType.id_p_type='$listPType' and listTehn.id_tehn='$addTehn' ORDER BY listCity.city";
    $res = $it_invent->queryMaker($where);
}

if($listCity!='NULL' && $listPType!='NULL' && $addTehn!='NULL' && $addModel!="0"){
    $where = " WHERE listCity.id_city='$listCity' and listPType.id_p_type='$listPType' and listTehn.id_tehn='$addTehn' and listModel.id_model='$addModel' ORDER BY listCity.city";
    $res = $it_invent->queryMaker($where);
}

echo <<<LABEL
<table border id="table" style="margin:10px;">
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

if (isset($num_rows)) {
    echo <<<LABEL
        <tr>
            <td colspan='6' align="right"><b>Итого:</b></td>
            <td align='center'><b>$num_rows</b></td>
        </tr>
LABEL;
    echo "</table>";
} 
?>
