<?php include 'header.php' ?>
<style>
    .dataTables_info,
    .dataTables_paginate {
        font-size: 14px !important;
    }
</style>

<?php
$tbl_name = $FTblName . "_course";
$PK_field = "content_id";
$PK_status = "content_status";
$content_id = isset($_GET['content_id']) ? $_GET['content_id'] : '1';
$s = "SELECT * FROM `" . $tbl_name . "` where $PK_status = '1' and $PK_field =" . $content_id;
#echo $s;
$q = $mysqli->query($s);
?>

<body class="g-sidenav-show  bg-gray-100">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4 ">

            <!-- content here!! -->
            <div class="">
                <?php while ($r = $q->fetch_assoc()) { ?>
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="text-center mx-auto">
                                <h1><?php echo $r['content_name']; ?></h1>
                                <div class="col-12 col-xl-8 mx-auto mt-4">
                                    <img src="<?php echo $r['content_picture']; ?>" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix mt-2 mb-3"></div>

                    <div class="card">
                        <div class="card-body p-3 mt-2">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="attendee-tab" data-bs-toggle="tab" data-bs-target="#attendee" type="button" role="tab" aria-controls="attendee" aria-selected="true">Attendee</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Class details</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active mt-4" id="attendee" role="tabpanel" aria-labelledby="attendee-tab">
                                    <div class="card">
                                        <?php
                                        $s_course = "SELECT assign_member FROM mbgt_course where content_status = '1' and content_id =" . $content_id;
                                        $q_course = $mysqli->query($s_course);

                                        ?>
                                        <div class="table-responsive">
                                            <table id="attendee-list" class="table align-items-center mb-0 ">
                                                <thead>
                                                    <tr>
                                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder">Student</th>
                                                        <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Position</th>
                                                        <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Status</th>
                                                        <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Attend time</th>
                                                        <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($r_course = $q_course->fetch_assoc()) {

                                                        if ($r_course['assign_member'] != null) {
                                                            foreach (json_decode($r_course['assign_member']) as $value) {
                                                                $s_member = "SELECT * FROM mbgt_member where member_id =" . $value;
                                                                $q_member = $mysqli->query($s_member);
                                                                while ($r_member = $q_member->fetch_assoc()) {

                                                    ?>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="d-flex px-2 py-1">
                                                                                <div>
                                                                                    <?php if (@getimagesize($r_member['pictureurl'])) { ?>
                                                                                        <img src="<?php echo $r_member['pictureurl'] ?>" class="avatar avatar-sm me-3">
                                                                                    <?php } else { ?>
                                                                                        <img src="cms/assets/img/home-decor-1.jpg" class="avatar avatar-sm me-3">
                                                                                    <?php } ?>
                                                                                </div>
                                                                                <div class="d-flex flex-column justify-content-center">
                                                                                    <h6 class="mb-0 text-xs"><?php echo $r_member['emp_name'] ?> <?php echo $r_member['emp_surname'] ?></h6>
                                                                                    <!-- <p class="text-xs text-secondary mb-0"><?php echo $r_member['member_email'] ?></p> -->
                                                                                    <p class="text-xs text-secondary mb-0"><?php echo $r_member['brand_agency'] ?></p>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <p class="text-xs font-weight-bold mb-0"><?php echo $r_member['member_position'] ?></p>
                                                                            <!-- <p class="text-xs text-secondary mb-0">Organization</p> -->
                                                                        </td>
                                                                        <td class="align-middle text-center text-sm mx-auto">
                                                                            <?php
                                                                            $s_attend = "SELECT * FROM mbgt_attend where member_id = " . $value . " and course_id = " . $content_id;

                                                                            $q_attend = $mysqli->query($s_attend);
                                                                            $r_attend = $q_attend->fetch_assoc();
                                                                            ?>
                                                                            <a class="badge badge-sm <?php if ($r_attend) {
                                                                                                            echo 'bg-success';
                                                                                                        } else {
                                                                                                            echo 'bg-secondary';
                                                                                                        } ?> " href="javascript:;"><?php if ($r_attend) {
                                                                                                                                        echo 'Joined';
                                                                                                                                    } else {
                                                                                                                                        echo 'Waiting to join';
                                                                                                                                    } ?></a>
                                                                        </td>
                                                                        <td class="align-middle text-center">
                                                                            <span class="text-secondary text-xs font-weight-normal"><?php echo  $r_attend['admission_time'] ?></span>
                                                                        </td>
                                                                        <td class="align-middle text-center">
                                                                            <a href="instructor-attendee-edit.php?cid=<?php echo $content_id ?>&member_id=<?php echo  $r_member['member_id'] ?>" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                                                Edit
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <!-- <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="cms/assets/img/team-1.jpg" class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">Alexa Liras</h6>
                                                                <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Programator</p>
                                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <a class="badge badge-sm bg-secondary " href="javascript:;">Waiting to join</a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-normal">11/01/19</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="instructor-attendee-edit.php" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="cms/assets/img/team-4.jpg" class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">Laurent Perrier</h6>
                                                                <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Executive</p>
                                                        <p class="text-xs text-secondary mb-0">Projects</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <a class="badge badge-sm bg-success " href="javascript:;">Joined</a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-normal">19/09/17</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="instructor-attendee-edit.php" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="cms/assets/img/team-1.jpg" class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">John Michael</h6>
                                                                <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                                                        <p class="text-xs text-secondary mb-0">Organization</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <a class="badge badge-sm bg-success " href="javascript:;">Joined</a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-normal">30/04/18</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="javascript:;" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="cms/assets/img/team-1.jpg" class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">Alexa Liras</h6>
                                                                <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Programator</p>
                                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <a class="badge badge-sm bg-secondary " href="javascript:;">Waiting to join</a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-normal">08/01/19</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="instructor-attendee-edit.php" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="cms/assets/img/team-4.jpg" class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">Laurent Perrier</h6>
                                                                <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Executive</p>
                                                        <p class="text-xs text-secondary mb-0">Projects</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <a class="badge badge-sm bg-success " href="javascript:;">Joined</a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-normal">06/08/17</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="instructor-attendee-edit.php" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="cms/assets/img/team-3.jpg" class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">Michael Levi</h6>
                                                                <p class="text-xs text-secondary mb-0">michael@creative-tim.com</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Programator</p>
                                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <a class="badge badge-sm bg-success " href="javascript:;">Joined</a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-normal">24/11/08</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="instructor-attendee-edit.php" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="cms/assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">Richard Gran</h6>
                                                                <p class="text-xs text-secondary mb-0">richard@creative-tim.com</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                                                        <p class="text-xs text-secondary mb-0">Executive</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <a class="badge badge-sm bg-secondary " href="javascript:;">Waiting to join</a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-normal">16/10/21</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="instructor-attendee-edit.php" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="cms/assets/img/team-4.jpg" class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">Miriam Eric</h6>
                                                                <p class="text-xs text-secondary mb-0">miriam@creative-tim.com</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Programtor</p>
                                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <a class="badge badge-sm bg-secondary " href="javascript:;">Waiting to join</a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-normal">14/09/20</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="instructor-attendee-edit.php" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="cms/assets/img/team-3.jpg" class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">Michael Levi</h6>
                                                                <p class="text-xs text-secondary mb-0">michael@creative-tim.com</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Programator</p>
                                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <a class="badge badge-sm bg-success " href="javascript:;">Joined</a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-normal">24/12/08</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="instructor-attendee-edit.php" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="cms/assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">Richard Gran</h6>
                                                                <p class="text-xs text-secondary mb-0">richard@creative-tim.com</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                                                        <p class="text-xs text-secondary mb-0">Executive</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <a class="badge badge-sm bg-secondary " href="javascript:;">Waiting to join</a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-normal">04/10/21</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="instructor-attendee-edit.php" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="cms/assets/img/team-4.jpg" class="avatar avatar-sm me-3">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">Miriam Eric</h6>
                                                                <p class="text-xs text-secondary mb-0">miriam@creative-tim.com</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">Programtor</p>
                                                        <p class="text-xs text-secondary mb-0">Developer</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <a class="badge badge-sm bg-secondary " href="javascript:;">Waiting to join</a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-normal">14/09/20</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="instructor-attendee-edit.php" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            Edit
                                                        </a>
                                                    </td>
                                                </tr> -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade mt-4" id="details" role="tabpanel" aria-labelledby="details-tab">
                                    <div class="row">
                                        <h4>Class description</h4>
                                        <p><?php echo $r['content_detail']; ?></p>
                                    </div>

                                    <!-- <div class="row">
                                        <h4>What did you learn in this course?</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    </div> -->

                                    <div class="row">
                                        <h4>Coach Name</h4>
                                        <?php
                                        $s_instructor = "SELECT * FROM mbgt_instructor where instructor_status = '1' and instructor_id ='" . $r['course_instructor'] . "'";
                                        # echo $s_instructor;
                                        $q_instructor = $mysqli->query($s_instructor);
                                        while ($r_instructor = $q_instructor->fetch_assoc()) {
                                        ?>
                                            <p><?php echo $r_instructor['instructor_name']; ?></p>
                                        <?php } ?>
                                    </div>

                                    <div class="row">
                                        <h4>Class date</h4>
                                        <?php if ($r['course_type'] === 'onsite') { ?>
                                            <p><?php echo $r['course_start_date'] . ' join class at ' . $r['course_location']; ?></p>
                                        <?php } else { ?>
                                            <p><?php echo $r['course_start_date'] . ' join class via <a href="' . $r['course_join_link'] . '">MS Team</a>'; ?></p>
                                        <?php } ?>
                                    </div>
                                    <?php if ($r['course_material']) { ?>
                                        <div class="row">
                                            <h4>Class materials</h4>
                                            <ul class=" list-group list-group-flush">
                                                <li class="list-group-item justify-content-between d-flex">
                                                    <span>Lesson 1</span>
                                                    <a href="<?php echo $r['course_material'] ?>">Download here</a>
                                                </li>
                                                <!-- <li class="list-group-item justify-content-between d-flex">
                                                    <span>Lesson 2</span>
                                                    <a href="#">Download here</a>
                                                </li>
                                                <li class="list-group-item justify-content-between d-flex">
                                                    <span>Lesson 3</span>
                                                    <a href="#">Download here</a>
                                                </li> -->
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>


        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script>
        $(function() {

            var table = $('#attendee-list').DataTable({
                dom: 'Bfrtip',
                lengthChange: false,
                buttons: ['excelHtml5']
            });

            table.buttons().container()
                .appendTo('.attendee-list_wrapper .btn btn-outline-primary');
        });
    </script>