<?php
require 'include/pdfcrowd.php';
include("include/config.php");
$member_id = $_GET['member_id'];
$course_id = $_GET['course_id'];
$s_member = "SELECT * FROM  `mbgt_member` where member_id = '" . $_GET['member_id']  . "'";
$q_member = $mysqli->query($s_member);
$r_member = $q_member->fetch_assoc();

$s_course = "SELECT * FROM  `mbgt_course` where content_id = '" . $_GET['course_id']  . "'";
$q_course = $mysqli->query($s_course);
$r_course = $q_course->fetch_assoc();

$certification_directory = "https://www.ensemblethailand.com/mbgt/certification/";

$sql_update_enroll = "update mbgt_enroll set certification_path = 'https://www.ensemblethailand.com/mbgt/certificate/Certification-" . str_replace(' ', '-', $r_course['content_name']) . "-For-" . str_replace(' ', '-', $r_member['emp_name']) . ".png" . "', update_date = now() where userid = '" . $r_member['userid']  . "' and course_id = '" . $course_id . "'";
$mysqli->query($sql_update_enroll);
try {
    // create the API client instance
    $client = new \Pdfcrowd\HtmlToImageClient("demo", "ce544b6ea52a5621fb9d55f8b542d14d");

    // configure the conversion
    $client->setOutputFormat("png");

    // run the conversion and write the result to a file 

    $image = $client->convertUrl("https://www.ensemblethailand.com/mbgt/certification.php?member_id=" . $member_id . "&course_id=" . $course_id);

    // set HTTP response headers
    header("Content-Type: image/png");
    header("Cache-Control: no-cache");
    header("Accept-Ranges: none");
    header("Content-Disposition: attachment; filename*=UTF-8''" . rawurlencode("Certification-" . str_replace(' ', '-', $r_course['content_name']) . "-For-" . str_replace(' ', '-', $r_member['emp_name']) . ".png"));

    echo $image;
    // create an output stream for the conversion result
    $output_stream = fopen("certificate/Certification-" . str_replace(' ', '-', $r_course['content_name']) . "-For-" . str_replace(' ', '-', $r_member['emp_name']) . ".png", "wb");

    // check for a file creation error
    if (!$output_stream)
        throw new \Exception(error_get_last()['message']);

    // run the conversion and write the result into the output stream
    $client->convertUrlToStream("https://www.ensemblethailand.com/mbgt/certification.php?member_id=" . $member_id . "&course_id=" . $course_id, $output_stream);

    // close the output stream
    fclose($output_stream);
} catch (\Pdfcrowd\Error $why) {
    // report the error
    error_log("Pdfcrowd Error: {$why}\n");

    // rethrow or handle the exception
    throw $why;
}
