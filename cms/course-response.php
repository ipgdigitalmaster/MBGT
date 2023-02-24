<?php include 'header.php' ?>
<?php 
$menu_title = "Course";
$page = "course";
$PK_field = "content_id";
$PK_status = "content_status";
$tbl_name = $FTblName . "_response";
$fieldlist = array('content_name','content_coach','content_detail','content_code','content_status');
$pagesize = 25;
if(isset($_GET['del']) && $_GET['del'] == "true"){
	#$d="delete from `".$FTblName."_administrator` where admin_id = '".trim($_GET['del'])."' ";
	$d="UPDATE `".$tbl_name."` SET $PK_status = '2' where $PK_field = '".trim($_GET[$PK_field])."' ";
	$mysqli->query($d);
	?>
	<script>window.location.href='<?php echo $page.".php"; ?>';</script>
	<?php
}


$s="SELECT * FROM `".$FTblName."_course` where content_id = '".$_GET['content_id']."' ";
#echo $s;
$q = $mysqli->query($s);
$r = $q->fetch_assoc();
$menu_title = $r['content_name'];
?>
<body class="g-sidenav-show  bg-gray-100">
    <?php include 'sidebar.php'; ?> 
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php include 'navbar.php'; ?>
        <div class="container-fluid py-4">

           <!-- content here!! --> 
        <div class="col-lg-2 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
          <div class="nav-wrapper position-relative end-0">
            <button class="btn btn-success" onclick="javascript:window.location.href='<?php echo $page;?>-response-update.php?content_id=<?php echo $_GET['content_id'];?>&mode=add';">Add Feedback</button>
          </div>
        </div>
        <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6><?php echo $menu_title;?></h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Feedback</th> 
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">To</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Push MSG</th> 
                    </tr>
                  </thead>
                  <tbody>

                  <?php 
$s="SELECT * FROM `".$tbl_name."` a inner join `".$FTblName."_member` b on a.userid = b.userid where course_id = '".$_GET['content_id']."' order by $PK_field asc ";
#echo $s;
$q = $mysqli->query($s);
while ($r = $q->fetch_assoc()){ 
?>
<tr>
  <td>
    <div class="d-flex px-2 py-1"> 
      <div class="d-flex flex-column">
        <h6 class="mb-0 text-sm"><?php echo $r['content_detail'];?></h6>
      </div>
    </div>
  </td>
  <td>
    <div class="d-flex px-2 py-1"> 
      <div class="d-flex flex-column">
        <h6 class="mb-0 text-sm"><?php echo $r['emp_name'];?> (<?php echo $r['emp_code'];?>)</h6>
        <p class="text-xs text-secondary mb-0"><?php echo $r['userid'];?></p>
      </div>
    </div>
  </td>
  <td>
    <div class="d-flex px-2 py-1"> 
      <div class="d-flex flex-column">
        <h6 class="mb-0 text-sm"><a href="javascript:push_msg('<?php echo $r['content_id'];?>');">Push MSG</a></h6>
      </div>
    </div>
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
  function push_msg(id){
    $.post( "push.php", { id: id })
        .done(function( data ) { console.log('Update ',data); alert('Push Completed.') });
  }
</script>