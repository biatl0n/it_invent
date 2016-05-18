<?php
$points = $it_invent->getPointsInfo();
foreach ($points as $item){
    $id_p = $item['id_p'];
    $city = $item['city'];
    $p_type = $item['p_type'];
    $adress = $item['adress'];
    echo <<<LABEL
        <tr>
            <td><input readonly form="sel" type="radio" value="$id_p" name='selectedPoint'></td>
            <td><input readonly type="text" value="$city" class="edit" /></td>
            <td><input readonly type="text" value="$p_type" class="edit" /></td>
            <td><textarea readonly cols="35" rows="1">$adress </textarea></td>
        </tr>
LABEL;
}
?>
