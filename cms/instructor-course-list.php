<?php include 'header.php' ?>
<?php
$menu_title = "Course";
$page = "course";
$PK_field = "content_id";
$PK_status = "course_status";
$tbl_name = $FTblName . "_course";

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
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course Name</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $s = "SELECT * FROM mbgt_course  where course_instructor =" . $_GET['instructor_id'] . " order by $PK_field asc ";
                    #echo $s;
                    $q = $mysqli->query($s);
                    while ($r = $q->fetch_assoc()) {
                    ?>
                      <tr>
                        <td>
                          <div class="align-middle text-center">
                            <img src="<?php echo $r['content_picture']; ?>" class="avatar avatar-sm me-3">
                          </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <?php echo $r['content_name'] ?>
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