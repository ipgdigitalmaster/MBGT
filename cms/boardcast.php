<?php
include("header.php");
include("boardcast-config.php");
if (isset($_GET['del'])) {
    #$d="delete from `".$FTable."_administrator` where admin_id = '".trim($_GET['del'])."' ";
    $d = "UPDATE `" . $tbl_name . "` SET content_status = '2' where content_id = '" . trim($_GET['del']) . "' ";
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
            <div class="col-lg-2 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <!-- <div class="nav-wrapper position-relative end-0">
          <button class="btn btn-success" onclick="javascript:window.location.href='<?php echo $page; ?>-update.php?mode=add';">Add New</button>
        </div> -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6><?php echo $menu_title; ?> table</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Profile Pic</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Emp Code</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pass Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>
                                                <div class="align-middle text-center">
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">

                                            </td>
                                            <td class="align-middle text-center text-sm">
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="course-enroll-update.php?content_id=<?php echo $r[$PK_field]; ?>&mode=update">Edit</a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include("footer.php"); ?>
    <script type="text/javascript">
        $(function() {
            $('input[name="datetimepicker1"]').daterangepicker();
        });
    </script>