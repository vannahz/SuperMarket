<?php
header('Content-Type: application/json; charset=utf-8');
set_time_limit(0);
$q = $_GET['q'];

switch ($q) {
	case "get_message":
		listExpiringGoods();
		break;
	case "get_trigger_condtion":
		getTriggerCondition();
		break;
}

// Database Setting
function connectToDB(){
	$ip = "127.0.0.1:3306";
	$username = "root";
	$password = "111111";
	$schema = "worksap";

	$con = mysqli_connect($ip,$username,$password,$schema);
	if (!$con) {
	  die('Could not connect: ' . mysqli_error($con));
	}
	mysqli_select_db($con,$schema);
	
	return $con;
};

// Avoid Attack
function check_input($con, $value){
	if (get_magic_quotes_gpc()){
	  $value = stripslashes($value);
	}
	if (!is_numeric($value)){
	  $value = mysqli_real_escape_string($con, $value);
	}
	return $value;
}


function listExpiringGoods(){
	$recordTime = "";
	$goodsList = array();

	$con = connectToDB();	
	$sql="SELECT eg_product_type, eg_product_name, eg_production_date, eg_expiration_date, eg_amount, eg_leftdays, record_time FROM expiringgoods e WHERE record_time = (SELECT MAX(record_time) FROM expiringgoods e) ORDER BY eg_leftdays;";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)) {
		$recordTime = $row['record_time'];
		$goodsList[] = array("eg_product_type" => $row['eg_product_type'], "eg_product_name" => $row['eg_product_name'], "eg_production_date" => $row['eg_production_date'],"eg_expiration_date" => $row['eg_expiration_date'], "eg_amount" => $row['eg_amount'],"eg_leftdays" => $row['eg_leftdays']);
	}
	
	$result = array("recordTime" => $recordTime, "goodsList"=>$goodsList);
	echo json_encode($result);
	mysqli_close($con);	
}

function getTriggerCondition(){

	$schedule = "";
	$schedule_time = "";
	$send_to = "";
	$percentage = 0;
	$days = 0;

	$con = connectToDB();	
	$sql="SELECT no_schedule, no_schedule_time, no_send_to, no_tg_percentage, no_tg_days FROM notify WHERE no_type='expire';";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)) {
		
		$schedule = $row['no_schedule'];
		$schedule_time = $row['no_schedule_time'];
		$send_to = $row['no_send_to'];
		$percentage = $row['no_tg_percentage'];
		$days = $row['no_tg_days'];
	}
	
	$condition = array("schedule"=>$schedule, "schedule_time"=>$schedule_time, "send_to"=>$send_to, "percentage"=>$percentage, "days"=>$days);

	echo json_encode($condition);
	mysqli_close($con);	

}

?>