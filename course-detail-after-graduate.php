<?php include 'header.php' 
// $_GET['cid'] = 2;
?>

<body class="g-sidenav-show  bg-gray-100">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <!-- <h1>Course Detail</h1> -->
            <!-- content here!! -->
            <?php
            $tbl_name = $FTblName . "_course";
            $PK_field = "content_id";
            $PK_status = "content_status";
            $s = "SELECT * FROM `" . $tbl_name . "` where $PK_field = '" . $_GET['cid'] . "' order by $PK_field asc ";
            #echo $s;
            $q = $mysqli->query($s);
            while ($r = $q->fetch_assoc()) { ?>
            <h1 class="text-center"><?php echo $r['content_name']; ?></h1>

                <div class="col-12 col-xl-8 mx-auto mt-4">
                    <img src="<?php echo $r['content_picture']; ?>" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                </div>

            <div class="clearfix mt-2 mb-3"></div>

            <div class="card">
                <div class="card-body p-3 mt-2">
                    <h4 class="text-info text-center"> Course Details</h4>
                    <div class="row">
                        <h6 class="fw-bold col-5">Coach Name : </h6>
                        <p class="col-7"><?php echo $r['content_coach']; ?></p>
                    </div>
                    <div class="row">
                        <h6 class="fw-bold col-5">Course Detail : </h6>
                        <p class="col-7"><?php echo $r['content_detail']; ?></p>
                    </div>
                    <?php } ?>
                    <?php
                    $ss = "SELECT * FROM `" . $FTblName . "_enroll` where course_id = '" . $_GET['cid'] . "' and userid = '" . $_GET['userid'] . "' ";
                    $qq = $mysqli->query($ss);
                    $rr = $qq->fetch_row();
                    if ($rr == 0) {
                    ?>
                    <div class="text-end">
                        <button class="btn btn-success enroll" onclick="javascript:on_enroll('<?php echo $_GET['cid']; ?>', '<?php echo $_GET['userid']; ?>');">Enroll</button><br>
                    </div>
                    <?php } ?>
            
                    <div class="row">
                        <h6>Class materials:</h6>
                        <ul class=" list-group list-group-flush px-3 ">
                            <li class="list-group-item justify-content-between d-flex">
                                <a href="#"> <span>Lesson 1</span></a>
                                <a href="#"> <i class="fas fa-file-download"></i></a>
                            </li>
                            <li class="list-group-item justify-content-between d-flex">
                                <a href="#"> <span>Lesson 2</span></a>
                                <a href="#"> <i class="fas fa-file-download"></i></a>
                            </li>
                            <li class="list-group-item justify-content-between d-flex">
                                <a href="#"> <span>Lesson 3</span></a>
                                <a href="#"> <i class="fas fa-file-download"></i></a>
                            </li>
                        </ul>
                    </div>

            
                    <div class="row mt-4">
                        <h4 class="text-info text-center">Sugguest and recommendation:</h4>
                        <p class="text-indent">Sed dicta dolor ab autem rerum est culpa consequatur. Est impedit soluta ea accusantium recusandae in odit sint.
                            Ut autem deleniti id labore perspiciatis sit consequatur atque vel architecto error qui aliquid placeat. 
                            Et nemo voluptatem ut nisi deserunt aut unde dolorum aut aliquam voluptas.</p>
                    </div>

                    <div class="text-center">
                        <button class="btn bg-gradient-success" onclick="javascript:window.location.href='certificate/Ceritificate_Hr_example.pdf';">View certificate</button>
                        <p class="text-secondary" style="font-size: 0.6rem !important;">** if cannot to view certificate please click here to gencerate</p>
                        
                    </div>


                    <!-- <div class="text-center mt-5 pt-5">
                        <button class="btn btn-outline-secondary" onclick="javascript:window.location.href='course.php';">Back to course</button>
                    </div> -->
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

        // liff.init({
        //     liffId: "1657161724-DX5jNlZa"
        // }, () => {
        //     if (liff.isLoggedIn()) {
        //         runApp()
        //     } else {
        //         liff.login();
        //     }
        // }, err => console.error(err.code, error.message));

        function userinfo() {
            return user_id;
        }

        function on_enroll(id) {
            var userID = userinfo();

            window.location.href = 'course-enroll.php?userid=' + userID + '&cid=<?php echo $_GET['cid']; ?>';
        }
    </script>