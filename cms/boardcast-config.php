<?php 
$menu_title = "Boardcast";
$page = "boardcast";
$mid = "6";
$tbl_name = $FTblName . "_boardcast";

$PK_field = "content_id";
$PK_status = "content_status";
//$FR_field = "orders_id";
$check_module = "boardcast";
$tbl_name = $FTblName . "_boardcast";
$page_name = "Boardcast";
$field_confirm_showname= "content_text_1";
$fieldlist = array('module_id','boardcastcard_id','content_boardtype','content_send','content_user_send','content_status');
$showfieldlist = array('Firstname:admin_firstname:Text','Lastname:admin_lastname:Text','Username:admin_username:Text','Type:admin_type:Text');
$search_key = array('content_text_1');
$pagesize = 25;
?>