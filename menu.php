<?php include 'header.php' ?>

<body class="g-sidenav-show  bg-gray-100">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">

           <!-- content here!! -->
           <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="text-center mx-auto">
                            <h1>Menu by Role</h1>
                            <small>For test flow only</small>
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix mt-2 mb-3"></div>

            <!-- student -->
            <div class="card">
                <div class="card-body p-3 mt-2">
                    <h4>Student</h4>
                    <div class="row">
                        <ul class="nav flex-column btn-group-vertical">
                            <li class="nav-item">
                                <a class="nav-link" href="profile.php">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="course.php">All Course</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="my-course.php">My Course</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="reward.php">Ranking and reward</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="calendar.php">Calendar and event</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </div>


            <div class="clearfix mt-2 mb-3"></div>

            <!-- instructor -->
            <div class="card">
                <div class="card-body p-3 mt-2">
                    <h4>Instructor</h4>
                    <div class="row">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="instructor-profile.php">insturctor information</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="course.php">All Course</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="instructor-attendee-edit.php">My Course</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="instructor-course-detail.php">Ranking and reward</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="calendar.php">Calendar and event</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </main>

<?php include 'footer.php'; ?>