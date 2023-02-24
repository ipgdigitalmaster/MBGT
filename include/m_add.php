<?php

    $admin_status = "0";
    $mid = "";
    $field = "";
    $value = ""; 
 
		foreach ($fieldlist as $k => $v) { 
		  $field .= ", " . $v;
		  $value .= ", '" . $_POST[$v] . "'";
	    }
		$field = substr ($field,1, strlen ($field));
		$field .= " ,create_date, create_by ";
		$value = substr ($value,1, strlen ($value));
		$value .= ",'" . date ("Y-m-d H:i:s")  . "', '" . $_SESSION["login_name"] . "'";
		$sql = "insert into $tbl_name ( " . $field . ")  values (". $value . ")";
		#echo $sql;
		$mysqli->query($sql);
		$id = $mysqli->insert_id;
		#echo $sql;
		?>