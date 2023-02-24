<?php include 'header.php' ?>

<body class="g-sidenav-show  bg-gray-100">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <!-- <h1>Course Detail</h1> -->
            <!-- content here!! -->
            <?php
            $tbl_name = $FTblName . "_course";
            $PK_field = "content_id";
            $PK_status = "content_status";
            // $s = "SELECT * FROM `" . $tbl_name . "` where $PK_field = '" . $_GET['cid'] . "' order by $PK_field asc ";
            $s = "SELECT * FROM `" . $tbl_name . "` RIGHT JOIN `mbgt_instructor` ON " . $tbl_name . ".course_instructor = mbgt_instructor.instructor_id WHERE $PK_field = '" . $_GET['cid'] . "'";
            //echo $s;
            $q = $mysqli->query($s);
            while ($r = $q->fetch_assoc()) {
            ?>
                <!-- <img src="<?php echo $r['content_picture']; ?>" width="100%">
                <div class="row mb-4">
                    <h4 class="mt-2">Course Name : </h4><?php echo $r['content_name']; ?>
                </div> -->
                <?php //print_r($r)
                ?>
                <h1 class="text-center"><?php echo $r['content_name']; ?></h1>
                <div class="col-12 col-xl-8 mx-auto text-center mt-4">
                    <img src="<?php echo $r['content_picture']; ?>" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                </div>

                <div class="clearfix mt-2 mb-3"></div>

                <div class="card">
                    <div class="card-body p-3 mt-2">
                        <!-- <h4 class="text-info text-center"> Course Details</h4> -->
                        <div class="row">
                            <div class="d-flex justify-content-between ">
                                <h4 class="text-info text-center"> Course Details</h4>
                                <?php
                                $ss = "SELECT * FROM `" . $FTblName . "_enroll`  where course_id = '" . $_GET['cid'] . "' and userid = '" . $_GET['userid'] . "' ";


                                $qq = $mysqli->query($ss);
                                $result_enroll = $qq->fetch_assoc();
                                $rr = $qq->fetch_row();
                                if (!$result_enroll['content_id']) {
                                ?>
                                    <div class="text-end">
                                        <button class="btn btn-success enroll" onclick="javascript:on_enroll('<?php echo $_GET['cid']; ?>', '<?php echo $_GET['userid']; ?>');">Enroll</button><br>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <h6 class="fw-bold">Coach Name</h6>
                            <p class="text-start px-4"><?= $r['instructor_name'] == '' ? $r['content_coach'] : $r['instructor_name'] ?></p>
                        </div>
                        <div class="row">
                            <h6 class="fw-bold">Start</h6>
                            <p class="text-start px-4"><?= date_format(date_create($r['course_start_date']), "d F Y H:i") ?> to <?= date_format(date_create($r['course_end_date']), "d F Y H:i") ?></p>
                        </div>

                        <div class="row">
                            <h6 class="fw-bold">Course Detail</h6>
                            <p class="text-start px-4"><?= $r['content_detail']; ?></p>
                        </div>

                        <div class="row" style="<?= $r['course_material'] == '' ? 'display:none' : '' ?>">
                            <h6>Class materials:</h6>
                            <ul class=" list-group list-group-flush px-3 ">

                                <?php
                                if ($r['course_material'] != null) {
                                    foreach (json_decode($r['course_material']) as $key => $item) {
                                ?>
                                        <li class="list-group-item justify-content-between d-flex"><a href="<?php echo $item ?>" download> <span class="text-info">Download here</span></a></li>
                                <?php  }
                                } ?>

                            </ul>
                        </div>


                        <div class="row">
                            <h6 class="fw-bold">Course Location</h6>
                            <p class="text-start px-4 ">
                                <?= $r['course_type'] == 'online' ? '<a href="' . $r['course_join_link'] . '" target="_blank" class="text-info" rel="noopener noreferrer"> Click link here.</a>' : $r['course_location']; ?>
                            </p>

                        </div>
                        <?php if ($result_enroll['pass_status'] == '1') {
                            $s_member = "SELECT * FROM `" . $FTblName . "_member` where userid = '" . $_GET['userid']  . "'";

                            $q_member = $mysqli->query($s_member);
                            $r_member  = $q_member->fetch_assoc();

                            $s_attend = "SELECT * FROM `" . $FTblName . "_attend` where member_id = '" . $r_member['member_id'] . "'";
                            $q_attend = $mysqli->query($s_attend);
                            $result_attend = $q_attend->fetch_assoc();
                            $generate_certificate_url = 'generate-certificate.php?member_id=' . $r_member['member_id'] . '&course_id=' .  $_GET['cid'];
                        ?>
                            <div class="row mt-4">
                                <h4 class="text-info text-center">Sugguest and recommendation:</h4>
                                <p class="text-indent"><?php echo $result_attend['suggestion'] ?></p>
                            </div>

                            <div class="text-center">
                                <button class="btn bg-gradient-success" onclick="javascript:window.location.href='<?php echo $generate_certificate_url; ?>';">View certificate</button>

                                <p class="text-secondary" style="font-size: 0.6rem !important;">** if cannot to view certificate please click here to gencerate</p>
                            </div>

                    <?php }
                    } ?>

                    <div class="text-center mt-5 pt-5">
                        <button class="btn btn-outline-secondary" onclick="javascript:window.location.href='course.php';">Back to course</button>
                    </div>

                    </div>
                </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script>
        function runApp() {
            liff.getProfile().then(profile => {
                user_id = profile.userId;
                user_displayName = profile.displayName;
                user_pictureUrl = profile.pictureUrl;
                user_statusMessage = profile.statusMessage;
                userinfo();
            }).catch(err => console.error(err));
        }

        liff.init({
            liffId: "1657161724-DX5jNlZa"
        }, () => {
            if (liff.isLoggedIn()) {
                runApp()
            } else {
                liff.login();
            }
        }, err => console.error(err.code, error.message));

        function userinfo() {
            return user_id;
        }

        function on_enroll(id) {
            var userID = userinfo();

            window.location.href = 'course-enroll.php?userid=' + userID + '&cid=<?php echo $_GET['cid']; ?>';
        }
    </script>