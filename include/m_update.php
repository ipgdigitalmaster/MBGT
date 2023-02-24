<?php

$admin_status = "0";
$fieldname = "";
$valuename = "";
$admin_id = "";

$sql = "update $tbl_name set  ";
foreach ($fieldlist as $k => $v) {
	$fieldname .= ", " .  $v . " =  '" . $_POST[$v]  . "'";
}
$fieldname = substr($fieldname, 1, strlen($fieldname));
$valuename = substr($valuename, 1, strlen($fieldname));
$sql .= $fieldname;
$sql .= ", update_date = '" . date("Y-m-d H:m:s") . "'";
$sql .= ", update_by = '" . $_SESSION["login_name"] .  "'";
$sql .= " where $PK_field = '" . $_POST[$PK_field] . "'";
$mysqli->query($sql);
$id = $_POST[$PK_field];
#echo $sql;
#exit;
