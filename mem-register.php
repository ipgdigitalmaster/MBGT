<?php
include("include/config.php");
if($_POST['user_id']!=''){ // && $_POST['displayName']!=''
  $s = "select * from `".$FTblName."_member` where userid = '".$_POST['user_id']."' ";
  if ($result = $mysqli->query($s)) {
    if ($r = $result->fetch_assoc()){
      $s="update `".$FTblName."_member` set displayname='".str_replace("'", "\'", $_POST['displayName'])."',pictureurl='".$_POST['pictureUrl']."',statusmessage='".preg_replace('/[^A-Za-z0-9. \-]/', '', $_POST['statusMessage'])."',updatedate=NOW() where userid='".$_POST['user_id']."'";
      $mysqli->query($s);
      echo "Update";
    }else{
      $s="insert into `".$FTblName."_member` (userid,displayname,pictureurl,statusmessage,createdate) values ('".$_POST['user_id']."','".str_replace("'", "\'", $_POST['displayName'])."','".$_POST['pictureUrl']."','".preg_replace('/[^A-Za-z0-9. \-]/', '', $_POST['statusMessage'])."',NOW())";
      $mysqli->query($s);
      echo "Save";
    }
  }
}
?>