<?php

use phpseclib3\Math\BinaryField\Integer;

include 'header.php';
include("../include/config.php");
include("../include/function-line.php");

?>
<?php $menu_title = "Dashboard";
$page = "dashboard";
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
$lineData['token'] = $token;
$usage = getLINEQuota($lineData);

$message = json_decode($usage['message']);

?>

<body class="g-sidenav-show  bg-gray-100">
    <?php include 'sidebar.php'; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php include 'navbar.php'; ?>
        <div class="container-fluid py-4">
            <!-- content here!! -->

            <div class="row">

                <div class="card mb-4">
                    <div class="card-body">
                        <h4><b>Messages sent this month</b> <i class="sidenav-icon feather icon-help-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top"></i></h4>
                        <span>Free messages sent: <?php echo $message->totalUsage ?>/1,000</span>
                        <div class="row align-items-center">
                            <div class="col">
                                <span class="badge bg-primary"><?php echo ($message->totalUsage * 100) / 1000 ?>%</span>
                            </div>
                        </div>
                        <div class="progress mt-1">
                            <!-- <div class="progress-bar bg-primary" style="width:0%"></div> -->
                            <div class="progress-bar bg-primary" style="width:<?php echo ($message->totalUsage * 100) / 1000 ?>%"></div>
                        </div>
                        <div class="row">
                            <div class="col mt-1">
                                <small class="form-text text-muted">The number of messages sent will be updated daily at 5:00 AM.</small>
                            </div>
                            <div class="col mt-1 text-end">
                                <small class="mb-0 text-decoration-underline"><a href="https://manager.line.biz/account/@236kpthh" target="_blank">View Detail</a></small>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Friend Chart  -->
            <div class="row mt-4">

                <div class="col-lg-5 mb-lg-0 mb-4">
                    <div class="card z-index-2">
                        <div class="card-body p-3">

                            <h4 class="ms-2 mt-4 mb-0"> Friends Overview </h4>
                            <p class="text-sm ms-2"> (<span class="font-weight-bolder">+23%</span>) than last week </p>

                            <div class="col-xl-12 col-sm-6 mb-xl-0 mt-3 pt-2 pb-2">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Friends added chart</p>
                                                    <h5 class="font-weight-bolder mb-0">
                                                        53,000
                                                        <span class="text-success text-sm font-weight-bolder">+55%</span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-sm-6 mb-xl-0 mt-3 pt-2 pb-2">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Target reach</p>
                                                    <h5 class="font-weight-bolder mb-0">
                                                        2,300
                                                        <span class="text-success text-sm font-weight-bolder">+3%</span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="fas fa-user-tag"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-sm-6 mb-xl-0 mt-3 pt-2 pb-2">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Blocked count</p>
                                                    <h5 class="font-weight-bolder mb-0">
                                                        +3,462
                                                        <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="fas fa-user-times"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- friend chart -->

                <div class="col-lg-7">
                    <div class="card z-index-2">
                        <div class="card-header pb-0">
                            <h4>Friends Chart</h4>
                            <p class="text-sm">
                                <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold">4% more</span> in 2021
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                            </div>
                            <div class="chart" style="display:none">
                                <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

            <!-- Complete course -->
            <!-- <div class="row mt-4">
                <div class="col-12 col-lg-10">
                    <div class="card blur shadow-blur">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                        <h4 class="mb-4">Skill Development Plan</h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center">
                        
                            <tbody>
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                        <div>
                                            Leadership ( one on two)
                                        </div>
                                        <div class="ms-4">
                                            <p class="text-xs font-weight-bold mb-0">Coach:</p>
                                            <h6 class="text-sm mb-0">Lhee</h6>
                                        </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Schedule:</p>
                                        <h6 class="text-sm mb-0">7 June 2022</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Must Attend:</p>
                                        <h6 class="text-sm mb-0">12 people</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Optional join:</p>
                                        <h6 class="text-sm mb-0">-</h6>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                    <div>
                                        <img
                                        src="../../assets/img/icons/flags/DE.png"
                                        alt="Country flag"
                                        />
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-xs font-weight-bold mb-0">Coach:</p>
                                        <h6 class="text-sm mb-0">Germany</h6>
                                    </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                    <h6 class="text-sm mb-0">3.900</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">Value:</p>
                                    <h6 class="text-sm mb-0">$440,000</h6>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">
                                    <div class="col text-center">
                                    <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                    <h6 class="text-sm mb-0">40.22%</h6>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                    <div>
                                        <img
                                        src="../../assets/img/icons/flags/GB.png"
                                        alt="Country flag"
                                        />
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-xs font-weight-bold mb-0">Coach:</p>
                                        <h6 class="text-sm mb-0">Great Britain</h6>
                                    </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                    <h6 class="text-sm mb-0">1.400</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">Value:</p>
                                    <h6 class="text-sm mb-0">$190,700</h6>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">
                                    <div class="col text-center">
                                    <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                    <h6 class="text-sm mb-0">23.44%</h6>
                                    </div>
                                </td>
                                </tr>
                                <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                    <div>
                                        <img
                                        src="../../assets/img/icons/flags/BR.png"
                                        alt="Country flag"
                                        />
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-xs font-weight-bold mb-0">Coach:</p>
                                        <h6 class="text-sm mb-0">Brasil</h6>
                                    </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                    <h6 class="text-sm mb-0">562</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">Value:</p>
                                    <h6 class="text-sm mb-0">$143,960</h6>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">
                                    <div class="col text-center">
                                    <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                    <h6 class="text-sm mb-0">32.14%</h6>
                                    </div>
                                </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div> -->

            <div class="row my-4">
                <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-6 col-7">
                                    <h4>Skill Development Plan</h4>
                                    <p class="text-sm mb-0">
                                        <i class="fa fa-check text-info" aria-hidden="true"></i>
                                        <span class="font-weight-bold ms-1">30 done</span> this month
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Members</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Must-attend</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Completion</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $s = "SELECT * FROM `" . $tbl_name . "` where $PK_status <> '2' order by $PK_field asc ";
                                        $q = $mysqli->query($s);
                                        while ($r = $q->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="<?php echo $r['content_picture']; ?>" class="avatar avatar-sm me-3" alt="xd">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"><?php echo $r['content_name']; ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="avatar-group mt-2">
                                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                                            <img src="assets/img/team-1.jpg" alt="team1">
                                                        </a>
                                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                                                            <img src="assets/img/team-2.jpg" alt="team2">
                                                        </a>
                                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                                                            <img src="assets/img/team-3.jpg" alt="team3">
                                                        </a>
                                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                                            <img src="assets/img/team-4.jpg" alt="team4">
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="text-xs font-weight-bold"> <?= (rand(1, 12)); ?></span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="progress-wrapper w-75 mx-auto">
                                                        <div class="progress-info">
                                                            <div class="progress-percentage">
                                                                <?php $percent = (rand(10, 100)); ?>
                                                                <span class="text-xs font-weight-bold"><?= $percent  ?>%</span>
                                                            </div>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-info w-100" role="progressbar" aria-valuenow="<?= $percent  ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!--<tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="assets/img/small-logos/logo-atlassian.svg" class="avatar avatar-sm me-3" alt="atlassian">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Leadership ( one on two)</h6>
                                                </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group mt-2">
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                                                    <img src="assets/img/team-2.jpg" alt="team5">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                                    <img src="assets/img/team-4.jpg" alt="team6">
                                                </a>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> 12 </span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="progress-wrapper w-75 mx-auto">
                                                <div class="progress-info">
                                                    <div class="progress-percentage">
                                                    <span class="text-xs font-weight-bold">10%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info w-10" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm me-3" alt="team7">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">EQ</h6>
                                                </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group mt-2">
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                                                    <img src="assets/img/team-3.jpg" alt="team8">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                                    <img src="assets/img/team-1.jpg" alt="team9">
                                                </a>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> 9 </span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="progress-wrapper w-75 mx-auto">
                                                <div class="progress-info">
                                                    <div class="progress-percentage">
                                                    <span class="text-xs font-weight-bold">100%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm me-3" alt="spotify">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">English conversation skill</h6>
                                                </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group mt-2">
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                                    <img src="assets/img/team-4.jpg" alt="user1">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Romina Hadid">
                                                    <img src="assets/img/team-3.jpg" alt="user2">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alexander Smith">
                                                    <img src="assets/img/team-4.jpg" alt="user3">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                                    <img src="assets/img/team-1.jpg" alt="user4">
                                                </a>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> 8 </span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="progress-wrapper w-75 mx-auto">
                                                <div class="progress-info">
                                                    <div class="progress-percentage">
                                                    <span class="text-xs font-weight-bold">100%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm me-3" alt="jira">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Strategic and Creative Thinking</h6>
                                                </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group mt-2">
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                                    <img src="assets/img/team-4.jpg" alt="user5">
                                                </a>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> 10 </span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="progress-wrapper w-75 mx-auto">
                                                <div class="progress-info">
                                                    <div class="progress-percentage">
                                                    <span class="text-xs font-weight-bold">25%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="25"></div>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="assets/img/small-logos/logo-invision.svg" class="avatar avatar-sm me-3" alt="invision">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Influence people</h6>
                                                </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group mt-2">
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                                                    <img src="assets/img/team-1.jpg" alt="user6">
                                                </a>
                                                <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Jessica Doe">
                                                    <img src="assets/img/team-4.jpg" alt="user7">
                                                </a>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">8 </span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="progress-wrapper w-75 mx-auto">
                                                <div class="progress-info">
                                                    <div class="progress-percentage">
                                                    <span class="text-xs font-weight-bold">40%</span>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info w-40" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="40"></div>
                                                </div>
                                                </div>
                                            </td>
                                        </tr> -->

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

</body>

</html>