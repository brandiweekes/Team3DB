<?php 
require "connection.php";
session_start();
?>

<html> 
<head>
	<title>Confirmation</title>
</head>
<body>

    <form action="Logout.php" method="post">

<?php

$current_app_id = $_SESSION['application_id'];

//New_Application table vars start here-----------------
$grad_type = "SELECT grad_type_description FROM new_application, graduate_type 
WHERE  new_application.application_ID = $current_app_id AND 
new_application.grad_type_id = graduate_type.grad_type_id";
$grad_type_result = mysqli_query($conn, $grad_type);

$college = "SELECT college.college_description FROM new_application, college 
WHERE  new_application.application_ID = $current_app_id AND 
new_application.College_id = college.College_id";
$college_result = mysqli_query($conn, $college);

$degree_type = "SELECT desired_degree.desired_description FROM  new_application, desired_degree 
WHERE  new_application.application_ID = $current_app_id AND 
new_application.degree_id = desired_degree.degree_id";
$degree_type_result = mysqli_query($conn, $degree_type);

$major = "SELECT desired_major.desired_major_description FROM  new_application, desired_major 
WHERE  new_application.application_ID = $current_app_id AND 
new_application.desired_major_id = desired_major.desired_major_id";
$major_result = mysqli_query($conn, $major);

$term_season = "SELECT term_season.term_season_description FROM new_application, term_season
 WHERE new_application.application_ID = $current_app_id AND 
new_application.term_season_id = term_season.term_season_id";
$term_season_result = mysqli_query($conn, $term_season);

$term_year = "SELECT term_year.term_year_actual FROM  new_application, term_year 
WHERE  new_application.application_ID = $current_app_id AND
 new_application.term_year_id = term_year.term_year_id";
$term_year_result = mysqli_query($conn, $term_year);

//Personal_Information table vars start here-----------------

$name = "SELECT student_fname, student_initial, student_lname FROM personal_information 
WHERE personal_information.application_ID = $current_app_id";
$name_result = mysqli_query($conn, $name);

$preferred_name = "SELECT student_prefname FROM personal_information
WHERE personal_information.application_ID = $current_app_id";
$preferred_name_result = mysqli_query($conn, $preferred_name);

$dob = "SELECT student_dob FROM personal_information
WHERE personal_information.application_ID = $current_app_id";
$dob_result = mysqli_query($conn, $dob);

$address = "SELECT student_street_address, student_unit_num, student_city, state_id, student_zip FROM personal_information
WHERE personal_information.application_ID = $current_app_id";
$address_result = mysqli_query($conn, $address);

$phone = "SELECT  student_prefphone from personal_information 
WHERE personal_information.application_ID = $current_app_id";
$phone_result = mysqli_query($conn, $phone);

$citizen = "SELECT student_citizen FROM personal_information
WHERE personal_information.application_ID = $current_app_id";
$citizen_result = mysqli_query($conn, $citizen);

$native_english = "SELECT student_english_lang FROM personal_information
WHERE personal_information.application_ID = $current_app_id";
$native_english_result = mysqli_query($conn, $native_english);

$gender = "SELECT gender.gender_description FROM personal_information, gender
WHERE personal_information.application_ID = $current_app_id AND 
personal_information.gender_id = gender.gender_id";
$gender_result = mysqli_query($conn, $gender);

$veteran_status = "SELECT veteran_status.vet_status_description FROM personal_information, veteran_status
WHERE personal_information.application_ID = $current_app_id AND 
personal_information.vet_status_id = veteran_status.vet_status_id";
$veteran_status_result = mysqli_query($conn, $veteran_status);

$branch = "SELECT military_branch.military_description FROM personal_information, military_branch
WHERE personal_information.application_ID = $current_app_id AND 
personal_information.military_ID = military_branch.military_ID";
$branch_result = mysqli_query($conn, $branch);

$hispanic = "SELECT hisplat FROM personal_information
WHERE personal_information.application_ID = $current_app_id";
$hispanic_result = mysqli_query($conn, $hispanic);

//Other variables not neatly grouped into a single table follow:

$ethnicity = "SELECT origin_type.origin_description FROM 
personal_information, applicant_origin, origin_type
WHERE personal_information.application_ID = $current_app_id 
AND applicant_origin.application_ID = $current_app_id 
AND personal_information.application_ID = applicant_origin.application_ID 
AND applicant_origin.origin_ID = origin_type.origin_ID";
$ethnicity_result = mysqli_query($conn, $ethnicity);

$finaid = "SELECT app_financial_aid FROM application_information
WHERE application_information.application_ID = $current_app_id";
$finaid_result = mysqli_query($conn, $finaid);

$emp_asst = "SELECT app_employer_tuition FROM application_information
WHERE application_information.application_ID = $current_app_id";
$emp_asst_result = mysqli_query($conn, $emp_asst);

$other_progs = "SELECT app_other_program_apps FROM application_information
WHERE application_information.application_ID = $current_app_id";
$other_progs_result = mysqli_query($conn, $other_progs);

$felony = "SELECT app_felony FROM application_information
WHERE application_information.application_ID = $current_app_id";
$felony_result = mysqli_query($conn, $felony);

$sanctioned = "SELECT app_sanctioned FROM application_information
WHERE application_information.application_ID = $current_app_id";
$sanctioned_result = mysqli_query($conn, $sanctioned);

$ed_hist = "SELECT ed_institution, ed_start, ed_finish, 
ed_degree_recd_date, ed_major, degree_earned_id, state_id 
FROM ed_history
WHERE ed_history.application_ID = $current_app_id
AND ed_history.application_ID = $current_app_id";
$ed_hist_result = mysqli_query($conn, $ed_hist);

$employment = "SELECT emp_name, emp_occupation, emp_startdate, 
emp_enddate, fptime_id, emp_current, emp_street_addr, emp_unit_num,
emp_city, emp_zip, emp_phone, state_id FROM employer 
WHERE employer.application_ID = $current_app_id AND employer.application_ID = $current_app_id";
$employment_result = mysqli_query($conn, $employment);

$test = "SELECT entrance_test.test_description, applicant_test.month_id, 
applicant_test.test_year FROM entrance_test, applicant_test WHERE
entrance_test.test_ID = applicant_test.test_ID AND 
applicant_test.application_ID = $current_app_id";
$test_result = mysqli_query($conn, $test);
?>

    <!-- Print variables below: -->

  
<p style='margin-left:20px;'> Student Type: 
<?php if (mysqli_num_rows($grad_type_result) > 0) 
{ while($row = mysqli_fetch_row($grad_type_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> College:
<?php if (mysqli_num_rows($college_result) > 0) 
{ while($row = mysqli_fetch_row($college_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Degree Type:
<?php if (mysqli_num_rows($degree_type_result) > 0) 
{ while($row = mysqli_fetch_row($degree_type_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Major:
<?php if (mysqli_num_rows($major_result) > 0) 
{ while($row = mysqli_fetch_row($major_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Term:
<?php if (mysqli_num_rows($term_season_result) > 0) 
{ while($row = mysqli_fetch_row($term_season_result)) { echo $row[0]; } } ?> 

<?php if (mysqli_num_rows($term_year_result) > 0) 
{ while($row = mysqli_fetch_row($term_year_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Name:
<?php if (mysqli_num_rows($name_result) > 0) 
{ while($row = mysqli_fetch_row($name_result)) { echo $row[0]," ".$row[1]." ",$row[2]; } } ?>

<p style='margin-left:20px;'> Preferred Name:
<?php if (mysqli_num_rows($preferred_name_result) > 0) 
{ while($row = mysqli_fetch_row($preferred_name_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Date of Birth:
<?php if (mysqli_num_rows($dob_result) > 0) 
{ while($row = mysqli_fetch_row($dob_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Mailing Address:
<?php if (mysqli_num_rows($address_result) > 0) 
{ while($row = mysqli_fetch_row($address_result)) { echo $row[0]," ".$row[1].", ",
$row[2].", ",$row[3]." ",$row[4]; } } ?>

<p style='margin-left:20px;'> Phone Number: 
<?php if (mysqli_num_rows($phone_result) > 0) 
{ while($row = mysqli_fetch_row($phone_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> US Citizen:
<?php if (mysqli_num_rows($citizen_result) > 0) 
{ while($row = mysqli_fetch_row($citizen_result)) 
	{ if ($row[0]==1){echo "Yes";}else{echo "No"; } } } ?>

<p style='margin-left:20px;'> Native English Speaker:
<?php if (mysqli_num_rows($native_english_result) > 0) 
{ while($row = mysqli_fetch_row($native_english_result)) 
	{ if ($row[0]==1){echo "Yes";}else{echo "No"; } } } ?>

<p style='margin-left:20px;'> Gender:
<?php if (mysqli_num_rows($gender_result) > 0) 
{ while($row = mysqli_fetch_row($gender_result)) { echo $row[0]; } } ?>

<p style='margin-left:20px;'> Veteran Status: <!--BRANCH!?-->
<?php if (mysqli_num_rows($veteran_status_result) > 0) 
{ while($row = mysqli_fetch_row($veteran_status_result)) {echo $row[0]; } } ?>

<p style='margin-left:20px;'> Branch: <!--BRANCH!?-->
<?php if (mysqli_num_rows($branch_result) > 0) 
{ while($row = mysqli_fetch_row($branch_result)) {echo $row[0]; } } ?>

<p style='margin-left:20px;'> Hispanic/Latino Origin:
<?php if (mysqli_num_rows($hispanic_result) > 0) 
{ while($row = mysqli_fetch_row($hispanic_result)) 
	{ if ($row[0]==1){echo "Yes";}else{echo "No"; } } } ?>

<p style='margin-left:20px;'> Ethnicity:
<?php if (mysqli_num_rows($ethnicity_result) > 0) 
{ while($row = mysqli_fetch_row($ethnicity_result)) {echo $row[0]." "; } } ?>

<p style='margin-left:20px;'> Financial Aid:
<?php if (mysqli_num_rows($finaid_result) > 0) 
{ while($row = mysqli_fetch_row($finaid_result)) 
	{ if ($row[0]==1){echo "Yes";}else{echo "No"; } } } ?>

<p style='margin-left:20px;'> Employer Assitance:
<?php if (mysqli_num_rows($emp_asst_result) > 0) 
{ while($row = mysqli_fetch_row($emp_asst_result)) 
	{ if ($row[0]==1){echo "Yes";}else{echo "No"; } } } ?>

<p style='margin-left:20px;'> Other Programs:
<?php if (mysqli_num_rows($other_progs_result) > 0) 
{ while($row = mysqli_fetch_row($other_progs_result)) 
	{ if ($row[0]==1){echo "Yes";}else{echo "No"; } } } ?>

<p style='margin-left:20px;'> Felony/Misdemeanor:
<?php if (mysqli_num_rows($felony_result) > 0) 
{ while($row = mysqli_fetch_row($felony_result)) 
	{ if ($row[0]==1){echo "Yes";}else{echo "No"; } } } ?>

<p style='margin-left:20px;'> Sanctioned:
<?php if (mysqli_num_rows($sanctioned_result) > 0) 
{ while($row = mysqli_fetch_row($sanctioned_result)) 
	{ if ($row[0]==1){echo "Yes";}else{echo "No"; } } } ?>

<p style='margin-left:20px;'> Educational History: </br>
<?php if (mysqli_num_rows($ed_hist_result) > 0) 
{ while($row = mysqli_fetch_row($ed_hist_result)) 
	{echo $row[0]." ",$row[1]." ",$row[2]." ",$row[3]." ",
	$row[4]." ",$row[5]." ",$row[6]." </br>"; } } ?>

<p style='margin-left:20px;'> Employment History: </br>
<?php if (mysqli_num_rows($employment_result) > 0) 
{ while($row = mysqli_fetch_row($employment_result)) 
	{echo $row[0]." ",$row[1]." ",$row[2]." ",$row[3]." ",
	$row[4]." ",$row[5]." ",$row[6].$row[7]." ",$row[8].
	" ",$row[9]." ",$row[10]." ",$row[11]." </br>"; } } ?>

<p style='margin-left:20px;'> Entrance Tests: </br>
<?php if (mysqli_num_rows($test_result) > 0) 
{ while($row = mysqli_fetch_row($test_result)) 
	{echo $row[0]." ",$row[1]." ",$row[2]." </br>"; } } 
	?>

<p style='margin-left:20px;'>

<p>
		<input type="submit" value="Log Out">
</p>

</form>
</body>
<?php
mysqli_free_result($grad_type_result);
mysqli_free_result($college_result);
mysqli_free_result($degree_type_result);
mysqli_free_result($major_result);
mysqli_free_result($term_season_result);
mysqli_free_result($term_year_result);
mysqli_free_result($name_result);
mysqli_free_result($preferred_name_result);
mysqli_free_result($dob_result);
mysqli_free_result($address_result);
mysqli_free_result($phone_result);
mysqli_free_result($citizen_result);
mysqli_free_result($native_english_result);
mysqli_free_result($gender_result);
mysqli_free_result($veteran_status_result);
mysqli_free_result($branch_result);
mysqli_free_result($hispanic_result);
mysqli_free_result($ethnicity_result);
mysqli_free_result($finaid_result);
mysqli_free_result($emp_asst_result);
mysqli_free_result($other_progs_result);
mysqli_free_result($felony_result);
mysqli_free_result($sanctioned_result);
mysqli_free_result($ed_hist_result);
mysqli_free_result($employment_result);
mysqli_free_result($test_result);
    mysqli_close($conn);
?>
</html>