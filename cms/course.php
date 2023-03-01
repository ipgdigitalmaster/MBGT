<?php include 'header.php' ?>
<?php
$menu_title = "Course";
$page = "course";
$PK_field = "content_id";
$PK_status = "content_status";
$tbl_name = $FTblName . "_course";
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
      <div>
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
              <div class="table-responsive mx-2">

                <div class="batch-filter col-3 card-header mr-3">
                  <select id="batchFilter" class="form-control mb-4" style="padding: 0.5rem 2rem;">
                    <option value="">All Batch</option>
                    <?php

                    $sql_batch = "select * from mbgt_batch where batch_status = 1 order by batch_id DESC";
                    $q_batch = $mysqli->query($sql_batch);
                    while ($r_batch = $q_batch->fetch_assoc()) {
                      echo '<option value="' . $r_batch['batch_name'] . '">' . $r_batch['batch_name'] . '</option>';
                    }

                    ?>
                  </select>
                </div>

                <table id="course-list" class="table row-border align-items-center mb-0  ">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-xxs">ID</th>
                      <th class="text-uppercase text-xxs">Course Name</th>
                      <th class="text-uppercase text-xxs">Batch</th>
                      <th class="text-uppercase text-xxs text-center">Status</th>
                      <th class="text-uppercase text-xxs">Student</th>
                      <th class="text-uppercase text-xxs">Broadcast</th>
                      <th class="text-uppercase text-xxs">MSG</th>
                      <th class="text-uppercase text-xxs">Feedback</th>
                      <th class="text-uppercase text-xxs text-center">Action</th>
                      <!-- <th class="text-uppercase text-xxs"></th> -->
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $s = "SELECT * FROM `" . $tbl_name . "` where $PK_status <> '2' order by $PK_field DESC ";
                    #echo $s;
                    $q = $mysqli->query($s);
                    while ($r = $q->fetch_assoc()) {
                    ?>
                      <tr>

                        <td class="text-center">
                          <span><?= $r['content_id'] ?></span>
                        </td>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="<?php echo $r['content_picture']; ?>" class="avatar avatar-sm me-3">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?php echo $r['content_name']; ?></h6>
                              <p class="text-xs text-secondary mb-0"><?php echo $r['content_coach']; ?></p>
                            </div>
                          </div>
                        </td>
                        <td class="text-center text-center text-sm">
                          <?php
                          $sql_batch = "select * from mbgt_batch where batch_id = " . $r['course_batch'];
                          $q_batch = $mysqli->query($sql_batch);
                          $r_batch = $q_batch->fetch_assoc();
                          echo $r_batch['batch_name'];
                          ?>
                        </td>
                        <td class="text-center text-center text-sm">
                          <span class="badge badge-sm <?= $r[$PK_status] == 1 ? 'bg-gradient-success' : 'bg-gradient-secondary' ?>">
                            <?php if (strlen($r[$PK_status]) > 0) {
                              echo "ACTIVE";
                            } else {
                              echo "NOT ACTIVE";
                            } ?>
                          </span>
                        </td>
                        <td class="text-center">
                          <a href="<?php echo $page; ?>-enroll.php?<?php echo $PK_field; ?>=<?php echo $r[$PK_field]; ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="MSG">
                            <i class="fas fa-eye text-primary"> </i>
                          </a>
                        </td>
                        <td class="text-center">
                          <a href="<?php echo $page; ?>-boardcast.php?<?php echo $PK_field; ?>=<?php echo $r[$PK_field]; ?>&mode=update" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="MSG">
                            Broadcast
                          </a>
                        </td>
                        <td class="text-center">
                          <a href="<?php echo $page; ?>-request.php?<?php echo $PK_field; ?>=<?php echo $r[$PK_field]; ?>&mode=update" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="MSG">
                            MSG
                          </a>
                        </td>
                        <td class="text-center">
                          <a href="<?php echo $page; ?>-response.php?<?php echo $PK_field; ?>=<?php echo $r[$PK_field]; ?>&mode=update" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Feedback Course">
                            Feedback
                          </a>
                        </td>
                        <td class="text-center">
                          <a href="<?php echo $page; ?>-update.php?<?php echo $PK_field; ?>=<?php echo $r[$PK_field]; ?>&mode=update" class="text-info font-weight-bold text-xs mr-4" data-toggle="tooltip" data-original-title="Edit Course">
                            <i class="fas fa-pencil-alt text-info me-2 " aria-hidden="true"></i> Edit </a>&nbsp;&nbsp;&nbsp;
                          <!-- </td>
                        <td class="align-middle"> -->
                          <?php //if ($r[$PK_field]!='1'){ 
                          ?>
                          <a href="?del=true&<?php echo $PK_field; ?>=<?php echo $r[$PK_field]; ?>" onclick="return confirm('Are you sure you want to delete this item?');" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete Course">
                            <i class="far fa-trash-alt me-2 text-danger" aria-hidden="true"></i>
                          </a>
                          <?php //} 
                          ?>
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

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

  <script>
    $("document").ready(function() {

      $("#course-list").dataTable({
        "dom": 'Bfrtip',
        "order": [
          [0, 'desc']
        ],
        "searching": true,
      });
      $('#course-list_filter > label').hide();

      //Get a reference to the new datatable
      var table = $('#course-list').DataTable();

      $("#course-list_filter.dataTables_filter").append($("#batchFilter"));

      var categoryIndex = 0;
      $("#course-list th").each(function(i) {
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