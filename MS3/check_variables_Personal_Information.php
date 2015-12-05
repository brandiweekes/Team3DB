<?php

// set a boolean to track if Personal_Information fields are completed
$personalInfoIsComplete = True;

if (strlen($_POST['student_fname']) > 0) {
	$student_fname = $_POST['student_fname'];
} else {
	echo "<p> <font color='red'>* First name not entered. </font> <p>";
	$personalInfoIsComplete = False;
}

if(strlen($_POST['student_initial']) > 0){
	$student_initial = $_POST['student_initial'];
} else {
	$student_initial = NULL;
}

if (strlen($_POST['student_lname']) > 0) {
	$student_lname = $_POST['student_lname'];
} else {
	echo "<p> <font color='red'>* Last name not entered. </font> <p>";
	$personalInfoIsComplete = False;
}

if(strlen($_POST['student_prefname']) > 0){
	$student_prefname = $_POST['student_prefname'];
} else {
	$student_prefname = NULL;
}

if (strlen($_POST['student_street_addr']) > 0) {
	$student_street_address = $_POST['student_street_addr'];
} else {
	echo "<p> <font color='red'>* Street address not included in mailing address.
	</font> <p>";
	$personalInfoIsComplete = False;
}

if(strlen($_POST['student_unit_num']) > 0){
	$student_unit_num = $_POST['student_unit_num'];
} else {
	$student_unit_num = NULL;
}
	
if (strlen($_POST['student_city']) > 0) {
	$student_city = $_POST['student_city'];
} else {
	echo "<p> <font color='red'>* City not included in mailing address. </font> <p>";
	$personalInfoIsComplete = False;
}

if (strlen($_POST['student_zip']) > 0) {
	$student_zip = $_POST['student_zip'];
} else {
	echo "<p> <font color='red'>* Zip code not included in mailing address. 
	</font> <p>";
	$personalInfoIsComplete = False;
}

if (strlen($_POST['prefphoneA']) == 3 && 
	strlen($_POST['prefphoneB']) == 3 && 
	strlen($_POST['prefphoneC']) == 4) {
	$student_prefphone = $_POST['prefphoneA'] . $_POST['prefphoneB'] . $_POST['prefphoneC'];
} else {
	echo "<p> <font color='red'>* Complete phone number not entered.</font> <p>";
	$personalInfoIsComplete = False;
}
	
if (isset($_POST['student_citizen'])) {
	$student_citizen = $_POST['student_citizen'];
} else {
	echo "<p> <font color='red'>* US citizenship status not selected. </font> <p>";
	$personalInfoIsComplete = False;
}

if (isset($_POST['student_english_lang'])) {
	$student_english_lang = $_POST['student_english_lang'];
} else {
	echo "<p> <font color='red'>* English as native language status not selected. 
	</font> <p>";
	$personalInfoIsComplete = False;
}

if ($_POST['vet_status_id'] == 'NV'){
	$military_id = NULL;
} else {
	$military_id = $_POST['military_id'];
}

if (isset($_POST['student_hisplat'])){
	$hisplat = $_POST['student_hisplat'];
} else {
	echo "<p> <font color='red'>* Hispanic/Latino status not selected. 
	</font> <p>";
	$personalInfoIsComplete = False;
}


if(isset($_POST['origin_id'])){
	$origin_id = $_POST['origin_id'];
} else {
	echo "<p> <font color='red'>* Origin status not selected. 
	</font> <p>";
	$personalInfoIsComplete = False;
}

$student_dob = $_POST['bdayYear'] . "-" . $_POST['bdayMonth'] . "-" . $_POST['bdayDay'];
$state_id = $_POST['state_id'];
$gender_id = $_POST['student_gender'];
$vet_status_id = $_POST['vet_status_id'];

?>