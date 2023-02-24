<?php include 'header.php' ?>

<?php

$menu_title = "Course Feedback";
$page = "feedback";
?>

<body class="g-sidenav-show  bg-gray-100">
    <?php include 'sidebar.php'; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php include 'navbar.php'; ?>
        <div class="container-fluid py-4">

           <!-- content here!! -->
           <div class="row my-4">
                <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-6 col-7">
                                    <h4>Course Feedback</h4>
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
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Orientation classes</h6>
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
                                                <span class="text-xs font-weight-bold"> 12</span>
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
                                            <td>
                                                <a href="feedback-update.php"> <i class="fas fa-edit"></i> <span>Edit</span></a>
                                            </td>
                                        </tr>
                                        <tr>
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
                                        
                                        <td>
                                            <a href="feedback-update.php"> <i class="fas fa-edit"></i> <span>Edit</span></a>
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
                                            <td>
                                                <a href="feedback-update.php"> <i class="fas fa-edit"></i> <span>Edit</span></a>
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
                                            <td>
                                                <a href="feedback-update.php"> <i class="fas fa-edit"></i> <span>Edit</span></a>
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
                                            <td>
                                                <a href="feedback-update.php"> <i class="fas fa-edit"></i> <span>Edit</span></a>
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
                                            <td>
                                                <a href="feedback-update.php"> <i class="fas fa-edit"></i> <span>Edit</span></a>
                                            </td>
                                        </tr>
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