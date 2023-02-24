<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; 
    $menu_title = "Profile Setting";
    $page = "profile";
    $PK_field = "admin_id";
    $PK_status = "admin_status";
    $tbl_name = $FTblName . "_administrator";
    $fieldlist = array('admin_id', 'permission_group_id', 'admin_username', 'admin_password', 'admin_firstname', 'admin_lastname', 'admin_email', 'admin_type', 'admin_status');
    $pagesize = 25;
    
    
?>

<body class="g-sidenav-show  bg-gray-100">
    <?php include 'sidebar.php'; ?>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
      <?php include 'navbar.php'; ?>
      <?php
        $s="SELECT * FROM `".$tbl_name."` where $PK_status <> '2' order by $PK_field asc ";
        $q = $mysqli->query($s);
        while ($r = $q->fetch_assoc()){ 
        
      ?>
      <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
          <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
          <div class="row gx-4">
            <div class="col-auto">
              <div class="avatar avatar-xl position-relative">
                <img src="assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
              </div>
            </div>
            <div class="col-auto my-auto">
              <div class="h-100">
                <h3 class="mb-1">
                  <?=$r['admin_firstname'];?> <?=$r['admin_lastname'];?>
                </h3>
                <p class="mb-0 font-weight-bold text-sm">
                  <?=$r['admin_type'];?>
                </p>
              </div>
            </div>
            
          </div>
        </div>
      </div>

      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12 col-xl-12">
            <div class="card h-100">
              <div class="card-header pb-0 p-3">
                <h4 class="mb-0">General Settings</h4>
              </div>
              <div class="card-body p-3">
                <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>

                <form>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" id="name" placeholder="Name" value="<?=$r['admin_firstname'];?>" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" placeholder="Role" class="form-control" value="<?=$r['admin_type'];?>" disabled />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" class="form-control" id="lastname" placeholder="Lastname" value="<?=$r['admin_lastname'];?>" />
                      </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="<?=$r['admin_email'];?>">
                      </div>
                    </div>
                  </div>
                  
                  <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Change Password</h6>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group has-success">
                        <input type="password" placeholder="Password" class="form-control is-valid" />
                      </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-6">
                      <div class="form-group has-danger">
                        <input type="password" placeholder="Confirm Password" class="form-control is-invalid" />
                      </div>
                    </div>
                  </div>
                  <div class="text-center col-2 d-flex">
                      <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Submit</button>
                      <!-- <button type="button" class="btn btn-link w-100 my-4 mb-2" onclick="javascript:window.location.href='<?php echo $page;?>.php';">Cancel</button> -->
                  </div>
                </form>
                
                
              </div>
            </div>
          </div>

          
      </div>

      <?php } ?>
    </div>
  
    <?php include 'footer.php'; ?>
</body>
</html>