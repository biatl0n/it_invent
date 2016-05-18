<?php
$res = $it_invent->showDeletedTehn();

$i=0;
foreach ($res as $item){
    $i++;
    $id_delTehn=$item['id_delTehn'];
    $name=$item['name'];
    $model=$item['model'];
    $invN=$item['invN'];
    $serN=$item['serN'];
    $delReason=$item['delReason'];
    $delDate=$item['delDate'];

    echo <<<LABEL
    <tr class="onMove">
        <td>
            <table>
                <tr>
                    <td id="td_1"><input type="radio"  name="id_t" value="$id_delTehn"></td>
                    <td id="td_1">$i</td>
                </tr>
            </table>
        </td>
        <td>$name</td>
        <td>$model</td>
        <td>$invN</td>
        <td>$serN</td>
        <td>$delDate</td>
        <td>$delReason</td>
    </tr>
LABEL;
}


?>
