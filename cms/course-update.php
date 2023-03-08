<?php include 'header.php' ?>
<?php
$menu_title = "Course";
$page = "course";
$PK_field = "content_id";
$PK_status = "content_status";
$tbl_name = $FTblName . "_course";
$fieldlist = array('content_name', 'content_coach', 'course_instructor', 'content_detail', 'content_code', 'content_status', 'assign_member', 'course_batch', 'course_type', 'course_location', 'course_join_link', 'course_video_link', 'course_quiz_form', 'course_start_date', 'course_end_date');
$pagesize = 25;
if (isset($_POST['mode'])) {

    if ($_POST['mode'] == "add") {
        include "../include/m_add.php";
    }
    if ($_POST['mode'] == "update") {

        if ($_POST['assign_member']) {
            $d = "select * from `" . $FTblName . "_course` where content_id = '" . trim($_POST[$PK_field]) . "' ";

            $result = $mysqli->query($d);
            $rec = $result->fetch_assoc();
            echo '<pre>';
            print_r($_POST['assign_member']);
            print_r(json_decode($rec['assign_member']));
            $dif = array_diff($_POST['assign_member'], json_decode($rec['assign_member']));
            $dif1 = array_diff(json_decode($rec['assign_member']), $_POST['assign_member']);
            echo '<pre>';
            echo 'dif--------';
            print_r($dif); // if have dif >> insert
            echo 'dif1--------';
            print_r($dif1); // if have dif1 >> delete
            $diff_member = [];

            if ($dif) {

                foreach ($dif as $value) {
                    array_push($diff_member, $value);
                }

                $imploded_arr = implode(',', $diff_member);
                //get user id 
                $user_query = "select * from " . $FTblName . "_member where member_id in ( " . $imploded_arr . " )";
                echo 'dif: sql : ' . $user_query;

                $result_user = $mysqli->query($user_query);
                $userID = [];
                while ($rec_user = $result_user->fetch_assoc()) {
                    array_push($userID, $rec_user['userid']);
                    $s = "insert into `" . $FTblName . "_enroll` (userid,course_id,enroll_date) values ('" . $rec_user['userid'] . "','" . $rec['content_id'] . "',NOW()) ";
                    $mysqli->query($s);
                }
            }
            if ($dif1) {

                foreach ($dif1 as $value) {
                    array_push($diff_member, $value);
                }

                $imploded_arr = implode(',', $diff_member);
                //get user id 
                $user_query = "select * from " . $FTblName . "_member where member_id in ( " . $imploded_arr . " )";
                echo 'dif1: sql : ' . $user_query;

                $result_user = $mysqli->query($user_query);
                $userID = [];
                while ($rec_user = $result_user->fetch_assoc()) {
                    array_push($userID, $rec_user['userid']);
                    $s = "DELETE FROM `" . $FTblName . "_enroll` WHERE userid = '" . $rec_user['userid'] . "' and course_id = '" . $rec['content_id'] . "' ";
                    $mysqli->query($s);
                }
            }
        } else {
            $s = "DELETE FROM `" . $FTblName . "_enroll` WHERE course_id = '" . $_POST[$PK_field] . "' ";

            $mysqli->query($s);
        }

        $_POST['assign_member'] = json_encode($_POST['assign_member']);
        $_POST['course_instructor'] = json_encode($_POST['course_instructor']);


        $sql = "select * from $tbl_name where $PK_field = '" . trim($_POST[$PK_field]) . "'";
        $q = $mysqli->query($sql);

        while ($rec = $q->fetch_assoc()) {
            $$PK_field = $rec[$PK_field];
            foreach ($fieldlist as $key => $value) {
                $$value = $rec[$value];
            }
            $content_picture = $rec['content_picture'];
            $course_material = $rec['course_material'];
        }

        if ($_POST['assign_member'] != 'null') {
            include("enroll-boardcast.php");
        } else {
            $_POST['assign_member'] = '[]';
        }

        $_POST['course_start_date'] = explode('T', $_POST['course_start_date'])['0'] . ' ' . explode('T', $_POST['course_start_date'])['1'] . ':00';
        $_POST['course_end_date'] = explode('T', $_POST['course_end_date'])['0'] . ' ' . explode('T', $_POST['course_end_date'])['1'] . ':00';

        include("../include/m_update.php");
    }
    #echo $sql; 
    if ($_FILES['content_picture']['name'] != '') {
        $path = $_FILES['content_picture']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $pic_name = $_POST['content_code'] . "." . $ext;
        $pic_path = "/course/";
        $path_picture = $pic_path . $pic_name;
        if (move_uploaded_file($_FILES['content_picture']['tmp_name'], ".." . $path_picture)) {
            $mysqli->query("update " . $tbl_name . " set content_picture = '" . $url_true . $path_picture . "' where " . $PK_field . " = " . $id);
            // echo "update ".$tbl_name." set content_picture = '".$url_true.$path_picture."' where ".$PK_field." = ".$id;
        }
    }
    $path_material = [];

    if ($_FILES['course_material']['name'][0] !== '') {
        $all_files = count($_FILES['course_material']['tmp_name']);

        for ($i = 0; $i < $all_files; $i++) {

            $file_name = $_FILES['course_material']['name'][$i];
            $file_tmp = $_FILES['course_material']['tmp_name'][$i];
            $file_type = $_FILES['course_material']['type'][$i];
            $file_size = $_FILES['course_material']['size'][$i];
            $file_ext = strtolower(end(explode('.', $_FILES['course_material']['name'][$i])));
            $pic_path =  "/course-material/";

            move_uploaded_file($file_tmp, ".." . $pic_path . $file_name);
            array_push($path_material, $url_true . $pic_path . $file_name);
        }
        // echo '<pre>';
        // print_r($path_material);
        // echo "update " . $tbl_name . " set course_material = '" . json_encode($path_material) . "' where " . $PK_field . " = " . $id;

        $mysqli->query("update " . $tbl_name . " set course_material = '" . json_encode($path_material) . "' where " . $PK_field . " = " . $id);
    }


?>
    <script>
        window.location.href = '<?php echo $page . ".php"; ?>';
    </script>
    <?php
} else {
    if (isset($_GET['mode']) && $_GET['mode'] == "add") {

        //Check_Permission ($check_module,$_SESSION[login_id],"add");
    } else if (isset($_GET['mode']) && $_GET['mode'] == "update") {
        // Check_Permission ($check_module,$_SESSION[login_id],"update");

        $sql = "select * from $tbl_name where $PK_field = '" . trim($_GET[$PK_field]) . "'";

        $q = $mysqli->query($sql);
        while ($rec = $q->fetch_assoc()) {
            $$PK_field = $rec[$PK_field];
            foreach ($fieldlist as $key => $value) {
                $$value = $rec[$value];
            }
            $content_picture = $rec['content_picture'];
            $course_material = $rec['course_material'];
        }
    } else {
    ?>
        <script>
            window.location.href = '<?php echo $page . ".php"; ?>';
        </script>
<?php
    }
}
?>

<body class="g-sidenav-show  bg-gray-100">
    <?php include 'sidebar.php'; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php include 'navbar.php'; ?>
        <div class="container-fluid py-4">


            <!-- content here!! -->
            <div class="card">
                <div class="card-body p-3 mt-2">

                    <form role="form" action="<?php echo $page; ?>-update.php" method="post" enctype="multipart/form-data">
                        <?php if ($_GET['mode'] == "update") { ?>
                            <input name="<?php echo $PK_field; ?>" type="hidden" id="<?php echo $PK_field; ?>" value="<?php echo $$PK_field; ?>">
                        <?php } ?>
                        <input type="hidden" id="mode" name="mode" value="<?php echo $_GET['mode']; ?>">
                        <input type="hidden" id="instructor_course_id" name="instructor_course_id" value="<?php echo $instructor_course_id; ?>">

                        <div class="col-6 mb-3">
                            <label for="content_picture">Picture</label>
                            <?php if ($content_picture != '') { ?>
                                <br>
                                <input type="hidden" id="content_picture1" name="content_picture1" value="<?php echo $content_picture; ?>">
                                <img src="<?php echo $content_picture; ?>" width="200"><br>
                            <?php } ?>
                            <input type="file" class="form-control" id="content_picture" name="content_picture" value="<?php echo $content_picture; ?>">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="Name">Coach Name</label>
                            <input type="text" disabled class="form-control" placeholder="Coach Name" aria-label="Coach Name" aria-describedby="email-addon" id="content_coach" name="content_coach" value="<?php echo $content_coach; ?>">
                        </div>
                        <!-- <div class="col-6 mb-3">
                            <label for="course_instructor">Course Instructor</label>
                            <?php
                            //$sql_instructor = "select * from mbgt_instructor order by instructor_id desc";
                            //$q_instructor = $mysqli->query($sql_instructor);
                            ?>
                            <select name="course_instructor" id="course_instructor" class="form-control">
                                <option value="">Select Instructor For This Course </option>
                                <?php
                                //while ($rec_instructor = $q_instructor->fetch_assoc()) { 
                                ?>
                                    <option value="<?php //echo $rec_instructor['instructor_id'] 
                                                    ?>" <?php //if ($rec_instructor['instructor_id'] == $course_instructor) {
                                                        //echo 'selected';
                                                        //} 
                                                        ?>><?php //echo $rec_instructor['instructor_name'] 
                                                            ?></option>
                                <?php //} 
                                ?>
                            </select>
                        </div> -->
                        <div class="col-6">
                            <label for="course_instructor">Course Instructor</label>
                            <select id="choices-multiple-remove-button" name="course_instructor[]" id="course_instructor" placeholder="Select instructor name" multiple>
                                <?php
                                $sql_instructor = "select * from mbgt_instructor order by instructor_id desc";
                                $q_instructor = $mysqli->query($sql_instructor);
                                if (isset($_GET['mode']) && $_GET['mode'] !== "add") {
                                    $sql_course_instructor = "select course_instructor from mbgt_course where content_id = " . $_GET['content_id'];
                                    $q_course_instructor = $mysqli->query($sql_course_instructor);
                                    $rec_course_instructor = $q_course_instructor->fetch_assoc();
                                }
                                while ($rec_instructor = $q_instructor->fetch_assoc()) {
                                    if ($rec_course_instructor['course_instructor'] !== 'null') {
                                ?>

                                        <option value="<?php echo $rec_instructor['instructor_id'] ?>" <?php
                                                                                                        if (isset($_GET['mode']) && $_GET['mode'] !== "add") {
                                                                                                            if ($rec_course_instructor['course_instructor']) {
                                                                                                                if ($rec_instructor['instructor_id'] !== null && in_array($rec_instructor['instructor_id'], json_decode($rec_course_instructor['course_instructor']))) {
                                                                                                                    echo "selected";
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                        ?>><?php echo $rec_instructor['instructor_name'];
                                                                                                            ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo $rec_instructor['instructor_id'] ?>"><?php echo $rec_instructor['instructor_name'];
                                                                                                        ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="Name">Course Name</label>
                            <input type="text" class="form-control" placeholder="Course Name" aria-label="Course Name" aria-describedby="email-addon" id="content_name" name="content_name" value="<?php echo $content_name; ?>">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="Name">Course Code</label>
                            <input type="text" class="form-control" placeholder="Coach Code" aria-label="Coach Code" aria-describedby="email-addon" id="content_code" name="content_code" value="<?php echo $content_code; ?>">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="Name">Course Detail</label>
                            <textarea class="form-control" placeholder="Course Detail" aria-label="Course Detail" aria-describedby="email-addon" id="content_detail" name="content_detail" row="10"><?php echo $content_detail; ?></textarea>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="course_material">Course Material</label>
                            <?php
                            if ($course_material != null) {
                                foreach (json_decode($course_material) as $key => $item) {
                            ?>
                                    <input type="hidden" id="course_material1" name="course_material1" value="<?php echo $item; ?>">
                                    <div><a href="<?php echo $item ?>">[Download Course Material File # <?php echo $key + 1 ?>] </a></div>
                            <?php  }
                            } ?>
                            <input type="file" accept=".pdf, .ppt, .pptx, .xlxs, .xls, .jpg, .jpeg, .png" class="form-control" id="course_material" name="course_material[]" multiple placeholder="file type should be pdf, ppt" value="<?php echo $course_material; ?>">
                        </div>

                        <!-- <div class="mb-3 bg-info"> -->
                        <div class="row mb-2">
                            <div class="col-3">
                                <label for="course_material">Course Start Date</label>
                                <input type="datetime-local" class="form-control" id="course_start_date" name="course_start_date" value="<?php echo $course_start_date ?>" onchange="checkDate()">
                            </div>
                            <div class="col-3">
                                <label for="course_material">Course End Date</label>
                                <input type="datetime-local" class="form-control" id="course_end_date" name="course_end_date" value="<?php echo $course_end_date ?>" onchange="checkDate()">
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="course_quiz_form">Course Quiz Form</label>
                            <input type="text" class="form-control" placeholder="Course Quiz Form" aria-label="Course Quiz Form" aria-describedby="email-addon" id="course_quiz_form" name="course_quiz_form" value="<?php echo $course_quiz_form; ?>">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="course_quiz_form">Course Video Record Link</label>
                            <input type="text" class="form-control" placeholder="Course Video Record Link" aria-label="Course Video Record Link" aria-describedby="email-addon" id="course_video_link" name="course_video_link" value="<?php echo $course_video_link; ?>">
                        </div>
                        <div class="col-3 mt-3">
                            <label for="course_type">Course Type</label></br>
                            <label>
                                <input type="radio" id="course_type" class="course_type" name="course_type" value="online" <?php if ($course_type == "online") { ?> checked="checked" <?php } ?>> Online
                                <input type="radio" id="course_type" class="course_type" name="course_type" value="onsite" <?php if ($course_type == "onsite") { ?> checked="checked" <?php } ?>> Onsite
                            </label>
                        </div>

                        <div class="col-6 <?php if ($course_type === 'onsite' || $course_type === '') {
                                                echo 'hide';
                                            } ?>" id="course_join_link_section">
                            <label for="course_material">Course Join Link</label></br>
                            <textarea class="form-control" placeholder="Course Join Link" aria-label="Course Join Link" aria-describedby="email-addon" id="course_join_link" name="course_join_link" row="14"><?php echo $course_join_link; ?></textarea>
                        </div>

                        <div class="col-6 <?php if ($course_type === 'online' || $course_type === '') {
                                                echo 'hide';
                                            } ?>" id="course_location">
                            <label for="course_material">Course Location</label></br>
                            <textarea class="form-control" placeholder="Course Location" aria-label="Course Location" aria-describedby="email-addon" id="course_location" name="course_location" row="14"><?php echo $course_location; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="Name">Assign Course To Batch</label>
                            <div class="col-6">
                                <select class="form-control" name="course_batch" id="course_batch" placeholder="Select course batch">
                                    <?php
                                    $sql_batch = "select * from mbgt_batch where batch_status=1 order by batch_id desc";
                                    $q_batch = $mysqli->query($sql_batch);
                                    while ($rec_batch = $q_batch->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $rec_batch['batch_id'] ?>" <?php
                                                                                                if ($rec_batch['batch_id'] == $course_batch) {
                                                                                                    echo "selected";
                                                                                                }
                                                                                                ?>><?php echo $rec_batch['batch_name'];
                                                                                                    ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Name">Assign Student To This Course</label>
                            <div class="col-6">
                                <select id="choices-multiple-remove-button" name="assign_member[]" id="assign_member" placeholder="Select member name" multiple>
                                    <?php
                                    $sql_member = "select * from mbgt_member order by member_id desc";
                                    $q_member = $mysqli->query($sql_member);
                                    if (isset($_GET['mode']) && $_GET['mode'] !== "add") {
                                        $sql_assign_member = "select assign_member from mbgt_course where content_id = " . $_GET['content_id'];

                                        $q_assign_member = $mysqli->query($sql_assign_member);
                                        $rec_assign_member = $q_assign_member->fetch_assoc();
                                    }
                                    while ($rec_member = $q_member->fetch_assoc()) {
                                        if ($rec_assign_member['assign_member'] !== 'null') {
                                    ?>

                                            <option value="<?php echo $rec_member['member_id'] ?>" <?php
                                                                                                    if (isset($_GET['mode']) && $_GET['mode'] !== "add") {
                                                                                                        if ($rec_assign_member['assign_member']) {
                                                                                                            if ($rec_member['member_id'] !== null && in_array($rec_member['member_id'], json_decode($rec_assign_member['assign_member']))) {
                                                                                                                echo "selected";
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                    ?>><?php echo $rec_member['emp_name'];
                                                                                                        ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $rec_member['member_id'] ?>"><?php echo $rec_member['emp_name'];
                                                                                                    ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>
                                <input type="checkbox" id="content_status" name="content_status" value="1" <?php if ($content_status == "0") { ?> <?php } else { ?>checked="checked" <?php } ?>> Active
                            </label>
                        </div>
                        <div class="text-center col-2 d-flex">
                            <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Submit</button>
                            <button type="button" class="btn btn-link w-100 my-4 mb-2" onclick="javascript:window.location.href='<?php echo $page; ?>.php';">Cancel</button>
                        </div>
                    </form>

                    <!-- </div> -->
                </div>

            </div>
    </main>
    <script>
        $(document).ready(function() {

            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount: 100,
                searchResultLimit: 100,
                renderChoiceLimit: 100
            });
            var ChoiceBatch = new Choices('#choices-batch-button', {
                removeItemButton: true,
                maxItemCount: 100,
                searchResultLimit: 100,
                renderChoiceLimit: 100
            });

            $('.course_type').click(function() {

                if ($(this).val() === 'online') {
                    $('#course_join_link_section').removeClass('hide');
                    $('#course_location').addClass('hide');
                } else {
                    $('#course_join_link_section').addClass('hide');
                    $('#course_location').removeClass('hide');
                }

            });

            function checkdate() {
                var DateStart = $("#course_start_date").val();
                var DateEnd = $("#course_end_date").val();
                if (DateEnd < DateStart) {
                    alert("End date cannot be less than Start date.");
                    return false;
                }
                return true;
            }
        });
    </script>
    <style>
        .mt-100 {
            margin-top: 100px
        }

        .hide {
            display: none;
        }

        .choices__list--multiple .choices__item {
            background-color: #cb0c9f;
            border: 1px solid #cb0c9f;
        }

        .choices[data-type*=select-multiple] .choices__button,
        .choices[data-type*=text] .choices__button {
            border-left: #eee;
        }
    </style>
    <?php include 'footer.php'; ?>