<?php include 'header.php' ?>
<?php
//$page = "instructor-attendee-edit";
$pre_page = "instructor-course-detail";

$tbl_name = $FTblName . "_course";
$PK_field = "content_id";
$PK_status = "content_status";
$content_id = isset($_GET['cid']) ? $_GET['cid'] : '1';
$s = "SELECT * FROM `" . $tbl_name . "` where $PK_status = '1' and $PK_field =" . $content_id;
#echo $s;
$q = $mysqli->query($s);
?>

<body class="g-sidenav-show  bg-gray-100">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4 ">

            <!-- content here!! -->
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="text-center mx-auto">
                            <?php while ($r = $q->fetch_assoc()) { ?>
                                <h2><?php echo $r['content_name']; ?></h2>

                                <div class="col-12 col-xl-4 mx-auto mt-4">
                                    <img src="<?php echo $r['content_picture']; ?>" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                </div>
                            <?php  } ?>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-8 mt-4 mx-auto">
                    <form role="form">
                        <div class="card">
                            <div class="card-body p-3 mt-2">
                                <h4>Student Information</h4>
                                <?php
                                $s_member = "SELECT * FROM mbgt_member where member_id = " . $_GET['member_id'];
                                #echo $s;
                                $q_member = $mysqli->query($s_member);
                                while ($r_member = $q_member->fetch_assoc()) {

                                ?>
                                    <div class="form-group">
                                        <label for="student-name" class="form-control-label">Name</label>
                                        <input class="form-control" type="text" disabled value="<?php echo $r_member['emp_name'] ?>" id="student-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="student-name" class="form-control-label">Surname</label>
                                        <input class="form-control" type="text" disabled value="<?php echo $r_member['emp_surname'] ?>" id="student-surname">
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_agency" class="form-control-label">Brand agency</label>
                                        <input class="form-control" type="text" disabled value="<?php echo $r_member['brand_agency'] ?>" id="brand_agency">
                                    </div>
                                <?php     } ?>
                            </div>
                        </div>

                        <div class="clearfix mt-2 mb-3"></div>

                        <div class="card">
                            <div class="card-body p-3 mt-2">
                                <h4>Point</h4>
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="student-admission" class="form-control-label">Admission to class</label>
                                        <!-- <input class="form-control" type="number" value="10" id="student-admission" placeholder="Min = 0, Max = 10" max="10" min="0"> -->
                                        <div class="form-check form-switch">
                                            <?php
                                            $s_attend = "SELECT * FROM mbgt_attend where member_id = " . $_GET['member_id'] . " and course_id = " . $_GET['cid'];

                                            $q_attend = $mysqli->query($s_attend);
                                            $r_attend = $q_attend->fetch_assoc();
                                            ?>
                                            <input class="form-check-input" type="checkbox" id="studentJoinClass" <?php if ($r_attend) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                                            <label class="form-check-label" for="studentJoinClass">Join</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-8">
                                        <label for="admission-time" class="form-control-label">Admission time</label>
                                        <input class="form-control" type="datetime-local" value="<?php echo  $r_attend['admission_time'] ?>" id="admission-time">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="pre-test" class="form-control-label">Pre Test</label>
                                        <input class="form-control" type="number" value="<?php echo  $r_attend['pre_test'] ?>" id="pre-test">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="post-test" class="form-control-label">After Test</label>
                                        <input class="form-control" type="number" value="<?php echo  $r_attend['after_test'] ?>" id="after-test">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="student-cooperate-in-class" class="form-control-label">Cooperate in class</label>
                                    <input class="form-control" type="number" value="<?php echo  $r_attend['cooperate_in_class'] ?>" id="cooperate-in-class" placeholder="Min = 0, Max = 10" max="10" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="extra-point" class="form-control-label">Extra point</label>
                                    <input class="form-control" type="number" value="<?php echo  $r_attend['extra_point'] ?>" id="extra-point" placeholder="Min = 0, Max = 10" max="10" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="clearfix mt-2 mb-3"></div>

                        <div class="card">
                            <div class="card-body p-3 mt-2">
                                <h4>Suggestion and recommend</h4>
                                <div class="form-group">
                                    <label for="example-tel-input" class="form-control-label">Suggestion</label>
                                    <div class="input-group">
                                        <textarea class="form-control" aria-label="With textarea" row="8" id="suggestion"><?php echo  $r_attend['suggestion'] ?></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="mx-auto col-2 d-flex">
                            <input type="hidden" id="memberID" value="<?php echo $_GET['member_id'] ?>">
                            <input type="hidden" id="contentID" value="<?php echo $_GET['cid'] ?>">
                            <input type="hidden" id="id" value="<?php echo  $r_attend['id'] ?>">
                            <button type="button" onclick="javascript:submitform()" class="btn bg-gradient-dark w-100 my-4 mb-2">Submit</button>
                            <button type="button" class="btn btn-link w-100 my-4 mb-2" onclick="javascript:window.location.href='<?php echo $pre_page; ?>.php';">Cancel</button>
                        </div>
                    </form>

                </div>
            </div>


        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script>
        $(function() {
            var table = $('#attendee-list').DataTable({
                dom: 'Bfrtip',
                lengthChange: false,
                buttons: ['copyHtml5', 'excelHtml5']
            });

            table.buttons().container()
                .appendTo('.attendee-list_wrapper .btn btn-outline-primary');
        });

        function submitform() {

            $.post("save-attend.php", {
                    id: $('#id').val(),
                    member_id: $('#memberID').val(),
                    course_id: $('#contentID').val(),
                    student_join_class: $('#studentJoinClass').val(),
                    admission_time: $('#admission-time').val(),
                    pre_test: $('#pre-test').val(),
                    after_test: $('#after-test').val(),
                    cooperate_in_class: $('#cooperate-in-class').val(),
                    extra_point: $('#extra-point').val(),
                    suggestion: $('#suggestion').val(),
                })
                .done(function(data) {
                    console.log('Update ', data);
                    window.location.href = 'instructor-course-detail.php?content_id=' + $('#contentID').val()

                });

        }
    </script>