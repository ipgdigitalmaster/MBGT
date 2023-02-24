<?php 
@session_start();
/*error_reporting(~E_NOTICE ); */
date_default_timezone_set('Asia/Bangkok');
$url_true = "https://www.ensemblethailand.com/mbgt"; //http://localhost:88/ //http://www.ficdeodorant.com/
$offline_testing = false; #true/false
if($offline_testing){
	$host_h = "localhost";
	$user_h = "root";
	$pass_h = "";
	$dbname_h="admin_ensemble";
}else{ 
	$host_h = "localhost";
	$user_h = "admin_mbgt";
	$pass_h = "z?3g70mYz?3g70mY";
	$dbname_h="admin_mbgt";
} 

$FTblName="mbgt"; #
$lang_en = false; #true/false
$s_title="MB Academy";
$app_id = "";
$description = "";
$keywords = "";
$author = "";
$copyright = "";
$applicationname = "";
$title = "";
$image = "";
$set_price = 400;

define('UPLOAD_DIR', 'images/');
//line Token
$token = "/VDWPbUSmA0LYgyf499FkcrM1OeXUIPZ3nPwX4Z4i+PYYfHAUXZYFa6vCPC232COBdaWksxc9fRn99TR6SavwZ1iFRSbif9GrKtclYVUdFI0mjhITzZf37FTvVujo6CZyHK6okYvKc5UM2SvUAC4ngdB04t89/1O/w1cDnyilFU=";
//$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://www.$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
 
//------ CONNECT DATABASE ----------
$mysqli = new mysqli($host_h, $user_h, $pass_h, $dbname_h);
if ($mysqli->connect_errno) { 
}
$mysqli->set_charset("utf8mb4");
#printf("Current character set: %s\n", $mysqli->character_set_name());
