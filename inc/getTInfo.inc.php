<?php
$id_p=$_GET['id_p'];
list ($tehn) = $it_invent->getTehnInfo($_GET['id_p']);
$i=0;

foreach($tehn as $item){
    $i++;
    $id_t=$item['id_t'];
    $name=$item['name'];
    $model=$item['model'];
    #$invN=$item['invN'];
    #$serN=$item['serN'];
    $item['invN']!="" ? $invN="value=\"".$item['invN']."\"" : $invN="style=\" background: #FF0000;\"" ;
    $item['serN']!="" ? $serN="value=\"".$item['serN']."\"" : $serN="style=\" background: #FF0000;\"" ;
        echo <<<LABEL
             <tr class="onMove">
                <td><input class="edit class_$id_t" type="radio" value="$id_t" name="id_t" form="delTehn">
                <td><input class="edit class_$id_t" readonly type="text" name="id_t" size="2" id="count" value="$i">
                <td><input class="edit class_$id_t" readonly type="text" name="name" size="25" value="$name">
                <td><input class="edit class_$id_t" readonly type="text" name="model" size="25" value="$model">
                <td><input class="edit class_$id_t" readonly type="text" name="invN" size="25" $invN>
                <td><input class="edit class_$id_t" readonly type="text" name="serN" size="25" $serN>
            </tr>
LABEL;
}
?>
