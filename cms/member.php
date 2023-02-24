<?php include 'header.php' ?>
<?php
$menu_title = "Member";
$page = "member";
$PK_field = "member_id";
$PK_status = "content_status";
$tbl_name = $FTblName . "_member";
$fieldlist = array('content_name', 'content_coach', 'content_detail', 'content_code', 'content_status');
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
<style>
    thead,
    tbody,
    tfoot,
    tr,
    td,
    th {
        border: none;
    }
</style>

<body class="g-sidenav-show  bg-gray-100">
    <?php include 'sidebar.php'; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php include 'navbar.php'; ?>
        <div class="container-fluid py-4">

            <!-- content here!! -->
            <div class="row">
                <div class="nav-wrapper position-relative end-0">
                    <button class="btn btn-success" onclick="javascript:window.location.href='<?php echo $page; ?>-export.php';">Export Member</button>
                </div>
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <!-- <h6>Student</h6> -->
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <div class="batch-filter col-3 card-header">
                                    <select id="batchFilter" class="form-control" style="padding: 0.5rem 2rem;">
                                        <option value="">Select Batch</option>
                                        <?php
                                        $sql_batch = "select * from mbgt_batch where batch_status = 1";
                                        $q_batch = $mysqli->query($sql_batch);
                                        while ($r_batch = $q_batch->fetch_assoc()) {
                                            echo '<option value="' . $r_batch['batch_name'] . '">' . $r_batch['batch_name'] . '</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                                <table id="member-list" class="table align-items-center mb-0 caption-top">
                                    <thead>
                                        <tr class="text-center">

                                            <th scope="col">#</th>
                                            <th scope="col">UserID</th>
                                            <th scope="col">Code</th>
                                            <th scope="col">Batch</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Display Name</th>
                                            <th scope="col">Register Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $s = "SELECT * FROM `" . $tbl_name . "`  ";
                                        #echo $s;
                                        $q = $mysqli->query($s);
                                        while ($r = $q->fetch_assoc()) {
                                            if ($r['member_batch']) {
                                                foreach (json_decode($r['member_batch']) as $item) {
                                        ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $r['member_id']; ?></td>
                                                        <td><?php echo $r['userid']; ?></td>
                                                        <td><?php echo $r['emp_code']; ?></td>
                                                        <td class="text-center"><?php
                                                                                $sql_batch = "select * from mbgt_batch where batch_id = " . $item;
                                                                                $q_batch = $mysqli->query($sql_batch);
                                                                                $r_batch = $q_batch->fetch_assoc();
                                                                                echo $r_batch['batch_name'];
                                                                                ?></td>
                                                        <td><?php echo $r['emp_name']; ?></td>
                                                        <td><?php echo $r['displayname']; ?></td>
                                                        <td class=" text-center">
                                                            <?php echo $r['createdate']; ?>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <?php if ($r['status'] === '1') { ?>
                                                                <span class="badge badge-sm bg-gradient-success"> Active </span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-sm bg-gradient-secondary"> Inactive </span>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <a href="<?php echo $page; ?>-update.php?member_id=<?php echo $r['member_id'] ?>&mode=update" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                                Edit
                                                            </a>
                                                        </td>
                                                    </tr>
                                        <?php
                                                }
                                            }
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


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <script>
        $("document").ready(function() {

            $("#member-list").dataTable({
                "dom": 'Bfrtip',
                "searching": true,
            });
            $('#member-list_filter > label').hide();
            //Get a reference to the new datatable
            var table = $('#member-list').DataTable();

            $("#member-list_filter.dataTables_filter").append($("#batchFilter"));

            var categoryIndex = 0;
            $("#member-list th").each(function(i) {
                if ($($(this)).html() == "Batch") {
                    categoryIndex = i;
                    return false;
                }
            });

            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var selectedItem = $('#batchFilter').val()
                    var category = data[categoryIndex];
                    if (selectedItem === "" || category.includes(selectedItem)) {
                        return true;
                    }
                    return false;
                }
            );

            $("#batchFilter").change(function(e) {
                table.draw();
            });

            table.draw();
        });
    </script>