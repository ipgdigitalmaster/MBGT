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
                $sql_class = "SELECT * FROM mbgt_course where course_instructor LIKE '%" . '"' . $instructor_id . '"' . "%' order by content_id asc ";
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
                                        <!-- <select name="course_batch" id="course_batch" class="form-select"> -->
                                        <select id="batchFilter" class="form-control mb-4" style="padding: 0.5rem 2rem;">

                                            <?php
                                            $sql_batch = "select * from mbgt_batch where batch_status = 1 order by batch_id DESC";
                                            $q_batch = $mysqli->query($sql_batch);
                                            while ($r_batch = $q_batch->fetch_assoc()) {
                                                echo '<option value="' . $r_batch['batch_name'] . '">' . $r_batch['batch_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body p-3">
                                <div class="row">
                                    <table class="table align-items-center mb-0" id="course-list">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course Name</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batch</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">View Course Detail</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while ($result_class = $query_class->fetch_assoc()) { ?>


                                                <tr>
                                                    <td>
                                                        <div class="align-middle text-center">
                                                            <img src="<?php echo $result_class['content_picture'] ?>" class="avatar avatar-sm me-3">
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <?php echo $result_class['content_name'] ?> </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <?php
                                                        $sql_batch = "select * from mbgt_batch where batch_id = " . $result_class['course_batch'];
                                                        $q_batch = $mysqli->query($sql_batch);
                                                        $r_batch = $q_batch->fetch_assoc();
                                                        echo $r_batch['batch_name'];
                                                        ?>
                                                    </td>
                                                    <td class="text-center"> <a href="instructor-course-detail.php?content_id=<?php echo $result_class['content_id'] ?>">View</a></td>
                                                </tr>


                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
    </main>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <script>
        $("document").ready(function() {

            $("#course-list").dataTable({
                "dom": 'Bfrtip',
                "order": [
                    [0, 'desc']
                ],
                "searching": true,
            });
            $('#course-list_filter > label').hide();

            //Get a reference to the new datatable
            var table = $('#course-list').DataTable();

            $("#course-list_filter.dataTables_filter").append($("#batchFilter"));

            var categoryIndex = 0;
            $("#course-list th").each(function(i) {
                if ($($(this)).html() == "Batch") {
                    categoryIndex = i;
                    return false;
                }
            });


            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var selectedItem = $('#batchFilter').val()
                    var category = data[categoryIndex];
                    if (selectedItem === "" || category.includes(selectedItem)) {
                        return true;
                    }
                    return false;
                }
            );

            $("#batchFilter").change(function(e) {
                table.draw();
            });

            table.draw();
        });
    </script>