<?php
include("include/config.php");
$data['status'] = 'not';
$data['result'] = '';
if ($_POST['userid'] != '') {
	$data = array();
	$s = "select * from `" . $FTblName . "_member` where userid = '" . $_POST['userid'] . "' and emp_name <> '' ";
	if ($result = $mysqli->query($s)) {
		if ($r = $result->fetch_assoc()) {
			$data['status'] = 'ok';
			//$data['sql'] = $s;
			$data['result'] = $r;
		}
	}
}
echo json_encode($data);
