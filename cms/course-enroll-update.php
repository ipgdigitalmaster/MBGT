<?php include 'header.php' ?>
<?php
$menu_title = "Course";
$page = "course-enroll";
$PK_field = "content_id";
$PK_status = "pass_status";
$tbl_name = $FTblName . "_enroll";
$fieldlist = array('content_id', 'course_id', 'enroll_date', 'pass_status');
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
    window.location.href = '<?php echo $page . ".php?content_id=" . $_POST['course_id']; ?>';
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
      $content_picture = $rec['content_picture'];
    }
  } else {
  ?>
    <script>
      window.location.href = '<?php echo $page . ".php?content_id=" . $_POST['course_id']; ?>';
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
        <?php if ($_GET['mode'] == "update") { ?>
          <input name="<?php echo $PK_field; ?>" type="hidden" id="<?php echo $PK_field; ?>" value="<?php echo $$PK_field; ?>">
          <input name="course_id" type="hidden" id="course_id" value="<?php echo $_GET['course_id']; ?>">
        <?php } ?>
        <input type="hidden" id="mode" name="mode" value="<?php echo $_GET['mode']; ?>">
        <div class="mb-3">
          <label for="pass_status">Pass Status</label></br>
          <input type="checkbox" id="pass_status" name="pass_status" value="1" <?php if ($pass_status === "1") { ?>checked="checked" <?php } ?>> Active

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