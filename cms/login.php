<?php
    include("../include/config.php");
    $warn = false;
	if (isset($_POST['userid']) && isset($_POST['password'])){
		$s="SELECT * FROM `".$FTblName."_administrator` where admin_username = '".$mysqli->real_escape_string($_POST['userid'])."' and  admin_password = '".md5($mysqli->real_escape_string($_POST['password']))."' and admin_status = '1' ";
		#echo $s;
		if ($result = $mysqli->query($s)) {
			if ($r = $result->fetch_assoc()){
				#echo "true";
				$warn = false;
				$_SESSION["login_id"] = $r["admin_id"];//"1"; //
				$_SESSION["login_name"] = $r["admin_firstname"];//"ADMIN"; //
				$_SESSION["login_group"] = $r["admin_type"];
                echo $_SESSION["login_id"];
                echo $_SESSION["login_name"];
                echo $_SESSION["login_group"];
				?>
				<script>
				window.location.href='<?php echo "index.php"; ?>';
				</script>
				<?php
			}else{
				$warn = true;
				#echo "false";
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    <?php echo $s_title;?>
  </title>
  <!--     Fonts and icons     -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" /> -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.5" rel="stylesheet" />
  <!-- Custom file -->
  <link href="assets/css/custom.css" rel="stylesheet" />
</head>

<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                  <p class="mb-0">Enter your email and password to sign in</p>
                </div>
                <div class="card-body">
                  <form role="form" action="login.php" method="post">
                    <label>User</label>
                    <div class="mb-3">
                      <input type="text" name="userid"  class="form-control" placeholder="User" aria-label="Email" aria-describedby="email-addon">
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" name="password"  class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                    </div>
                    <!--div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div-->
                    <?php if ($warn){ ?>
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                      <p class="mb-4 text-sm mx-auto">
                        <h4>Warning!</h4>
                        Please check username or password.
                      </p>
                    </div>
                    <?php } ?>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
                <!--div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="javascript:;" class="text-info text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div-->
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  
  <?php include 'footer.php'; ?>