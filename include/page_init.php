<?
	$query = mysql_query($sql);
	$all_row = mysql_num_rows($query);
// ######### หาจำนวนหน้าทั้งหมด #########
	if (!isset ($pagesize)) $pagesize = 10;
	if (isset($page)=="") {
		$page = 1;
	}
 	$mod_page = $all_row%$pagesize;
	if ($mod_page==0) { 
		$pagecount = floor($all_row/$pagesize);	} else { $pagecount = floor($all_row/$pagesize)+1; 
	}

	$start = ($page-1)*$pagesize;
	$sql = $sql . " limit $start, $pagesize";
?>