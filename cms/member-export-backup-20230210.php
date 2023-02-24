<?php
include("../include/config.php");
$menu_title = "Member";
$page = "member";
$mid = "5";
$tbl_name = $FTblName . "_member";

$PK_field = "member_id";
$PK_status = "status";
//$FR_field = "orders_id";
$check_module = "content";
$tbl_name = $FTblName . "_member";
$page_name = "Member";
$field_confirm_showname = "firstname";
$fieldlist = array('userid', 'displayname', 'emp_code', 'emp_name', 'member_id');
$showfieldlist = array('UID:userid:Text', 'Firstname:firstname:Text', 'Lastname:lastname:Text', 'Email:email:Text', 'Status:status:Text');
$search_key = array('firstname', 'lastname', 'email');
$pagesize = 25;

$str = "Member Register " . date("Y-m-d") . ".xls";

header("Content-Type: application/octet-stream; name=\"$str\"");
header("Content-Disposition: inline; filename=\"$str\"");
header("Pragma: no-cache");


?>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style id="SiXhEaD_Excel_Styles"></style>
</head>

<body>
  <div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="list">
      <tr>
        <th>Member Register</th>
      </tr>
      <tr>
        <td align="right"><?php

                          if (isset($_GET['daterange'])) {
                            $getdate = ($_GET['daterange']);
                            $sp_date = explode(" - ", $getdate);
                            $sp_start_d = explode("/", $sp_date[0]);
                            $sp_end_d = explode("/", $sp_date[1]);

                            /*$startTime = strtotime( $sp_start_d[2].'-'.$sp_start_d[0].'-'.$sp_start_d[1].' 00:00' );
    $endTime = strtotime( $sp_end_d[2].'-'.$sp_end_d[0].'-'.$sp_end_d[1].' 23:59' );*/
                            $startTime = $sp_start_d[2] . '-' . $sp_start_d[0] . '-' . $sp_start_d[1] . ' 00:00';
                            $endTime = $sp_end_d[2] . '-' . $sp_end_d[0] . '-' . $sp_end_d[1] . ' 23:59';
                            $sql_date = " and (createdate >= '" . $startTime . "' and createdate <= '" . $endTime . "') ";
                          } else {
                            $sql_date = "";
                          }
                          $sql1 = "select * from `" . $tbl_name . "` where status = '1' " . $sql_date;
                          //if($_GET['fb']=="true"){ //&gender=ชาย&age=){
                          //$sql1.=" group by fbid order by content_id asc ";
                          $result = $mysqli->query($sql1);
                          $num_member = $result->num_rows;
                          ?><b><?php echo $num_member; ?> ข้อมูลที่พบ</b></td>
      </tr>
      <tr>
        <td>
          <table width="100%" cellspacing="0" class="list" border="1">
            <tr>
              <th>User ID</th>
              <th>Display Name</th>
              <th>Emp Code</th>
              <th>Emp Name</th>
              <th>Status</th>
              <th>Register Date</th>
            </tr>
            <?php
            $sql = $sql1;
            #echo $sql;
            $query = $mysqli->query($sql);
            while ($rec = $query->fetch_assoc()) {
            ?>
              <tr>
                <td><?php echo "&nbsp;" . $rec['userid']; ?></td>
                <td><?php echo "&nbsp;" . $rec['displayname']; ?></td>
                <td><?php echo "&nbsp;" . $rec['emp_code']; ?></td>
                <td><?php echo "&nbsp;" . $rec['emp_name']; ?></td>
                <td><?php if ($rec['status'] == "1") {
                      echo "&nbsp;" . "Approved";
                    } else {
                      echo "&nbsp;" . "-";
                    }; ?></td>

                <td><?php echo "&nbsp;" . $rec['createdate']; ?></td>
              <?php $x++;
            } ?>
          </table>
        </td>
      </tr>
    </table>
    </td>
    </tr>
    </table>
  </div>
</body>

</html>