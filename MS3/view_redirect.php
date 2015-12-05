<?php
require "connection.php";
session_start();

// set 'user_id' SESSION variable
$_SESSION['user_id'] = $_POST['user_id'];

// check login credentials
$loginIsValid = FALSE;

$user = mysqli_real_escape_string($conn, $_POST['user_id']);
$pwd = $_POST['user_password'];
$sql = "SELECT * FROM user WHERE user_id = '$user' and user_password = md5('$pwd')";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0) {
	$loginIsValid = TRUE;
}

if(!$loginIsValid){
	goTo_Login();
} else{
	// check if user has created an application in new_application
	$stmt_NewApp = mysqli_prepare($conn, "SELECT application_id FROM new_application WHERE user_id = ?");
	mysqli_stmt_bind_param($stmt_NewApp, "s", $user);
	$user = $_POST['user_id'];
	mysqli_stmt_execute($stmt_NewApp);
	mysqli_stmt_bind_result($stmt_NewApp, $application);

	$countNewApp = 0;
	while(mysqli_stmt_fetch($stmt_NewApp)){
		$countNewApp++;
	}

	mysqli_stmt_close($stmt_NewApp);

	// if the user has created an application, find the state of completion
	if($countNewApp > 0){
		// set the applcation_id as a SESSION variable
		$sqlAppID = "SELECT application_id FROM new_application WHERE user_id ='$user'";
		$appID = mysqli_query($conn, $sqlAppID);
		$row = mysqli_fetch_row($appID);	
		$_SESSION['application_id'] = $row[0];
		
		// check to see if Personal_Information was completed
		$stmt_PerInf = mysqli_prepare($conn, "SELECT student_fname FROM 
		personal_information WHERE application_id = ?");
		mysqli_stmt_bind_param($stmt_PerInf, "i", $app);
		$app = $_SESSION['application_id'];
		mysqli_stmt_execute($stmt_PerInf);
		mysqli_stmt_bind_result($stmt_PerInf, $result_perInf);
		
		$countPerInf = 0;
		while(mysqli_stmt_fetch($stmt_PerInf)){
			$countPerInf++;
		}	
		mysqli_stmt_close($stmt_PerInf);

		// if Personal_Informaiton page completed, check next page
		if($countPerInf > 0){
			// check to see if Application_Information was completed
			$stmt_AppInf = mysqli_prepare($conn, "SELECT app_felony FROM 
			application_information	WHERE application_id = ?");
			mysqli_stmt_bind_param($stmt_AppInf, "i", $application);
			$application = $_SESSION["application_id"];
			mysqli_stmt_execute($stmt_AppInf);
			mysqli_stmt_bind_result($stmt_AppInf, $result_appInf);
			
			$countAppInf = 0;
			while(mysqli_stmt_fetch($stmt_AppInf)){
				$countAppInf++;
			}
			mysqli_stmt_close($stmt_AppInf);

			// if Application_Information completed, go to Confirmation page
			if($countAppInf > 0){
				goTo_Confirmation();			
			// else, if Application_Information not completed, go to Application_Information page			
			} else {
				goTo_applicationInfo();
			}	
		// else, if Personal_Informaiton not completed, go to Personal_Informaiton page	
		} else {
		goTo_personalInfo();
		}
	// else, if no application was created, go to New_Application page
	} else {
		goTo_newApplication();
	}
}


function goTo_Login(){
	echo <<<EOF
    <form action="Login.php" method="post">
<p> 
Your login credentials were not recognized, please try again. 
</p>
<p>
Click "Continue" to return to the Login page.
</p>
<p><input type="submit" value="Continue"></p>
EOF;
}

function goTo_Confirmation(){
	header("Location: Confirmation.php");
	exit();
}

function goTo_applicationInfo(){
	echo <<<EOF
	<form action="Application_Information.php" method="post">
<p>
Our records show that your application is incomplete. 
</p>
<p>
Please click "Continue" to return to the Application Information page to complete your application.<br>
Once your application is complete, you will be able to review your submission.
</p>
<input type="hidden" name="redirection" value="redirected">
<p><input type="submit" value="Continue"></p>
EOF;
}

function goTo_personalInfo(){
	echo <<<EOF
    <form action="Personal_Information.php" method="post">
<p>
Our records show that your application is incomplete. 
</p>
<p>
Please click "Continue" to return to the Personal Information page to complete your application.<br>
Once your application is complete, you will be able to review your submission.
</p>
<input type="hidden" name="redirection" value="redirected">
<p><input type="submit" value="Continue"></p>
EOF;
}

function goTo_newApplication(){
	echo <<<EOF
    <form action="New_Application.php" method="post">
<p>
Our records show that you have not yet created an application. 
</p>
<p>
Please click "Continue" to begin a new application.<br>
Once your application is complete, you will be able to review your submission.
</p>
<p><input type="submit" value="Continue"></p>
EOF;
}

mysqli_close($conn);
?>