<?php

include("include/config.php");
$member_id = $_GET['member_id'];
$course_id = $_GET['course_id'];
$s_member = "SELECT * FROM  `mbgt_member` where member_id = '" . $_GET['member_id']  . "'";
$q_member = $mysqli->query($s_member);
$r_member = $q_member->fetch_assoc();

$s_course = "SELECT * FROM  `mbgt_course` where content_id = '" . $_GET['course_id']  . "'";
$q_course = $mysqli->query($s_course);
$r_course = $q_course->fetch_assoc();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="./cms/assets/css/certificate-style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="background">
        <div id="Background"><img src="./cms/assets/img/certificate/Background.png"></div>
        <div id="VectorSmartObject"><img src="./cms/assets/img/certificate/VectorSmartObject.png"></div>
        <div id="VectorSmartObject_0"><img src="./cms/assets/img/certificate/VectorSmartObject_0.png"></div>
        <div id="VectorSmartObject_1">
            <div class="course_name"><?php echo $r_course['content_name'] ?></div>
        </div>
        <div id="CERTIFICATE"><img src="./cms/assets/img/certificate/CERTIFICATE.png"></div>
        <div id="OFACHIEVEMENT"><img src="./cms/assets/img/certificate/OFACHIEVEMENT.png"></div>
        <div id="ThiswillCertifythat"><img src="./cms/assets/img/certificate/ThiswillCertifythat.png"></div>
        <div id="ESTELLEDARCY">
            <div class="first_name"><?php echo $r_member['emp_name'] . ' ' . $r_member['emp_surname'] ?></div>
        </div>
        <div id="VectorSmartObject_2"><img src="./cms/assets/img/certificate/VectorSmartObject_2.png"></div>
        <div id="VectorSmartObject_3"><img src="./cms/assets/img/certificate/VectorSmartObject_3.png"></div>
        <div id="SUCCESSFULLYCOMPLETE"><img src="./cms/assets/img/certificate/SUCCESSFULLYCOMPLETE.png"></div>
    </div>
</body>

</html>