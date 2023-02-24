<?php include 'header.php' ?>
<?php
$menu_title = "Batch";
$page = "batch";
$PK_field = "batch_id";
$PK_status = "batch_status";
$tbl_name = $FTblName . "_batch";
$fieldlist = array('batch_name', 'batch_detail', 'batch_status');
$pagesize = 25;
if (isset($_POST['mode'])) {
    #echo "mode";
    if ($_POST['mode'] == "add") {
        include "../include/m_add.php";
    }
    if ($_POST['mode'] == "update") {
        include("../include/m_update.php");
    }
    #echo $sql;
?>
    <script>
        window.location.href = '<?php echo $page . ".php"; ?>';
    </script>
    <?php
} else {
    if (isset($_GET['mode']) && $_GET['mode'] == "add") {
        //Check_Permission ($check_module,$_SESSION[login_id],"add");
    } else if (isset($_GET['mode']) && $_GET['mode'] == "update") {
        // Check_Permission ($check_module,$_SESSION[login_id],"update");
        $sql = "select * from $tbl_name where $PK_field = '" . trim($_GET[$PK_field]) . "'";

        $q = $mysqli->query($sql);
        while ($rec = $q->fetch_assoc()) {
            $$PK_field = $rec[$PK_field];
            foreach ($fieldlist as $key => $value) {
                $$value = $rec[$value];
            }
        }
    } else {
    ?>
        <script>
            window.location.href = '<?php echo $page . ".php"; ?>';
        </script>
<?php
    }
}
?>

<body class="g-sidenav-show  bg-gray-100">
    <?php include 'sidebar.php'; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php include 'navbar.php'; ?>
        <div class="container-fluid py-4">

            <!-- content here!! -->
            <form role="form" action="<?php echo $page; ?>-update.php" method="post">
                <?php if ($_GET['mode'] == "update") { ?>
                    <input name="<?php echo $PK_field; ?>" type="hidden" id="<?php echo $PK_field; ?>" value="<?php echo $$PK_field; ?>">
                <?php } ?>
                <input type="hidden" id="mode" name="mode" value="<?php echo $_GET['mode']; ?>">

                <div class="mb-3">
                    <label for="Name">Batch Name</label>
                    <input type="text" class="form-control" placeholder="Batch Name" aria-label="Batch Name" aria-describedby="email-addon" id="batch_name" name="batch_name" value="<?php echo $batch_name; ?>">
                </div>
                <div class="mb-3">
                    <label for="Name">Batch Detail</label>
                    <textarea class="form-control" placeholder="Batch Detail" aria-label="Batch Detail" id="batch_detail" name="batch_detail"><?php echo $batch_detail; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="Name">Batch Status</label>
                    <div>
                        <input type="checkbox" id="batch_status" name="batch_status" value="1" <?php if ($batch_status == "0") { ?> <?php } else { ?>checked="checked" <?php } ?>> Active
                    </div>

                    <div class="text-center col-2 d-flex">
                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Submit</button>
                        <button type="button" class="btn btn-link w-100 my-4 mb-2" onclick="javascript:window.location.href='<?php echo $page; ?>.php';">Cancel</button>
                    </div>
            </form>

        </div>
    </main>
    <script>
        $(document).ready(function() {

            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount: 100,
                searchResultLimit: 100,
                renderChoiceLimit: 100
            });


        });
    </script>
    <style>
        .mt-100 {
            margin-top: 100px
        }
    </style>
    <?php include 'footer.php'; ?>