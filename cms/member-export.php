<?php
include("../include/SimpleXLSXGen.php");
include("../include/config.php");

$check_module = "content";
$tbl_name = $FTblName . "_member";
$header_table = ['No.', 'User ID', 'Display Name', 'Emp Name', 'Email', 'Position', 'Batch', 'Status', 'Register Date'];

$filename = "Member Register " . date("Y-m-d") . ".xlsx";
$datas = [];
array_push($datas, $header_table);

if (isset($_GET['daterange'])) {
  $getdate = ($_GET['daterange']);
  $sp_date = explode(" - ", $getdate);
  $sp_start_d = explode("/", $sp_date[0]);
  $sp_end_d = explode("/", $sp_date[1]);

  $startTime = $sp_start_d[2] . '-' . $sp_start_d[0] . '-' . $sp_start_d[1] . ' 00:00';
  $endTime = $sp_end_d[2] . '-' . $sp_end_d[0] . '-' . $sp_end_d[1] . ' 23:59';
  $sql_date = " and (createdate >= '" . $startTime . "' and createdate <= '" . $endTime . "') ";
} else {
  $sql_date = "";
}
$sql1 = "select * from `" . $tbl_name . "` where status = '1' " . $sql_date;
$result = $mysqli->query($sql1);
$num_member = $result->num_rows;
$sql = $sql1;
#echo $sql;
$query = $mysqli->query($sql);
$result =  [];
$i = 1;
$batch_name = '';
//$int = '';
while ($rec = $query->fetch_assoc()) {
  foreach (json_decode($rec['member_batch']) as $item) {
    $result['i'] = $i;
    $result['userid'] = $rec['userid'];
    $result['displayname'] = $rec['displayname'];
    //$result['emp_code'] = $rec['emp_code'];
    $result['emp_name'] = $rec['emp_name'];
    $result['member_email'] = $rec['member_email'];
    $result['member_position'] = $rec['member_position'];

    $sql_batch = "select * from mbgt_batch where batch_id = " . $item;
    $q_batch = $mysqli->query($sql_batch);
    $r_batch = $q_batch->fetch_assoc();
    //$batch_name .=  $r_batch['batch_name'] . ', ';
    $result['member_position'] = $r_batch['batch_name'];
    $result['status'] = $rec['status'];
    $result['createdate'] = $rec['createdate'];
    array_push($datas, $result);
    $i++;
  }
}


$xlsx = Shuchkin\SimpleXLSXGen::fromArray($datas);
$xlsx->downloadAs($filename);
