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
      <div class="col-lg-2 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
        <div class="nav-wrapper position-relative end-0">
          <button class="btn btn-success" onclick="javascript:window.location.href='<?php echo $page; ?>-update.php?mode=add';">Add New</button>
        </div>
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-secondary opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $s = "SELECT * FROM `" . $tbl_name . "` where $PK_status <> '2' order by $PK_field asc ";
                    #echo $s;
                    $q = $mysqli->query($s);
                    while ($r = $q->fetch_assoc()) {
                    ?>
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <!--div>
                            <img src="assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user2">
                          </div-->
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?php echo $r['admin_firstname']; ?> <?php echo $r['admin_lastname']; ?></h6>
                              <p class="text-xs text-secondary mb-0"><?php echo $r['admin_username']; ?></p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0"><?php echo $r['admin_type']; ?></p>
                          <!--p class="text-xs text-secondary mb-0">Developer</p-->
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-secondary"><?php if (strlen($r[$PK_status]) > 0) {
                                                                                echo "ACTIVE";
                                                                              } else {
                                                                                echo "NOT ACTIVE";
                                                                              } ?></span>
                        </td>
                        <td class="align-middle">
                          <a href="<?php echo $page; ?>-update.php?<?php echo $PK_field; ?>=<?php echo $r[$PK_field]; ?>&mode=update" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                            Edit
                          </a>
                        </td>
                        <td class="align-middle">
                          <?php if ($r[$PK_field] != '1') { ?>
                            <a href="?del=true&<?php echo $PK_field; ?>=<?php echo $r[$PK_field]; ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete user">Delete</a>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>
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