<?php include 'header.php';
    $menu_title = "Course Feedback";
    $page = "feedback";
?>

<body class="g-sidenav-show  bg-gray-100">
    <?php include 'sidebar.php'; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php include 'navbar.php'; ?>
        <div class="container-fluid py-4">

           <!-- content here!! -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="card h-100">
                            <div class="card-header pb-0 p-3">
                                <h4 class="mb-0">Input form</h4>
                            </div>
                            <div class="card-body p-3">
                                <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>

                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="name" placeholder="Name" value="Alec" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" placeholder="Role" class="form-control" value="Admin" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="lastname" placeholder="Lastname" value="Thompson" />
                                            </div>
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="name@example.com">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Change Password</h6>

                                    <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group has-success">
                                            <input type="password" placeholder="Password" class="form-control is-valid" />
                                        </div>
                                        </div>
                                        <div class="w-100"></div>
                                        <div class="col-md-6">
                                        <div class="form-group has-danger">
                                            <input type="password" placeholder="Confirm Password" class="form-control is-invalid" />
                                        </div>
                                        </div>
                                    </div>
                                    <div class="text-center col-2 d-flex">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Submit</button>
                                    </div>
                                </form>
                                
                                
                            </div>
                        </div>
                    </div>

                
                </div>
            </div>
       
        </div>
    </main>

<?php include 'footer.php'; ?>