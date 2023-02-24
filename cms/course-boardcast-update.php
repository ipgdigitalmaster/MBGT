<?php include 'header.php' ?>
<?php
$menu_title = "Course Boardcast";
$page = "course boardcast";
$PK_field = "content_id";
$PK_status = "content_status";
$tbl_name = $FTblName . "_course_boardcast";
$fieldlist = array('course_id', 'user_id', 'content_detail',);
$pagesize = 25;
if (isset($_POST['mode'])) {
    #echo "mode";
    if ($_POST['mode'] == "add") {
        include "../include/m_add.php";
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

            <form role="form" action="<?php echo $page; ?>-update.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="mode" name="mode" value="<?php echo $_GET['mode']; ?>">

                <div class="mb-3">
                    <label for="Name">Boardcast To</label>
                    <label>
                        <input type="checkbox" id="content_status" name="content_status" value="1" <?php if ($content_status == "0") { ?> <?php } else { ?>checked="checked" <?php } ?>> Bagde 1
                    </label>
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