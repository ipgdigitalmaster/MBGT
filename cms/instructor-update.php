<?php include 'header.php' ?>
<?php
$menu_title = "Instructor";
$page = "instructor";
$PK_field = "instructor_id";
$PK_status = "instructor_status";
$tbl_name = $FTblName . "_instructor";
$fieldlist = array('instructor_name', 'instructor_nickname', 'instructor_email', 'instructor_position', 'instructor_company', 'instructor_profile_information', 'instructor_status');
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
                    <label for="Name">Instructor Name</label>
                    <input type="text" class="form-control" placeholder="Instructor Name" aria-label="Instructor Name" aria-describedby="email-addon" id="instructor_name" name="instructor_name" value="<?php echo $instructor_name; ?>">
                </div>
                <div class="mb-3">
                    <label for="Name">Instructor Nickname</label>
                    <input type="text" class="form-control" placeholder="Instructor Nickname" aria-label="Instructor Nickname" aria-describedby="email-addon" id="instructor_nickname" name="instructor_nickname" value="<?php echo $instructor_nickname; ?>">
                </div>
                <div class="mb-3">
                    <label for="Name">Instructor Email</label>
                    <input type="text" class="form-control" placeholder="Instructor Email" aria-label="Instructor Email" aria-describedby="email-addon" id="instructor_email" name="instructor_email" value="<?php echo $instructor_email; ?>">
                </div>
                <div class="mb-3">
                    <label for="Name">Instructor Position</label>
                    <input type="text" class="form-control" placeholder="Instructor Position" aria-label="Instructor Position" aria-describedby="email-addon" id="instructor_position" name="instructor_position" value="<?php echo $instructor_position; ?>">
                </div>
                <div class="mb-3">
                    <label for="Name">Instructor Company</label>
                    <!-- <input type="text" class="form-control" placeholder="Instructor Company" aria-label="Instructor Company" aria-describedby="email-addon" id="instructor_company" name="instructor_company" value="<?php echo $instructor_company; ?>"> -->
                    <select name="instructor_company" id="instructor_company" class="form-select" aria-label="Default select example">
                        <option <?=$instructor_company==''? 'selected':'' ?> value="">N/A</option>
                        <option <?=$instructor_company=='Mediabrands'? 'selected':'' ?> value="Mediabrands">Mediabrands</option>
                        <option <?=$instructor_company=='Initiative'? 'selected':'' ?> value="Initiative">Initiative</option>
                        <option <?=$instructor_company=='UM'? 'selected':'' ?> value="UM">UM</option>
                        <option <?=$instructor_company=='MBCS'? 'selected':'' ?> value="MBCS">MBCS</option>
                        <option <?=$instructor_company=='BPN'? 'selected':'' ?> value="BPN">BPN</option>
                        <option <?=$instructor_company=='MANGNA'? 'selected':'' ?> value="MANGNA">MANGNA</option>
                        <option <?=$instructor_company=='THRIVE'? 'selected':'' ?> value="THRIVE">THRIVE</option>
                        <option <?=$instructor_company=='matterkind'? 'selected':'' ?> value="matterkind">matterkind</option>
                        <option <?=$instructor_company=='REPISE'? 'selected':'' ?> value="REPISE">REPISE</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Name">Instructor Profile Information</label>
                    <textarea class="form-control" placeholder="Instructor Profile Information" aria-label="Instructor Profile Information" id="instructor_profile_information" name="instructor_profile_information"><?php echo $instructor_profile_information; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="Name">Instructor Status</label>
                    <div>
                        <input type="checkbox" id="instructor_status" name="instructor_status" value="1" <?php if ($instructor_status == "0") { ?> <?php } else { ?>checked="checked" <?php } ?>> Active
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