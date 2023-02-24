<?php include 'header.php' ?>

<body class="g-sidenav-show  bg-gray-100">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4 ">

            <div class="row">
                <div class="mx-auto">
                    <?php
                    $sql_batch = "SELECT * FROM mbgt_batch WHERE batch_status = 1 ORDER BY batch_id DESC LIMIT 1";
                    $q_batch = $mysqli->query($sql_batch);
                    // print_r($sql_batch);
                    while ($r_batch = $q_batch->fetch_assoc()) {
                        $last_batch_id = $r_batch['batch_id'];
                    ?>

                        <h1 class="text-center"><?= $r_batch['batch_name'] ?></h1>
                    <?php  } ?>
                    <p class="text-center text-xs">All course</p>
                </div>
                <!-- <div class="col align-self-end mb-4">
                    <select name="" id="" class="form-select col-5">
                        <option value="All courses" selected>All courses</option>
                        <option value="My courses">My courses</option>
                        <option value="Not enroll">Not enroll</option>
                    </select>
                </div> -->
            </div>
            <!-- content here!! -->
            <div class="card-group">



                <?php
                $tbl_name = $FTblName . "_course";
                $PK_field = "content_id";
                $PK_status = "content_status";

                $s = "SELECT * FROM `" . $tbl_name . "` where $PK_status = '1' && course_batch = $last_batch_id order by course_start_date asc ";
                // echo $s;
                $q = $mysqli->query($s);
                while ($r = $q->fetch_assoc())
                // print_r($r);
                {
                ?>
                    <!-- <div class="text-center col-12 pl-2 pr-2">
                <a href="javascript:on_course('<?php echo $r['content_id']; ?>');">
                    <img src="<?php echo $r['content_picture']; ?>"  width="100%" class="shadow border-radius-xl"><br>
                    <p class="btn btn-outline-primary mt-4"><?php echo $r['content_name']; ?></p>
                </a>                          
                </div> -->




                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                        <div class="card ">
                            <div class="position-relative">
                                <a href="javascript:on_course('<?php echo $r['content_id']; ?>');" class="d-block ">
                                    <img src="<?php echo $r['content_picture']; ?>" alt="<?php echo $r['content_name'] ?>" width="100%" class="">
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="javascript:on_course('<?php echo $r['content_id']; ?>');">
                                    <h5><?php echo $r['content_name'] ?></h5>
                                </a>
                                <div class="">
                                    <p class="text-sm"><?php echo $r['content_detail'] ?></p>
                                    <p class="text-xs"><?php echo $r['course_end_date'] == '0000-00-00 00:00:00' ? '' : $r['course_start_date'] ?></p>
                                </div>
                                <div class="text-end">
                                    <a href="javascript:on_course('<?php echo $r['content_id']; ?>');" class="text-primary icon-move-right">Read More
                                        <i class="fas fa-arrow-right text-sm" aria-hidden="true"></i>
                                    </a>
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
        function runApp() {
            liff.getProfile().then(profile => {
                user_id = profile.userId;
                user_displayName = profile.displayName;
                user_pictureUrl = profile.pictureUrl;
                user_statusMessage = profile.statusMessage;
                save_member();
                getData(user_id);
            }).catch(err => console.error(err));
        }

        function on_course(id) {
            window.location.href = 'course-detail.php?userid=' + user_id + '&cid=' + id;
        }

        function getData(userid) {
            console.log('Start ');
            $.ajax({
                type: 'POST',
                url: 'get-member.php',
                dataType: "json",
                data: {
                    userid: userid
                },
                success: function(data) {
                    console.log(data);
                    if (data.status == 'ok') {

                    } else {
                        window.location.href = 'register.php';
                    }
                }
            });
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

        liff.init({
            liffId: "1657161724-G4bqr3ol"
        }, () => {
            if (liff.isLoggedIn()) {
                runApp();
            } else {
                liff.login();
            }
        }, err => console.error(err.code, error.message));
    </script>