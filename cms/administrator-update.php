<?php include 'header.php' ?>
<?php
$menu_title = "Admin";
$page = "administrator";
$PK_field = "admin_id";
$PK_status = "admin_status";
$tbl_name = $FTblName . "_administrator";
$page_name = "Administrator User";
$fieldlist = array('admin_firstname', 'admin_lastname', 'admin_username', 'admin_password', 'admin_type', 'admin_status');
$pagesize = 25;
$admin_firstname = "";
$admin_password = "";
$admin_lastname = "";
$admin_username = "";
$admin_type = "";
$mid = "";
if (isset($_POST['mode'])) {
    #echo "mode";
    if ($_POST['admin_password'] == "") {
        $_POST['admin_password'] = $_POST['admin_password1'];
    } else {
        $_POST['admin_password'] = md5($_POST['admin_password']);
    }
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
                    <label for="Name">First Name</label>
                    <input type="text" class="form-control" placeholder="First Name" aria-label="First Name" aria-describedby="email-addon" id="admin_firstname" name="admin_firstname" value="<?php echo $admin_firstname; ?>">
                </div>
                <div class="mb-3">
                    <label for="Name">Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" aria-label="Last Name" aria-describedby="email-addon" id="admin_lastname" name="admin_lastname" value="<?php echo $admin_lastname; ?>">
                </div>
                <div class="mb-3">
                    <label for="User">Username</label>
                    <input type="text" class="form-control" id="admin_username" name="admin_username" value="<?php echo $admin_username; ?>" placeholder="Username" aria-describedby="password-addon">
                </div>
                <div class="mb-3">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control" id="admin_password" name="admin_password" placeholder="Password">
                    <?php if ($_GET['mode'] == "update") { ?> <div class="red">* Change only</div> <?php } ?>
                    <input type="hidden" name="admin_password1" value="<? echo $admin_password; ?>" /></td>
                </div>
                <div class="mb-3">
                    <label for="User">Type</label>
                    <input name="admin_type" type="radio" id="admin_type" value="Administrator" checked="checked"> Administrator
                    <input name="admin_type" type="radio" id="admin_type" value="User" <?php if ($admin_type == 'User') { ?> checked="checked" <?php } ?>> User
                    <input name="admin_type" type="radio" id="admin_type" value="Instructor" <?php if ($admin_type == 'Instructor') { ?> checked="checked" <?php } ?>> Instructor
                </div>
                <div class="mb-3">
                    <label>
                        <input type="checkbox" id="admin_status" name="admin_status" value="1" <?php if ($admin_status == "1") { ?> checked="checked" <?php } ?>> Active
                    </label>
                </div>
                <div class="text-center col-2 d-flex">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Submit</button>
                    <button type="button" class="btn btn-link w-100 my-4 mb-2" onclick="javascript:window.location.href='<?php echo $page; ?>.php';">Cancel</button>
                </div>
            </form>

        </div>
    </main>

    <?php include 'footer.php'; ?>