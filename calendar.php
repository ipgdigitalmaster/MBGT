<?php include 'header.php' ?>
<?php
$tbl_name = $FTblName . "_course";
$PK_field = "content_id";
$PK_status = "content_status";

$s = "SELECT * FROM `" . $tbl_name . "` where $PK_status = '1' ";
$monthFromToday = date("Y-m-d", strtotime("+1 month", strtotime(date("Y/m/d"))));
$q = $mysqli->query($s);
$course = [];
while ($r = $q->fetch_assoc()) {
    array_push($course, [
        'title' => $r['content_name'],
        'description' => $r['content_detail'],
        'start' => $r['course_start_date'],
        'className'=> 'btn-outline-primary'
    ]);
}
?>
<!-- <style>
    h2.fc-toolbar-title{
        display: none;
    }
</style> -->
<body class="g-sidenav-show  bg-gray-100">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">

            <!-- content here!! -->
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="text-center mx-auto">
                            <!-- <h1 class="calendar-month-title"><?=date("F Y")?></h1> -->
                            <h1 class="calendar-month-title">test</h1>
                            <h6>Coming Class</h6>
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix mt-2 mb-3"></div>


            <div class="card">
                <div class="card-body p-3 mt-2">
                    <div class="row">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>



        </div>
    </main>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js"></script>
    <script>
        // var eventsArray = [{
        //     title: 'Orientation class I',
        //     description: 'lorem1',
        //     start: '2023-01-09'
        // }, {
        //     title: 'Orientation class II',
        //     description: 'lorem2',
        //     start: '2023-01-09'
        // }, {
        //     title: 'English conversation',
        //     description: 'lorem3',
        //     start: '2023-02-05',
        //     end: '2023-02-07'
        // }, {
        //     title: 'Strategic and Creative Thinking',
        //     description: 'lorem4',
        //     start: '2023-01-27'
        // }, {
        //     title: 'Work Smart (Multi tasking VS Focus)',
        //     description: 'loprem5',
        //     start: '2023-01-30',
        //     url: 'https://www.google.com/'

        // }];

        var eventsArray = <?php echo json_encode($course); ?>;

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                // initialView: 'multiMonthYear',
                multiMonthMaxColumns: 1,
                headerToolbar: {
                    start: 'title',
                    center: 'prev,next',
                    end: 'dayGridMonth,listMonth'
                },

                dateClick: function(info) {

                    alert('Clicked on: ' + info.dateStr);

                    eventsArray.push({
                        title: "test event added from click",
                        date: info.dateStr
                    });
                    var date = $("#calendar").fullCalendar('getDate');
                    var month_int = date.getMonth();
                    alert(month_int);
                    calendar.refetchEvents();
                },

                eventClick: function(info) {
                    alert(info.event.title)
                },

                eventDidMount: function(info) {
                    // var tooltip = new Tooltip(info.el, {
                    //     title: info.event.extendedProps.description,
                    //     placement: 'top',
                    //     trigger: 'hover',
                    //     container: 'body'
                    // });
                },

                handleMonthChange: function(payload) {
                    alert('month change');
                    console.log('handleMonth change has been been');
                    console.log(paypload.startStr);
                },

                events: function(info, successCallback, failureCallback) {
                    successCallback(eventsArray);
                }

            });
            calendar.setOption('contentHeight', 400);
            calendar.render();

            // $('body').on('click', 'button.fc-next-button', function() {
            // alert('test');
            // var selectedMonth = $('#calendar').fullCalendar('getDate').month();
            // alert(selectedMonth);
            // $.ajax({
            //     type: "POST",
            //     url: "getCourse.php",
            //     data: {
            //         selectedMonth: selectedMonth,
            //         selectedYear: selectedYear
            //     },
            //     success: function(nextResult) {
            //         var nextResults = JSON.parse(nextResult);
            //         console.log(nextResults);
            //         populateCalendar(nextResults);
            //     }
            // });
            //  });


            
        });
        
    </script>