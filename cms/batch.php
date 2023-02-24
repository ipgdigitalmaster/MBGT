<?php include 'header.php' ?>
<?php
$menu_title = "Batch";
$page = "batch";
$PK_field = "batch_id";
$PK_status = "batch_status";
$tbl_name = $FTblName . "_batch";
$fieldlist = array('batch_name', 'batch_detail', 'batch_status');
$pagesize = 25;
if (isset($_GET['del']) && $_GET['del'] == "true") {
    #$d="delete from `".$FTblName."_administrator` where admin_id = '".trim($_GET['del'])."' ";
    $d = "UPDATE `" . $tbl_name . "` SET $PK_status = '2' where $PK_field = '" . trim($_GET[$PK_field]) . "' ";
    $mysqli->query($d);
?>
    <script>
        window.location.href = '<?php echo $page . ".php"; ?>';
    </script>
<?php
}
?>

<body class="g-sidenav-show  bg-gray-100">
    <?php include 'sidebar.php'; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php include 'navbar.php'; ?>
        <div class="container-fluid py-4">

            <!-- content here!! -->
            <div>
                <div class="nav-wrapper position-relative end-0">
                    <button class="btn btn-success" onclick="javascript:window.location.href='<?php echo $page; ?>-update.php?mode=add';">Add New</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <!-- <h6>Student</h6> -->
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 caption-top">
                                    <thead>
                                        <tr class="text-center">

                                            <th scope="col">Batch ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $s = "SELECT * FROM `" . $tbl_name . "` order by batch_id desc";
                                        #echo $s;
                                        $q = $mysqli->query($s);
                                        while ($r = $q->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $r['batch_id']; ?></td>
                                                <td class="text-center"><?php echo $r['batch_name']; ?></td>
                                                <td class="align-middle text-center text-sm">
                                                    <?php if ($r['batch_status'] === '1') { ?>
                                                        <span class="badge badge-sm bg-gradient-success"> Active </span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-sm bg-gradient-secondary"> Inactive </span>
                                                    <?php } ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="<?php echo $page; ?>-update.php?batch_id=<?php echo $r['batch_id'] ?>&mode=update" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit batch">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>


    <?php include 'footer.php'; ?>