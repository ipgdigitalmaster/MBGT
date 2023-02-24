<?php include 'header.php' ?>

<body class="g-sidenav-show  bg-gray-100">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">

           <!-- content here!! -->
           <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="text-center mx-auto">
                            <h1>Reward</h1>
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix mt-2 mb-3"></div>


            <div class="card">
                <div class="card-body p-3 mt-2">

                    <!-- <h3 class="mb-4">Ranking</h3> -->

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Information</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ranking-tab" data-bs-toggle="tab" data-bs-target="#attendee" type="button" role="tab" aria-controls="details" aria-selected="false">My point</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="points-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">My point</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active mt-4" id="info" role="tabpanel" aria-labelledby="info-tab"></div>
                        <div class="tab-pane fade show active mt-4" id="attendee" role="tabpanel" aria-labelledby="ranking-tab">
                            <div class="card container mb-3 pt-2 pb-2 border border-warning">
                                <div class="row">
                                    <div class="col-3 ">
                                        <img src="cms/assets/img/bruce-mars.jpg" class="img-fluid rounded mx-auto d-block " alt="..."style="max-height: 200px;">
                                        <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-2">
                                        <span class="visually-hidden"></span>1</span>
                                    </div>
                                    <div class="col-6 ">
                                        <h6 class="">Joshua Jackson</h6>
                                    </div>
                                    <div class="col-3">
                                        <h3 class="text-info">300</h3>
                                        <small>points</small>
                                    </div>
                                </div>
                            </div>


                            <div class="card container mb-3 pt-2 pb-2 border border-info">
                                <div class="row">
                                    <div class="col-3 ">
                                        <img src="cms/assets/img/team-1.jpg" class="img-fluid rounded mx-auto d-block " alt="..."style="max-height: 200px;">
                                        <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-info p-2">
                                        <span class="visually-hidden"></span>2</span>
                                    </div>
                                    <div class="col-6 ">
                                        <h6 class="">Joshua Jackson</h6>
                                    </div>
                                    <div class="col-3">
                                        <h3 class="text-info">280</h3>
                                        <small>points</small>
                                    </div>
                                </div>
                            </div>

                            <div class="card container mb-3 pt-2 pb-2 border border-success">
                                <div class="row">
                                    <div class="col-3 ">
                                        <img src="cms/assets/img/team-2.jpg" class="img-fluid rounded mx-auto d-block " alt="..."style="max-height: 200px;">
                                        <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-success p-2">
                                        <span class="visually-hidden"></span>3</span>
                                    </div>
                                    <div class="col-6 ">
                                        <h6 class="">Joshua Jackson</h6>
                                    </div>
                                    <div class="col-3">
                                        <h3 class="text-info">260</h3>
                                        <small>points</small>
                                    </div>
                                </div>
                            </div>

                            <div class="card container mb-3 pt-2 pb-2">
                                <div class="row">
                                    <div class="col-3 ">
                                        <img src="cms/assets/img/team-3.jpg" class="img-fluid rounded mx-auto d-block " alt="..."style="max-height: 200px;">
                                    </div>
                                    <div class="col-6 ">
                                        <h6 class="">Joshua Jackson</h6>
                                    </div>
                                    <div class="col-3">
                                        <h4 class="text-info">100</h4>
                                        <small>points</small>
                                    </div>
                                </div>
                            </div>

                            <div class="card container mb-3 pt-2 pb-2">
                                <div class="row">
                                    <div class="col-3 ">
                                        <img src="cms/assets/img/team-4.jpg" class="img-fluid rounded mx-auto d-block " alt="..."style="max-height: 200px;">
                                    </div>
                                    <div class="col-6 ">
                                        <h6 class="">Joshua Jackson</h6>
                                    </div>
                                    <div class="col-3">
                                        <h4 class="text-info">99</h4>
                                        <small>points</small>
                                    </div>
                                </div>
                            </div>
                            
                           



                            <!-- <div class="card">
                                <div class="col-md-4">

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
                                            <img src="cms/assets/img/team-4.jpg" class="img-fluid rounded mx-auto d-block " alt="..."style="max-height: 200px;">
                                            
                                        </div>
                                        <div class="col-6 ">
                                            <b class="">Joshua Jackson</b>
                                            <small>Your ranking is <strong class="text-primary">5</strong></small>
                                        </div>
                                        <div class="col-3">
                                            <h3 class="text-info">99</h3>
                                            <!-- <small>points</small> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <smal>
                                    <p>Remark:</p>
                                    <ol>
                                        <li>Lorem ipsum is placeholder text commonly used in the graphic</li>
                                        <li>Ea nesciunt molestias est sunt maiores 33 laudantium iste.</li>
                                        <li>Non earum ipsum rem cupiditate dicta est amet neque et dolorem magnam?</li>
                                        <li>Non quisquam exercitationem in dolores cupiditate eos neque necessitatibus.</li>
                                    </ol>
                                </smal>
                                
                            </div>

                            
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </main>

<?php include 'footer.php'; ?>