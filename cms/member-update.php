<?php include 'header.php' ?>
<?php
$menu_title = "Member";
$page = "member";
$PK_field = "member_id";
$PK_status = "member_status";
$tbl_name = $FTblName . "_member";
$fieldlist = array('member_batch', 'emp_code', 'emp_name', 'emp_surname', 'emp_nickname', 'member_email', 'member_position', 'brand_agency', 'status');
$pagesize = 25;
if (isset($_POST['mode'])) {
    #echo "mode";
    if ($_POST['mode'] == "add") {
        include "../include/m_add.php";
    }
    if ($_POST['mode'] == "update") {
        $_POST['member_batch'] = json_encode($_POST['member_batch']);
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
        <div class="container py-4">

            <div class="card">
                <div class="card-body p-3 mt-2">

                    <!-- content here!! -->
                    <form role="form" action="<?php echo $page; ?>-update.php" method="post">
                        <?php if ($_GET['mode'] == "update") { ?>
                            <input name="<?php echo $PK_field; ?>" type="hidden" id="<?php echo $PK_field; ?>" value="<?php echo $$PK_field; ?>">
                        <?php } ?>
                        <input type="hidden" id="mode" name="mode" value="<?php echo $_GET['mode']; ?>">

                        <div class="mb-3">
                            <label for="Name">EMP Code</label>
                            <input type="text" class="form-control" placeholder="EMP Code" aria-label="EMP Code" aria-describedby="email-addon" id="emp_code" name="emp_code" value="<?php echo $emp_code; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="Name">EMP Name</label>
                            <input type="text" class="form-control" placeholder="EMP Name" aria-label="EMP Name" aria-describedby="email-addon" id="emp_name" name="emp_name" value="<?php echo $emp_name; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="Surname">EMP Surname</label>
                            <input type="text" class="form-control" placeholder="EMP Surname" aria-label="EMP surname" aria-describedby="email-addon" id="emp_surname" name="emp_surname" value="<?php echo $emp_surname; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="Surname">EMP Nickname</label>
                            <input type="text" class="form-control" placeholder="EMP Surname" aria-label="EMP surname" aria-describedby="email-addon" id="emp_nickname" name="emp_nickname" value="<?php echo $emp_nickname; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="Name">Company Email</label>
                            <input type="text" class="form-control" placeholder="Company Email" aria-label="Email" aria-describedby="email-addon" id="member_email" name="member_email" value="<?php echo $member_email; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="Name">Position</label>
                            <input type="text" class="form-control" placeholder="Position" aria-label="Position" aria-describedby="email-addon" id="member_position" name="member_position" value="<?php echo $member_position; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="Name">Brand Agency</label>
                            <!-- <input type="text" class="form-control" placeholder="Brand Agency" aria-label="Brand Agency" aria-describedby="email-addon" id="brand_agency" name="brand_agency" value="<?php echo $brand_agency; ?>"> -->
                            <select name="brand_agency" id="brand_agency" class="form-select">
                                <option <?= $brand_agency == 'Mediabrands' ? ' selected="selected"' : ''; ?> value="Mediabrands">Mediabrands</option>
                                <option <?= $brand_agency == 'Initiative' ? ' selected="selected"' : ''; ?> value="Initiative">Initiative</option>
                                <option <?= $brand_agency == 'UM' ? ' selected="selected"' : ''; ?> value="UM">UM</option>
                                <option <?= $brand_agency == 'MBCS' ? ' selected="selected"' : ''; ?> value="MBCS">MBCS</option>
                                <option <?= $brand_agency == 'BPN' ? ' selected="selected"' : ''; ?> value="BPN">BPN</option>
                                <option <?= $brand_agency == 'MANGNA' ? ' selected="selected"' : ''; ?> value="MANGNA">MANGNA</option>
                                <option <?= $brand_agency == 'THRIVE' ? ' selected="selected"' : ''; ?> value="THRIVE">THRIVE</option>
                                <option <?= $brand_agency == 'matterkind' ? ' selected="selected"' : ''; ?> value="matterkind">matterkind</option>
                                <option <?= $brand_agency == 'REPISE' ? ' selected="selected"' : ''; ?> value="REPISE">REPISE</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Name">Assign Student To Batch</label>
                            <div class="col-6">
                                <select id="choices-multiple-remove-button" name="member_batch[]" id="member_batch" placeholder="Select member batch" multiple>
                                    <?php
                                    $sql_batch = "select * from mbgt_batch where batch_status=1 order by batch_id desc";
                                    $q_batch = $mysqli->query($sql_batch);


                                    $sql_member_batch = "select member_batch from mbgt_member where member_id = " . $_GET['member_id'];

                                    $q_member_batch = $mysqli->query($sql_member_batch);
                                    $rec_member_batch = $q_member_batch->fetch_assoc();
                                    while ($rec_batch = $q_batch->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $rec_batch['batch_id'] ?>" <?php

                                                                                                if ($rec_member_batch['member_batch'] !== null && in_array($rec_batch['batch_id'], json_decode($rec_member_batch['member_batch']))) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $rec_batch['batch_name'];
                                                                                                        ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>
                                <input type="checkbox" id="status" name="status" value="1" <?php if ($status == "0") { ?> <?php } else { ?>checked="checked" <?php } ?>> Active
                            </label>
                        </div>

                        <div class="text-center col-2 d-flex">
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Submit</button>
                            <button type="button" class="btn btn-link w-100 my-4 mb-2" onclick="javascript:window.location.href='<?php echo $page; ?>.php';">Cancel</button>
                        </div>
                    </form>

                </div>
            </div>
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