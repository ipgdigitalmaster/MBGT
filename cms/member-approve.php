<?php include 'header.php' ?>
<?php
$menu_title = "Member";
$page = "member";
$PK_field = "member_id";
$PK_status = "content_status";
$tbl_name = $FTblName . "_member";
$fieldlist = array('content_name', 'content_coach', 'content_detail', 'content_code', 'content_status');
$pagesize = 25;
if (isset($_GET['userid'])) {
    #$d="delete from `".$FTable."_administrator` where admin_id = '".trim($_GET['del'])."' ";

    $d = "UPDATE `" . $tbl_name . "` SET status = '1' where userid = '" . trim($_GET['userid']) . "' ";
    $result = $mysqli->query($d);
?>
    <script>
        window.location.href = '<?php echo $page . ".php"; ?>';
    </script>
<?php
}
?>


<?php include 'footer.php'; ?>