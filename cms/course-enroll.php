<?php include 'header.php' ?>
<?php
$menu_title = "Course";
$page = "course";
$PK_field = "content_id";
$PK_status = "content_status";
$tbl_name = $FTblName . "_enroll";

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
                <table class="table align-items-center mb-0" id="myTable" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Profile Pic</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Emp Code</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Certification</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pass Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Edit</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $s = "SELECT * FROM mbgt_enroll, mbgt_member where course_id =" . $_GET['content_id'] . " and mbgt_enroll.userid = mbgt_member.userid order by $PK_field asc ";
                    #echo $s;
                    $q = $mysqli->query($s);
                    while ($r = $q->fetch_assoc()) {
                    ?>
                      <tr>
                        <td class="align-middle text-center">
                          <img src="<?php echo $r['pictureurl']; ?>" class="avatar avatar-sm me-3">
                        </td>
                        <td class="align-middle text-center text-sm">
                          <?php echo $r['emp_code'] ?>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <?php echo $r['emp_name'] ?>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <?php
                          if ($r['pass_status'] == 1) {
                            echo '<a href="' . $r['certification_path'] . '" target="_blank">Certification</a>';
                          } else {
                            echo '-';
                          }

                          ?>

                        </td>
                        <td class="align-middle text-center text-sm">
                          <?php echo $r['pass_status'] ?>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <a href="course-enroll-update.php?content_id=<?php echo $r[$PK_field]; ?>&course_id=<?php echo  $_GET['content_id'] ?>&mode=update">Edit</a>
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
  <script>
    $(function() {
      $('#myTable').dataTable({
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
        "bInfo": false,
        "bAutoWidth": false,
        "pageLength": 200,
        "bPaginate": false,
        "aaSorting": [
          [0, "desc"]
        ]
      });
    });
  </script>