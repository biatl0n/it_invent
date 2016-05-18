<?php
require 'classes/IT_invent.class.php';
$it_invent = new IT_invent;

$id_t = $it_invent->clearStr($_GET['id_t']);
$invN = $it_invent->clearStr($_GET['invN']);
$serN = $it_invent->clearStr($_GET['serN']);

$res=$it_invent->changeTehnInfo($id_t, $invN, $serN);

echo $res;

?>
