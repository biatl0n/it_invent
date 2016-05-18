<?php
$res = $it_invent->showDeletedPoints();

$i=0;
foreach ($res as $item){
    $i++;
    $id_delPoint=$item['id_delPoint'];
    $city = $item['city'];
    $p_type = $item['p_type'];
    $adress = $item['adress'];
    $inet_1 = $item['inet_1'];
    $inet_2 = $item['inet_2'];
    $delReason = $item['delReason'];
    $delDate = $item['delDate'];
    echo <<<LABEL
        <tr class="onMove">
            <td>
                <table>
                    <tr>
                        <td id="td_1"><input type="radio" name="selectedPoint" value="$id_delPoint"></td>
                        <td id="td_1">$i</td>
                    </tr>
                </table>
            </td>
            <td>$city</td>
            <td>$p_type</td>
            <td>$adress</td>
            <td>$inet_1</td>
            <td>$inet_2</td>
            <td>$delDate</td>
            <td>$delReason</td>
        </tr>

LABEL;
}

?>
