<?php include 'header.php' ?>
<?php 
$menu_title = "Course";
$page = "course-response";
$PK_field = "content_id";
$PK_status = "content_status";
$tbl_name = $FTblName . "_response";
$fieldlist = array('course_id','userid','content_detail');
$pagesize = 25;
if (isset($_POST['mode'])){
    #echo "mode";
    if ($_POST['mode'] == "add") { 
        include "../include/m_add.php";
    }
    if ($_POST['mode'] == "update" ) { 
        include ("../include/m_update.php");
    }
    #echo $sql;
    ?>
    <script>window.location.href='<?php echo $page.".php?content_id=".$_POST['course_id']; ?>';</script>
    <?php
}else{
    if (isset($_GET['mode']) && $_GET['mode'] == "add") { 
         //Check_Permission ($check_module,$_SESSION[login_id],"add");
    }else if (isset($_GET['mode']) && $_GET['mode'] == "update") { 
        // Check_Permission ($check_module,$_SESSION[login_id],"update");
        $sql = "select * from $tbl_name where $PK_field = '" . trim($_GET[$PK_field]) ."'";
        
        $q = $mysqli->query($sql);
        while ($rec = $q->fetch_assoc()){  
            $$PK_field = $rec[$PK_field];
            foreach ($fieldlist as $key => $value) { 
                $$value = $rec[$value];
            } 
        }
    }else{
        ?>
        <script>window.location.href='<?php echo $page.".php"; ?>';</script>
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


            <form role="form" action="<?php echo $page;?>-update.php" method="post" enctype="multipart/form-data">
                <?php if ($_GET['mode']=="update") { ?>
                <input name="<?php echo $PK_field;?>" type="hidden" id="<?php echo $PK_field;?>" value="<?php echo $$PK_field;?>">
                <?php } ?>
                <input type="hidden" id="mode" name="mode" value="<?php echo $_GET['mode'];?>">
                <input type="hidden" id="course_id" name="course_id" value="<?php echo $_GET['content_id'];?>">

                <div class="mb-3">
                    <label for="userid">Member</label>
                    <select id="userid" name="userid">
                        <?php $s="SELECT * FROM `".$FTblName."_enroll` a inner join `".$FTblName."_member` b on a.userid=b.userid where course_id = '".$_GET['content_id']."' ";
#echo $s;
$q = $mysqli->query($s);
while($r = $q->fetch_assoc())
{ ?>
                        <option value="<?php echo $r['userid'];?>"><?php echo $r['emp_name'];?> (<?php echo $r['emp_code'];?>)</option>
                        <?php } ?>
                    </select>
                </div> 

                <div class="mb-3">
                    <label for="content_detail">Feedback</label>
                    <textarea class="form-control" placeholder="Course Detail" aria-label="Course Detail" aria-describedby="email-addon" id="content_detail" name="content_detail" row="4"><?php echo $content_detail;?></textarea>
                </div> 


                <div class="text-center col-2 d-flex">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Submit</button>
                    <button type="button" class="btn btn-link w-100 my-4 mb-2" onclick="javascript:window.history.back();">Cancel</button>
                </div>
            </form>

        </div>
    </main>

<?php include 'footer.php'; ?>