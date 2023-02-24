<?
echo "Page: " . $page  . " of " . $pagecount . " page(s)";
if (!isset ($limit_page)) $limit_page = 10;
$parameter = "";
foreach ($_GET as $key=>$value) {
	if ($key <> "page" ) 
		$parameter .= "&" .  $key  . "=" . $value;
}
$parameter = substr ($parameter, 1, strlen ($parameter)) ;
echo "<br>";
echo "<center>";
// ############### แสดงเลขหน้า, และลิงค์ไปยังหน้าต่างๆ #################
$prevpage = $page-1;
$nextpage = $page+1;

	if ($page==1) {
		// ไม่แสดงลิงค์ "กลับ"
	} else {
		echo "<a href=\"$PHP_SELF?page=$prevpage" . "&" . $parameter . "\">หน้าที่แล้ว</a>";
	}

		if ($pagecount==1) {
	// ไม่ต้องแสดงเลขหน้า
		} else {
		$start_page_no = floor (($page-1) / $limit_page ) * $limit_page + 1;
		//	echo floor ($page / $limit_page) . " : " .$start_page_no;
//			if ($start_page_no + $limit_page > $pagecount ) $stop_page_no = $pagecount; else $stop_page_no = $start_page_no + $limit_page-1;
			if ($start_page_no + $limit_page > $pagecount ) $stop_page_no = $pagecount; else $stop_page_no = $start_page_no + $limit_page -1;
			for ($i=$start_page_no;$i<= $stop_page_no ;$i++) {
				if ($i==$page) {
				echo " <b>$i</b> ";
				} else {
				echo "  <a href=\"$PHP_SELF?page=$i&" . $parameter ."\">$i</a>  ";
				}
		}
	}

//$page = (int)$page;
	if ($page==$pagecount or $pagecount == 0) {
		// ไม่แสดงลิงค์ "ถัดไป"
	} else {
		echo " <a href=\"$PHP_SELF?page=$nextpage&" . $parameter ."\">หน้าถัดไป</a>";
	}
// ######################################################
echo "</center>";

?>