<?php
/* ******************************************************************************************************** 
Last Modify : 15 JUN, 2011
/* ******************************************************************************************************** 

 ******************************************************************************************************** */
function Show_Input ($type,$value,$url="",$target="",$imgsize="400"){
	switch ($type) { 
		case "Text" : 
			$msg = $value;
			break;
		case "Image" :  // 11 Nov 05 
			$msg = "<img src='../".$value."' width='".$imgsize."' />";
			break;
		case "Flash" :  // Friday 11 November 2005 00:11 
			$msg = "Flash";
			break;
		case "Link" :  // Friday 11 November 2005 00:11 
			$msg = "<a href='http://".$url."' target='".$target."' >".$value."</a>";
			break;
		}
	return ($msg);	
}
function Show_Image ($sql ,$ref_id, $gallery_group, $flag, $size) { 
		  $query  = mysql_query($sql);
 		  while ($rec  = mysql_fetch_array ($query)) { 
		  		$filename = "upload/" . $gallery_group . "/" . $rec["gallery_id"] . "_$size.jpg";
 			   if (file_exists ($filename)) {
				$msg = '<img src="' . $filename . '" border="0">';
			   }
		  }
		return $msg;
}

function Cal_Age($birthdate){
   list($dob_year, $dob_month, $dob_day) = explode('-', $birthdate);
   $cur_year  = date('Y');
   $cur_month = date('m');
   $cur_day  = date('d');
   if($cur_month >= $dob_month && $cur_day >= $dob_day) {
       $age = $cur_year - $dob_year;
   }
   else {
       $age = $cur_year - $dob_year - 1;
   }
   echo $age;
}

function Show_Choice ($select_name, $list_array , $prefer_location) { 
		$msg = '<select name="' . $select_name . '">';
		$msg .= '<option value="">Select One</option> ' ;
		  foreach ($list_array as $value)  { 
			if (substr ($value,0,1) == "-") { $msg .= '<option value="" ' ;
			} else 
			{
			$msg .= '<option value="' .  $value . '" ' ;
			}			
			 if ($prefer_location == $value ) { $msg .=  ' selected '  ;} 
			$msg .= '> ' .  $value . '</option>';
		 } 
         $msg .= '</select>';
		 echo $msg;
}

function format_date_en ($value,$type) { 
	list ($s_date,$s_time)  = split (" ", $value);
	list ($s_year, $s_month, $s_day) = split ("-", $s_date);
	list ($s_hour, $s_minute, $s_second) = split (":", $s_time);
	$s_month +=0;
	$s_day += 0;
	if ($s_day == "0") return "";
	$mktime = mktime ($s_hour, $s_minute, $s_second, $s_month, $s_day, $s_year);
	switch ($type) { 
		case "1" :  // Friday 11 November 2005
			$msg = date ("l d F Y", $mktime);
			break;
		case "2" :  // 11 Nov 05 
			$msg = date ("d M y", $mktime);
			break;
		case "3" :  // Friday 11 November 2005 00:11 
			$msg = date ("l d F Y H:m", $mktime);
			break;
		case "4" :  // 11 Nov 05 00:11 
			$msg = date ("d M y  H:m", $mktime);
			break;
		case "5" :  // 11 Nov 05 00:11 
			$msg = date ("d M Y", $mktime);
			break;
		}
	return ($msg);
}
function format_date_th ($value,$type) { 
	if (strlen ($value) > 10) { 
			list ($s_date,$s_time)  = split (" ", $value);
			list ($s_year, $s_month, $s_day) = split ("-", $s_date);
			list ($s_hour, $s_minute, $s_second) = split (":", $s_time);
	}
	else 
	{
			list ($s_year, $s_month, $s_day) = split ("-", $value);
	}
	$s_month +=0;
	$s_day += 0;
	if ($s_day == "0") return "";
	$s_year += 543;
	$month_full_th = array ('','มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',' กันยายน', 'ตุลาคม', 'พฤศจิกายน','ธันวาคม');
	$month_brief_th = array ('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
	$day_of_week = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์"); 
	switch ($type) { 
		case "1" : // ?????? 4 ????????? 2548
			$msg = "วันที่ ". $s_day . " " .  $month_full_th[$s_month]  . " " .  $s_year ;
			break;
		case "2" :  // 4 ?.?. 2548
			$msg =  $s_day . " " .  $month_brief_th[$s_month]  . " " .  $s_year ;
			break;
		case "3" :  // ?????? 4 ????????? 2548 ???? 14.11 ?.
			$msg = "วันที่ ".$s_day . " " .  $month_full_th[$s_month]  . " " .  $s_year . " เวลา " . $s_hour . "." . $s_minute . " ?." ;
			break;
		case "4" :  // 4 ?.?. 2548 14.11 ?. 
			$msg =  $s_day . " " .  $month_brief_th[$s_month]  . " " .  $s_year . "  " . $s_hour . "." . $s_minute . " ?." ;
			break;
		case "5" :  // 4 ?.?. 2548  
			$msg =  $s_day . " " .  $month_brief_th[$s_month]   . " " .  $s_year  ;
			break;
		case "6" : // ?????? 4 ????????? 2548
			$msg = $s_day . " " .  $month_full_th[$s_month]  . " " .  $s_year ;
			break;			
		case "7" : // วัน จันทร์ ที่ 01 สิงหาคม พ.ศ. 2554
			$msg = "วัน ".$day_of_week[date("w")]." ที่ ".$s_day . " " .  $month_full_th[$s_month]  . " พ.ศ. " .  $s_year ." เวลา " . $s_hour . "." . $s_minute;
			break;			
		}
	return ($msg);

}

function gen_random ($length)
{
	$keychars = "abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789";
	$randkey = "";
	$max=strlen($keychars)-1;
	for ($i=0;$i<=$length;$i++) {
	  $randkey .= substr($keychars, rand(0, $max), 1);
	}
	return $randkey;
}

function NumToThai($value) 
{ 
  // Constant Variable 
  $Unit = Array("", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน" , "ล้าน"); 
  $No  = Array("ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า"); 

  // Prepare Variable 
  $NumToThai = ""; 
  $Pos    = 0; 

 list ($Number, $Satang)  = split ("[.]", $value);
  // Process 
  while ($Number > 0 ) 
  { 
    $LastDigit = $Number%10; 

    if ($Pos == 0 && $LastDigit == 1 && $Number > 1) 
      $NumToThai = "เอ็ด"; 
    elseif ($Pos == 1 && $LastDigit == 1) 
      $NumToThai = "สิบ" . $NumToThai; 
    elseif ($Pos == 1 && $LastDigit == 2) 
      $NumToThai = "ยี่สิบ" . $NumToThai; 
    elseif ($LastDigit != 0) 
      $NumToThai = $No[$LastDigit] . $Unit[$Pos] . $NumToThai; 

    $Number = (int)($Number/10); 
    $Pos  = $Pos+1; 
  } 
	$msg  = $NumToThai .  "บาท"; 
	if ($Satang+0 == 0) 	$msg  .= "ถ้วน"; 
// ***************
if ($Satang > 0) {
  $Pos    = 0; 
		$Number = $Satang;
		$NumToThai = "";
		   while ($Number > 0 ) 
			  { 
				$LastDigit = $Number%10; 
				if ($Pos == 0 && $LastDigit == 1 && $Number > 1) 
				  $NumToThai = "เอ็ด"; 
				elseif ($Pos == 1 && $LastDigit == 1) 
				  $NumToThai = "สิบ" . $NumToThai; 
				elseif ($Pos == 1 && $LastDigit == 2) 
				  $NumToThai = "ยี่สิบ" . $NumToThai; 
				elseif ($LastDigit != 0) 
				  $NumToThai = $No[$LastDigit] . $Unit[$Pos] . $NumToThai; 
			
				$Number = (int)($Number/10); 
				$Pos  = $Pos+1; 
			  } 	
			  $msg  .= $NumToThai .  "สตางค์"; 

	}


// *****************
  if ($NumToThai == "") 
    $NumToThai = "-"; 

  return $msg; 
}

function Msg_Error ($msg) 
{
$ret = '<table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">';
$ret .= '  <tr>';
$ret .=  '    <td bgcolor="#FF0000"><table width="100%" border="0" cellspacing="1" cellpadding="1">';
$ret .=  '        <tr>';
$ret .=  '          <td align="center" bgcolor="#FFFFFF"><br><br>' . $msg . '<br><br><br></td>';
$ret .=  '        </tr>';
$ret .=  '      </table></td>';
$ret .=  '  </tr>';
$ret .=  '</table>';
return $ret;
}

function Show_Data ($tbl_name, $key, $value, $fieldname)
{
	$sql = "select * from $tbl_name where $key like '" . $value . "'"; 
	$query = $mysqli->query($sql); 
	$fields = explode (":", $fieldname);
	$msg = "";
	if ($rec =  $query->fetch_assoc()) { 
		foreach ($fields as $key => $value ) { 
			$msg .= " : " . $rec[$value];
		}
		$msg = substr ($msg, 3);
	} 
	 return $msg;
}

function Update_Transaction_DateTime ($sql, $mode)
{
	if ($mode == "add") { 
	
	}
	if ($mode == "update") { 
		$sql .= ", update_date = '" . date ("Y-m-d H:m:s") . "'";
		$sql .= ", update_by = '" . $_SESSION["username"] .  "'";
	}
	if ($mode == "delete") { 
	
	}
	return $sql;
}

function date_format_thai ($create_date) { 
	list($year1, $month1, $day1, $hour1, $minute1, $second1 ) = split('[-.]', $create_date);
	return mktime(0,0,0,$month1,$day1,$year1); 
} 

function CheckBox ($box_name, $value) { 
	if ($value) $value = " checked ";
	echo '<input name="' . $box_name . '" type="checkbox" value="1" ' . $value . '>';
}
function CmdRadio($box_name, $a_value, $select_value) { 
	foreach ($a_value as $key=>$value) { 
		$check = "";
		if ($key == $select_value) { $check = " checked "; } 
		echo '<input type="radio" name="' . $box_name . '" value="' . $key . '" ' . $check . '>' . $value;
	}
}

function CmdDropDown ($sql, $box_name, $fieldkey, $value, $fieldshow) { 
	if ($value == "0" or $value == "") $select_none = " selected "; else $select_none = "";
	echo '<select name="' . $box_name . '" >';
	echo '<option value="" ' . $select_none . '>----Select----</option>';
	$query = mysql_query ($sql);
 	while ($rec = mysql_fetch_array ($query)) { 
		if ($rec[$fieldkey] == $value) $selected = " selected "; else 		$selected= "";
		echo '<option value="' . $rec[$fieldkey] . '" '.  $selected . '>' . $rec[$fieldshow] . '</option>';
	} 
    echo '</select>';
}

function CmdListBox ($sql, $box_name, $fieldkey, $value, $fieldshow, $total_value) { 
	echo '<select name="' . $box_name . '" size=15 multiple>';
	echo '<option value=""  >Select One</option>';
	$query = mysql_query ($sql);
	while ($rec = mysql_fetch_array ($query)) { 
		$selected= "";
		if (in_array ($rec[$fieldkey],$total_value)) $selected = " selected ";
		echo '<option value="' . $rec[$fieldkey] . '" '.  $selected . '>' . $rec[$fieldshow] . '</option>';
	} 
    echo '</select>';
}

function Show_Sort ($orderby, $cn,  $field_select, $sortby,$page) { 
	global $FK_field;
	global $$FK_field;

	if ($sortby <> "" and ($orderby ==  $field_select))  $img = '<img src="../icons/' . $sortby . '.gif">';
	if ($sortby == "desc" or $sortby == "")  $sortby = "asc"; else 	$sortby  = "desc"; 
	if ($orderby <>  $field_select) $sortby = "asc";
	 $param = "orderby=$orderby";
	if ($FK_field <> "") $param .= "&" . $FK_field . "=" . $$FK_field;
	if ($sortby <> "") $param .= "&sortby=$sortby";
	if ($keyword <> "") $param .= "&keyword=$keyword";
	if ($page <> "") $param .= "&page=$_GET[page]";
	
	$link_1 = "<a href ='" . $_SERVER['SCRIPT_NAME'] ."?" . $param ."'>";
	$url =  $link_1 . $cn . "</a>" ;
	if ($sortby <> "") $url .= $img;
	echo $url;
}

function Show_Sort_bg ($field, $sortby) { 
	if ($field == $sortby) { 
		echo 'class="sort"';
	}
	
}

function return_size($filesize){
	$filesize_cal = $filesize;
	if ($filesize > 1024){
		$filesize_cal = ($filesize/1024);
		$dot = "KB";
		if ($filesize_cal > 1024){
			$filesize_cal = ($filesize_cal/1024);
			$dot = "MB";
		}
	}
	$text = number_format($filesize_cal,2,".",",").$dot;
	return $text;
}
	
	// MySQL database functions
	function dbquery($query) {
		$result = @mysql_query($query);
		if (!$result) {
			echo mysql_error();
			return false;
		} else {
			return $result;
		}
	}
	
	function dbcount($field, $table, $conditions = "") {
		$cond = ($conditions ? " WHERE ".$conditions : "");
		$result = @mysql_query("SELECT Count".$field." FROM ".$table.$cond);
		if (!$result) {
			echo mysql_error();
			return false;
		} else {
			$rows = mysql_result($result, 0);
			return $rows;
		}
	}
	
	function dbresult($query, $row) {
		$result = @mysql_result($query, $row);
		if (!$result) {
			echo mysql_error();
			return false;
		} else {
			return $result;
		}
	}
	
	function dbrows($query) {
		$result = @mysql_num_rows($query);
		return $result;
	}
	
	function dbarray($query) {
		$result = @mysql_fetch_assoc($query);
		if (!$result) {
			echo mysql_error();
			return false;
		} else {
			return $result;
		}
	}
	function dbfetcharray($query) {
		$result = @mysql_fetch_array($query);
		if (!$result) {
			echo mysql_error();
			return false;
		} else {
			return $result;
		}
	}
	function dbarraynum($query) {
		$result = @mysql_fetch_row($query);
		if (!$result) {
			echo mysql_error();
			return false;
		} else {
			return $result;
		}
	}
	// Validate numeric input
function isnum($value) {
	if (!is_array($value)) {
		return (preg_match("/^[0-9]+$/", $value));
	} else {
		return false;
	}
}
// Redirect browser using header or script function
function redirect($location, $script = false) {
	if (!$script) {
		header("Location: ".str_replace("&amp;", "&", $location));
		exit;
	} else {
		echo "<script type='text/javascript'>document.location.href='".str_replace("&amp;", "&", $location)."'</script>\n";
		exit;
	}
}
// ฟังก์ชั่นตัดคำหยาบซึ่งสามารถเพิ่มคำที่ต้องการตัดได้
	function CheckRude($temp){
		$wordrude = array("ashole","a s h o l e","a.s.h.o.l.e","bitch","b i t c h","b.i.t.c.h","shit","s h i t","s.h.i.t","fuck","dick","f u c k","d i c k","f.u.c.k","d.i.c.k","มึง","มึ ง","ม ึ ง","ม ึง","มงึ","มึ.ง","มึ_ง","มึ-ง","มึ+ง","กู","ควย","ค ว ย","ค.ว.ย","คอ วอ ยอ","คอ-วอ-ยอ","ปี้","เหี้ย","ไอ้เหี้ย","เฮี้ย","ชาติหมา","ชาดหมา","ช า ด ห ม า","ช.า.ด.ห.ม.า","ช า ติ ห ม า","ช.า.ติ.ห.ม.า","สัดหมา","สัด","เย็ด","หี","สันดาน","แม่ง","ระยำ","ส้นตีน","แตด") ;
		$wordchange = ("<font color=red>xxx</font>") ;

		for ( $i=0 ; $i<sizeof($wordrude) ; $i++ ){
			$temp = eregi_replace ($wordrude[$i] ,$wordchange ,$temp);
		}
		return ( $temp ) ;
	}

//แปลงเวลาเป็นภาษาไทย
function ThaiTimeConvert($timestamp="",$full="",$showtime=""){
	global $SHORT_MONTH, $FULL_MONTH, $DAY_SHORT_TEXT, $DAY_FULL_TEXT;
	$day = date("l",$timestamp);
	$month = date("n",$timestamp);
	$year = date("Y",$timestamp);
	$time = date("H:i:s",$timestamp);
	$times = date("H:i",$timestamp);
	if($full){
		$ThaiText = $DAY_FULL_TEXT[$day]." ที่ ".date("j",$timestamp)." เดือน ".$FULL_MONTH[$month]." พ.ศ.".($year+543) ;
	}else{
		$ThaiText = date("j",$timestamp)." / ".$SHORT_MONTH[$month]." / ".($year+543);
	}

	if($showtime == "1"){
		return $ThaiText." เวลา ".$time;
	}else if($showtime == "2"){
		$ThaiText = date("j",$timestamp)." ".$SHORT_MONTH[$month]." ".($year+543);
		return $ThaiText." : ".$times;
	}else{
		return $ThaiText;
	}
}
//แปลงเวลาเป็นภาษาอังกฤษ
function EngTimeConvert($timestamp=""){
	global $SHORT_MONTH, $FULL_MONTH, $DAY_SHORT_TEXT, $DAY_FULL_TEXT;
	$day = date("j",$timestamp);
		for($i=strlen($day);$i<2;$i++){
			$day="0".$day;
		}
	$month = date("n",$timestamp);
		for($i=strlen($month);$i<2;$i++){
			$month="0".$month;
		}
	$year = date("Y",$timestamp);
	$time = date("H:i:s",$timestamp);
	$times = date("H:i",$timestamp);
		$EngText = $day."/".$month."/".($year+543);
		return $EngText." - ".$times;
}
function timestamp2datetime($timestamp) {
    return date('Y-m-d H:i:s', $timestamp);
}
// Datetime2Timestamp
function datetime2timestamp($date){
	$str="$date";
	$hour=00;
	$minutes=00;
	$seconds=00;
	$month = substr($str,5,-3);
	$day = substr($str,8,10);
	$year = substr($str,0,4);	
	$stamp = mktime($hour, $minutes, $seconds, $month, $day, $year);
	return $stamp;
}
//News Icon
function NewsIcon($Ntime="", $Otime="", $Icon=""){
	if(TIMESTAMP <= ($Otime + 86400)){
		echo "&nbsp;<IMG SRC=\"".$Icon."\" BORDER=\"0\" ALIGN=\"absmiddle\"> ";
	}
}
//Hot Icon
function HotIcon($count="", $view="", $Icon=""){
	if($count <= $view){
		echo "&nbsp;<IMG SRC=\"".$Icon."\" BORDER=\"0\" ALIGN=\"absmiddle\"> ";
	}
}
//$mode="read,add,edit,del"
//$user = $_SESSION['login_id'];
function CheckPermission($FTblName,$mode,$user,$module){
	$bool = false;
	$sqluser="select * from ".$FTblName."_administrator where admin_id = '".$user."' and admin_status = '1' ";
	$queryuser=mysql_query($sqluser);
	if($recuser=mysql_fetch_array($queryuser)){
		$chk="select permission_".$mode." from ".$FTblName."_permission where permission_group_id = '".$recuser['permission_group_id']."' and module_id='".$module."' and permission_status='1' ";
		//echo $chk;
		$qry=mysql_query($chk);
		if($rec=mysql_fetch_array($qry)){
			if($rec['permission_'.$mode]=="1"){
				$bool = true;
			}	
		}
	}
	
	return $bool;	
}

function PathUse(){
	$PathFull=substr($_SERVER['DOCUMENT_ROOT'], strrpos($_SERVER['DOCUMENT_ROOT'], $_SERVER['PHP_SELF']));
	$PathHost=substr(__FILE__,0,strrpos(__FILE__,'/'));
	$PathNow=substr($PathHost,strlen($PathFull));
	$SplitPathNow=split("/",$PathNow);
	$PathU="";
	for($np=0;$np<=strlen($SplitPathNow)-1;$np++){
		if ($SplitPathNow[$np]<>""){
			if($SplitPathNow[$np]<>"include"){
				$PathU.="/".$SplitPathNow[$np];
			}else{ $np+=10000; 
			}
		}
	}
	return $PathU;
}
?>