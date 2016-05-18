<?php

$id_p = $_GET['id_p'];
$id_p = $it_invent->clearInt($id_p);
$point_info = $it_invent->getItemPointInfo($id_p);

$city = $point_info[0]['city'];
$p_type = $point_info[0]['p_type'];
$adress = $point_info[0]['adress'];
$inet_1 = $point_info[0]['inet_1'];
$inet_2 = $point_info[0]['inet_2'];

echo <<<LABEL
<table border id="table" valign="top" style="margin:10px">
    <tr>
        <td>Город:
        <td><input type="text" readonly name="city" size="42" value="$city">
            <input type="hidden" name="id_p" value="$id_p">
    </tr>
    <tr>
        <td>Тип:
        <td><input type="text" readonly name="ptype" size="42" value="$p_type">
    </tr>
    <tr>
        <td>Адрес:
        <td><!--<input type="text" readonly name="adress" size="42" value="$adress"> -->
            <textarea readonly cols="44" rows="2"> $adress </textarea>
    </tr>
    <tr>
        <td>Основа:
        <td><!-- <input type="text" name="inet_1" size="60" value="$inet_1"> -->
            <textarea readonly cols="44" rows="2"> $inet_1 </textarea>
     <tr>
        <td>Резерв:
        <td><!-- <input type="text" name="inet_2" size="60" value="$inet_2"> -->
            <textarea readonly cols="44" rows="2"> $inet_2 </textarea>
     </tr>
</table>
LABEL;

?>
