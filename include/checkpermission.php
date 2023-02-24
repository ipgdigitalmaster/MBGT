<?
	$sql = "select * from s_user_p where user_id = '$_SESSION[login_id]' and s_module like '$check_module' and ";
	if ($action == "read") $sql .= " read_p like '1'";
	if ($action == "add") $sql .= " add_p like '1'";
	if ($action == "update") $sql .= " update_p like '1'";
	if ($action == "delete") $sql .= " delete_p like '1'";
	$query = mysql_query ($sql) or die ("Can not check permission");
	$code = 0;
	if   ($rec = mysql_fetch_array  ($query)) { 
		switch ($action) {
			case "read" : $code = $rec["read_p"]; break;
			case "add" : $code = $rec["add_p"]; break;
			case "update" : $code = $rec["update_p"]; break;
			case "delete" : $code = $rec["delete_p"]; break;
		}
	}
	echo $sql;
		if ($code == "0") { 
			//header ("location:/_admin/error/permission.php");
		}
		?>