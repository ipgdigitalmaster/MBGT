<?php include 'header.php' ?>
<?php
$tbl_name = $FTblName . "_instructor";
$PK_field = "instructor_id";
$PK_status = "instructor_status";
$instructor_id = isset($_GET['instructor_id']) ? $_GET['instructor_id'] : '1';
$s = "SELECT * FROM `" . $tbl_name . "` where $PK_status = '1' and $PK_field =" . $instructor_id;
#echo $s;
$q = $mysqli->query($s);
?>


<body class="g-sidenav-show  bg-gray-100">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php while ($r = $q->fetch_assoc()) { ?>
            <div class="container-fluid py-4">
                <div class="container-fluid">
                    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('cms/assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
                        <span class="mask bg-gradient-primary opacity-6"></span>
                    </div>
                    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                        <div class="row gx-4">
                            <div class="col-auto">
                                <div class="avatar avatar-xl position-relative">
                                    <img src="cms/assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1">
                                        <?php echo $r['instructor_name']; ?>
                                    </h5>
                                    <p class="mb-0 font-weight-bold text-sm">
                                        <?php echo $r['instructor_position']; ?>
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
                                <div class="card-body p-3">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?php echo $r['instructor_name']; ?></li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $r['instructor_email']; ?></li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Position:</strong> &nbsp; <?php echo $r['instructor_position']; ?></li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Company:</strong> &nbsp; <?php echo $r['instructor_company']; ?></li>
                                    </ul>
                                    <hr class="horizontal gray-light my-4">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h6 class="mb-0">Profile Information</h6>
                                    </div>
                                    <p class="text-sm">
                                        <?php echo $r['instructor_profile_information']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php }
                $sql_class = "SELECT * FROM `mbgt_course` where content_status = '1' and course_instructor =" . $instructor_id;

                $query_class = $mysqli->query($sql_class);
                    ?>
                    <div class="col-12 mt-4">
                        <div class="card mb-4">
                            <div class="card-header pb-0 p-3 mb-2">
                                <div class="row">
                                    <div class="col-md-9 d-flex align-items-center">
                                        <h6 class="mb-0">Classes</h6>
                                    </div>
                                    <div class="col-md-3 text-end">
                                        <select name="" id="" class="form-select">
                                            <option value="0" disabled="disabled" selected>Filter by courses</option>
                                            <option value="">All courses</option>
                                            <?php

                                            $sql_batch = "select * from mbgt_batch where batch_status = 1 order by batch_id DESC";
                                            $q_batch = $mysqli->query($sql_batch);
                                            while ($r_batch = $q_batch->fetch_assoc()) {
                                                echo '<option value="' . $r_batch['batch_id'] . '">' . $r_batch['batch_name'] . '</option>';
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-3">
                                <div class="row">
                                    <?php while ($result_class = $query_class->fetch_assoc()) { ?>
                                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                            <div class="card card-blog card-plain">
                                                <div class="position-relative">
                                                    <a class="d-block shadow-xl border-radius-xl">

                                                        <img src="<?php echo $result_class['content_picture'] ?>" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                                    </a>
                                                </div>
                                                <div class="card-body px-1 pb-0">
                                                    <p class="text-gradient text-dark mb-2 text-sm"> <?php
                                                                                                        $sql_batch = "select * from mbgt_batch where batch_status = 1 and batch_id = '" . $result_class['course_batch'] . "'";

                                                                                                        $q_batch = $mysqli->query($sql_batch);
                                                                                                        $r_batch = $q_batch->fetch_assoc();
                                                                                                        echo $r_batch['batch_name'] ?></p>
                                                    <a href="javascript:;">
                                                        <h5>
                                                            <a href="instructor-course-detail.php?content_id=<?php echo $result_class['content_id'] ?>">
                                                                <?php echo $result_class['content_name'] ?>
                                                            </a>
                                                        </h5>
                                                    </a>
                                                    <p class="mb-4 text-sm">
                                                        <?php echo $result_class['content_detail'] ?>
                                                    </p>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <a href="instructor-course-detail.php?content_id=<?php echo $result_class['content_id'] ?>" class="btn btn-outline-primary btn-sm mb-0">View </a>
                                                        <!-- <div class="avatar-group mt-2">
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                                                                <img alt="Image placeholder" src="cms/assets/img/team-1.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                                                                <img alt="Image placeholder" src="cms/assets/img/team-2.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                                                                <img alt="Image placeholder" src="cms/assets/img/team-3.jpg">
                                                            </a>
                                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                                                                <img alt="Image placeholder" src="cms/assets/img/team-4.jpg">
                                                            </a>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
    </main>

    <?php include 'footer.php'; ?>