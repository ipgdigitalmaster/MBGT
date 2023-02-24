<?php include 'header.php' ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body class="g-sidenav-show  bg-gray-100">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
        <h1>My Course </h1>
        
            <!-- content here!! -->
                <?php
                $tbl_name = $FTblName . "_member";
                $PK_field = "member_id";
                $s="SELECT * FROM `".$FTblName."_enroll` a inner join ".$FTblName."_course b on a.course_id = b.content_id inner join ".$FTblName."_member c on a.userid = c.userid where c.userid = '".$_GET['userid']."'";
                #echo $s;
                $q = $mysqli->query($s);
                while ($r = $q->fetch_assoc())
                { 
                ?>
                <div class="text-center">
                    <a href="javascript:on_course('<?php echo $r['content_id'];?>');">
                        <img src="<?php echo $r['content_picture'];?>" width="100%"><br>
                        <?php echo $r['content_name'];?>
                    </a><br>
                </div>
                
                <?php } ?>
                <div class="text-center">
                     <a href="course.php"><input type="button" class="btn btn-default" value="Back to course"></a><br>
                </div>

           
        </div>
    </main>

<?php include 'footer.php'; ?>

<script>
function on_course(id){
    window.location.href='course-detail.php?userid=<?php echo $_GET['userid'];?>&cid='+id;
}
<?php if ($_GET['alert']=="true"){
?>
Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'Your course has been enroll.',
  showConfirmButton: true
})
<?php
} ?>
</script>