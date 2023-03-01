<?php include 'header.php' ?>

<body class="g-sidenav-show  bg-gray-100">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <!-- <h2 class="text-center">Profile</h2> -->

            <div class="card">
                <div class="card-body p-3 mt-2">
                    <div class="col-5 col-xl-4 mx-auto ">
                        <img src="cms/assets/img/team-1.jpg" id="emp_img" alt="img-blur-shadow" class="img-fluid shadow rounded-circle">
                    </div>
                    <?php
                    $s_my_point = "SELECT mbgt_member.member_id,emp_name, emp_surname, member_position,brand_agency, SUM(pre_test + after_test + cooperate_in_class + extra_point) AS total_points,
                                FIND_IN_SET(SUM(pre_test + after_test + cooperate_in_class + extra_point),
                                            (SELECT GROUP_CONCAT(total_points ORDER BY total_points DESC)
                                             FROM (SELECT member_id, SUM(pre_test + after_test + cooperate_in_class + extra_point) AS total_points
                                                   FROM mbgt_attend
                                                   GROUP BY member_id) AS total_points_table)) AS rank
                         FROM mbgt_attend, mbgt_member where mbgt_attend.member_id = mbgt_member.member_id and mbgt_attend.member_id = '" . $_COOKIE['member_id'] . "'
                         GROUP BY member_id
                         ORDER BY total_points DESC";

                    $q_my_point = $mysqli->query($s_my_point);
                    $result_my_point = $q_my_point->fetch_assoc()
                    ?>
                    <div class="text-center mb-4 mt-4">
                        <h4 class="text-dark" id="emp_displayname" name="emp_displayname"></h4>
                        <p class="text-sm mb-0 mt-2">My ranking is : <span class="text-info fw-bolder"><?php echo $result_my_point['rank'] ?></span></p>
                        <p class="text-sm">My point is : <strong><?php echo $result_my_point['total_points'] ?></strong> points</p>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
                                <span class="text-sm">Information</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ranking-tab" data-bs-toggle="tab" data-bs-target="#ranking-content" type="button" role="tab" aria-controls="ranking-content" aria-selected="false">
                                <span class="text-sm">Ranking</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="points-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">
                                <span class="text-sm">My points</span>
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active mt-4" id="info" role="tabpanel" aria-labelledby="info-tab">
                            <div class="">
                                <!-- <div class="col-5 col-xl-4 mx-auto mb-3">
                                        <img src="cms/assets/img/team-1.jpg" alt="img-blur-shadow" class="img-fluid shadow rounded-circle">
                                    </div> -->
                                <!-- <div class="row">
                                    <div class="col-5 text-end">
                                        <small class="fw-bold" for="emp_code">Employee ID: </small>
                                    </div>
                                    <div class="col-7">
                                        <small id="emp_code" name="emp_code"></small>
                                    </div>
                                </div> -->
                                <!-- <div class="row">
                                        <div class="col-5 text-end">
                                            <small class="fw-bold" for="emp_displayname">Display Name: </small>
                                        </div>
                                        <div class="col-7">
                                            <small id="emp_displayname" name="emp_displayname"></small>
                                        </div>
                                    </div> -->
                                <div class="row">
                                    <div class="col-5 text-end">
                                        <small class="fw-bold" for="emp_name">Name: </small>
                                    </div>
                                    <div class="col-7">
                                        <small id="emp_name" name="emp_name"></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5 text-end">
                                        <small class="fw-bold" for="emp_surname">Surname: </small>
                                    </div>
                                    <div class="col-7">
                                        <small id="emp_surname" name="emp_surname"></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5 text-end">
                                        <small class="fw-bold" for="emp_nickname">Nick name: </small>
                                    </div>
                                    <div class="col-7">
                                        <small id="emp_nickname" name="emp_nickname"></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5 text-end">
                                        <small class="fw-bold" for="emp_agency">Brand agency: </small>
                                    </div>
                                    <div class="col-7">
                                        <small id="emp_agency" name="emp_agency"></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5 text-end">
                                        <small class="fw-bold" for="emp_email">Email: </small>
                                    </div>
                                    <div class="col-7">
                                        <small id="emp_email" name="emp_email"></small>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade show mt-4" id="ranking-content" role="tabpanel" aria-labelledby="ranking-tab">
                            <?php
                            $tbl_name = $FTblName . "_attend";
                            $s_attend_all = "SELECT mbgt_member.member_id,emp_name, emp_surname, member_position,brand_agency, SUM(pre_test + after_test + cooperate_in_class + extra_point) AS total_points,
                            FIND_IN_SET(SUM(pre_test + after_test + cooperate_in_class + extra_point),
                                        (SELECT GROUP_CONCAT(total_points ORDER BY total_points DESC)
                                         FROM (SELECT member_id, SUM(pre_test + after_test + cooperate_in_class + extra_point) AS total_points
                                               FROM mbgt_attend
                                               GROUP BY member_id) AS total_points_table)) AS rank
                     FROM mbgt_attend, mbgt_member where mbgt_attend.member_id = mbgt_member.member_id
                     GROUP BY member_id
                     ORDER BY total_points DESC";

                            $q_attend_all = $mysqli->query($s_attend_all);
                            while ($result_attend_all = $q_attend_all->fetch_assoc()) {
                            ?>
                                <div class="card container mb-3 pt-2 pb-2 border 
                                <?php
                                if ($result_attend_all['rank'] == 1) {
                                    echo 'border-warning';
                                } elseif ($result_attend_all['rank'] == 2) {
                                    echo 'border-info';
                                } elseif ($result_attend_all['rank'] == 3) {
                                    echo 'border-success';
                                }
                                ?>">
                                    <div class="row">
                                        <div class="col-3 ">
                                            <img src="cms/assets/img/bruce-mars.jpg" class="img-fluid rounded mx-auto d-block " alt="..." style="max-height: 200px;">
                                            <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle 
                                            <?php
                                            if ($result_attend_all['rank'] == 1) {
                                                echo 'bg-danger';
                                            } elseif ($result_attend_all['rank'] == 2) {
                                                echo 'bg-info';
                                            } elseif ($result_attend_all['rank'] == 3) {
                                                echo 'bg-success';
                                            }
                                            ?> p-2">
                                                <span class="visually-hidden"></span><?php echo $result_attend_all['rank'] ?></span>
                                        </div>
                                        <div class="col-6 ">
                                            <h6 class=""><?php echo $result_attend_all['emp_name'] . ' ' . $result_attend_all['emp_surname'] ?></h6>
                                            <p style="font-size: 0.725rem;line-height: 0.625;"><?php echo $result_attend_all['brand_agency'] ?></p>
                                        </div>
                                        <div class="col-3">
                                            <h3 class="text-info"><?php echo $result_attend_all['total_points'] ?></h3>
                                            <p style="font-size: 0.725rem;line-height: 0.625;">points</p>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                            <!-- <div class="card container mb-3 pt-2 pb-2 border border-info">
                                <div class="row">
                                    <div class="col-3 ">
                                        <img src="cms/assets/img/team-1.jpg" class="img-fluid rounded mx-auto d-block " alt="..." style="max-height: 200px;">
                                        <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-info p-2">
                                            <span class="visually-hidden"></span>2</span>
                                    </div>
                                    <div class="col-6 ">
                                        <h6 class="">Joshua Jackson</h6>
                                        <p style="font-size: 0.725rem;line-height: 0.625;">MBCS</p>
                                    </div>
                                    <div class="col-3">
                                        <h3 class="text-info">280</h3>
                                        <p style="font-size: 0.725rem;line-height: 0.625;">points</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card container mb-3 pt-2 pb-2 border border-success">
                                <div class="row">
                                    <div class="col-3 ">
                                        <img src="cms/assets/img/team-2.jpg" class="img-fluid rounded mx-auto d-block " alt="..." style="max-height: 200px;">
                                        <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-success p-2">
                                            <span class="visually-hidden"></span>3</span>
                                    </div>
                                    <div class="col-6 ">
                                        <h6 class="">Joshua Jackson</h6>
                                        <p style="font-size: 0.725rem;line-height: 0.625;">MBCS</p>
                                    </div>
                                    <div class="col-3">
                                        <h3 class="text-info">260</h3>
                                        <p style="font-size: 0.725rem;line-height: 0.625;">points</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card container mb-3 pt-2 pb-2">
                                <div class="row">
                                    <div class="col-3 px-0">
                                        <img src="cms/assets/img/team-3.jpg" class="img-fluid rounded mx-auto d-block " alt="..." style="max-height: 200px;">
                                    </div>
                                    <div class="col-6 ">
                                        <h6 class="">Joshua Jackson</h6>
                                        <p style="font-size: 0.725rem;line-height: 0.625;">MBCS</p>
                                    </div>
                                    <div class="col-3">
                                        <h4 class="text-info">100</h4>
                                        <p style="font-size: 0.725rem;line-height: 0.625;">points</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card container mb-3 pt-2 pb-2">
                                <div class="row">
                                    <div class="col-3 ">
                                        <img src="cms/assets/img/team-4.jpg" class="img-fluid rounded mx-auto d-block " alt="..." style="max-height: 200px;">
                                    </div>
                                    <div class="col-6 ">
                                        <h6 class="">Joshua Jackson</h6>
                                        <p style="font-size: 0.725rem;line-height: 0.625;">MBCS</p>
                                    </div>
                                    <div class="col-3">
                                        <h4 class="text-info">99</h4>
                                        <p style="font-size: 0.725rem;line-height: 0.625;">points</p>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                        <div class="tab-pane fade mt-4" id="details" role="tabpanel" aria-labelledby="points-tab">
                            <div class="row">
                                <h4>My point</h4>
                            </div>

                            <div class="row">
                                <!-- <h4>What did you learn in this course?</h4> -->

                                <div class="card container mb-3 pt-2 pb-2">
                                    <div class="row">
                                        <div class="col-3 ">
                                            <img src="cms/assets/img/team-4.jpg" class="img-fluid rounded mx-auto d-block " alt="..." style="max-height: 200px;">
                                        </div>
                                        <div class="col-6 ">
                                            <b class=""><?php echo $result_my_point['emp_name'] . ' ' .  $result_my_point['emp_surname'] ?></b>
                                            <p>
                                                <small>Your ranking is <strong class="text-primary"><?php echo $result_my_point['rank'] ?></strong></small>
                                        </div>
                                        <div class="col-3">
                                            <h3 class="text-info"><?php echo $result_my_point['total_points'] ?></h3>
                                            <small>points</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mx-2" style="font-size: 0.6rem">
                                <p>Remark:</p>
                                <ol>
                                    <li>Lorem ipsum is placeholder text commonly used in the graphic</li>
                                    <li>Ea nesciunt molestias est sunt maiores 33 laudantium iste.</li>
                                    <li>Non earum ipsum rem cupiditate dicta est amet neque et dolorem magnam?</li>
                                    <li>Non quisquam exercitationem in dolores cupiditate eos neque necessitatibus.</li>
                                </ol>

                            </div>


                        </div>
                    </div>


                </div>
            </div>

            <!-- <div class="clearfix mt-2 mb-3"></div> -->

            <section>
                <h4 class="text-center mt-5">My Learning</h4>
                <div class="card">
                    <div class="card-body p-3 mt-2">
                        <p class="fw-bolder">Must attend to learn</p>
                        <?php
                        $tbl_name = $FTblName . "_member";
                        $PK_field = "member_id";
                        $s = "SELECT * FROM `" . $FTblName . "_enroll` a inner join " . $FTblName . "_course b on a.course_id = b.content_id inner join " . $FTblName . "_member c on a.userid = c.userid where c.member_id = '" . $_COOKIE['member_id'] . "' and a.pass_status='0' and course_start_date >= Now() order by course_start_date asc ";

                        $q = $mysqli->query($s);
                        ?>
                        <!-- <label class="text-primary">Must attend to learn</label> -->
                        <ul class="list-group">
                            <?php while ($r = $q->fetch_assoc()) { ?>
                                <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                                    <div class="d-flex justify-content-between ">
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:on_course('<?php echo $r['content_id'] ?>');">
                                                <img src="<?php echo $r['content_picture'] ?>" class="avatar avatar-sm me-3 ">
                                            </a>
                                            <div class="d-flex flex-column">
                                                <a href="javascript:on_course('<?php echo $r['content_id'] ?>');">
                                                    <h6 class="mb-1 text-dark text-sm"><?php echo $r['content_name'] ?></h6>
                                                    <span class="text-xs"><?php echo date_format(date_create($r['course_start_date']), "d F Y H:i") ?></span>
                                                </a>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-link bg-gradient-primary" onclick="javascript:on_course('<?php echo $r['content_id'] ?>');">Go..</button>
                                    </div>
                                    <hr class="horizontal dark mt-3 mb-2">
                                </li>
                            <?php } ?>

                        </ul>

                        <!-- <hr class="horizontal dark mt-5 mb-5"> -->
                        <hr class="mt-5 mb-5" style="color:red">

                        <div class="d-flex justify-content-between mb-2">
                            <p class="fw-bolder">Completed class</p>
                            <!-- <div class="col-4">
                                <select class="form-select form-select-sm" name="course_batch" id="course_batch">
                                    <option value="0" disabled> Choose Batch</option>
                                    <?php

                                    $sql_batch = "select * from mbgt_batch where batch_status = 1 order by batch_id DESC";
                                    $q_batch = $mysqli->query($sql_batch);
                                    while ($r_batch = $q_batch->fetch_assoc()) {
                                        echo '<option value="' . $r_batch['batch_id'] . '">' . $r_batch['batch_name'] . '</option>';
                                    }

                                    ?>
                                </select>
                            </div> -->

                        </div>
                        <ul class="list-group">
                            <?php
                            $s_complete = "SELECT * FROM `" . $FTblName . "_enroll` a inner join " . $FTblName . "_course b on a.course_id = b.content_id inner join " . $FTblName . "_member c on a.userid = c.userid where c.member_id = '" . $_COOKIE['member_id'] . "' and a.pass_status='1' order by course_start_date asc";
                            $q_complete = $mysqli->query($s_complete);

                            $s_member = "SELECT * FROM `" . $FTblName . "_member` where member_id = '" . $_COOKIE['member_id'] . "'";
                            $q_member = $mysqli->query($s_member);
                            $r_member  = $q_member->fetch_assoc();
                            while ($r_complete = $q_complete->fetch_assoc()) {

                            ?>
                                <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                                    <div class="d-flex justify-content-between ">
                                        <div class="d-flex align-items-center">
                                            <a href="course-detail-after-graduate.php?cid=1">
                                                <img src="<?php echo $r_complete['content_picture'] ?>" class="avatar avatar-sm me-3 ">
                                            </a>
                                            <div class="d-flex flex-column">
                                                <a href="course-detail.php?cid=<?php echo  $r_complete['content_id'] ?>&userid=<?php echo  $r_member['userid'] ?>">
                                                    <h6 class="mb-1 text-dark text-sm"><?php echo $r_complete['content_name'] ?></h6>
                                                    <span class="text-xs"><?php echo date_format(date_create($r_complete['course_start_date']), "d F Y H:i"); ?></span>
                                                </a>
                                            </div>
                                        </div>
                                        <?php if ($r_complete['certification_path']) { ?>
                                            <a href="<?php echo $r_complete['certification_path'] ?>" target="_blank" class="fs-6 text-success ">
                                                <span class="badge bg-gradient-success">
                                                    <i class="fas fa-file-download"></i> Certificate
                                                </span>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <hr class="horizontal dark mt-3 mb-2">
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

            </section>


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
                save_member();
                getData(user_id);
                $('.btn').show();
            }).catch(err => console.error(err));
        }

        function go_course() {
            window.location.href = 'my-course.php?userid=' + user_id;
        }

        function getData(userid) {
            $.ajax({
                type: 'POST',
                url: 'get-member.php',
                dataType: "json",
                data: {
                    userid: userid
                },
                success: function(data) {
                    if (data.status == 'ok') {
                        $('#emp_displayname').html(data.result.displayname);
                        $('#emp_name').html(data.result.emp_name);
                        $('#emp_surname').html(data.result.emp_surname);
                        $('#emp_nickname').html(data.result.emp_nickname);
                        $('#emp_email').html(data.result.member_email);
                        $('#emp_position').html(data.result.member_position);
                        $('#emp_agency').html(data.result.brand_agency);
                        $('#member_id').html(data.result.member_id);
                        $('#emp_img').attr("src", data.result.pictureurl);
                        document.cookie = "member_id = " + data.result.member_id;
                        console.log(document.cookie);
                    } else {
                        window.location.href = 'https://liff.line.me/1657161724-ML9kmL7r';
                    }
                }
            });
        }

        function on_course(id) {
            window.location.href = 'course-detail.php?userid=' + user_id + '&cid=' + id;
        }

        function submitform() {
            if ($('#emp_name').val() != '' && $('#emp_code').val() != '') {
                //$('#loading').show();
                $.post("save-member.php", {
                        userid: user_id,
                        emp_code: $('#emp_code').val(),
                        emp_name: $('#emp_name').val()
                    })
                    .done(function(data) {
                        console.log('Update ', data);
                    });
            } else {
                alert('กรุณาใส่ให้ครบ');
            }
        }

        function save_member() {
            $.post("mem-register.php", {
                    user_id: user_id,
                    displayName: user_displayName,
                    pictureUrl: user_pictureUrl,
                    statusMessage: user_statusMessage
                })
                .done(function(data) {
                    console.log('Member', data);
                });
        }

        function closeliff() {
            liff.closeWindow();
        }

        liff.init({
            liffId: "1657161724-3XJevBEP"
        }, () => {
            if (liff.isLoggedIn()) {
                runApp();
            } else {
                liff.login();
            }
        }, err => console.error(err.code, error.message));
    </script>