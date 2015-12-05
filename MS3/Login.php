<?php
	require "connection.php";

	//prepared statement to insert new_user into DB
		$stmt_new_user = mysqli_prepare($conn,"INSERT INTO user
			(user_id,user_password) 
			VALUES (?,md5(?))");
		
		// check connection status
		if($stmt_new_user==FALSE){die("Connecton failed:".mysqli_connect_error());}
		
		mysqli_stmt_bind_param($stmt_new_user, "ss",  
			$_POST['user_id'],
			$_POST['user_password']
			);
		//execute prepared statement
		mysqli_stmt_execute($stmt_new_user);

		//close statement and connection
		mysqli_stmt_close($stmt_new_user);
		
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
</head>

<h1>Welcome Applicant!</h1>

<body>

<form action="login_redirect.php" method="POST">

	<p>
		Username:
		<input type="email" name="user_id" placeholder="enter email address" >		
	</p>

	<p>
		Password:
		<input type="password" name="user_password" placeholder="enter password" >
	</p>

	<p>
		<button type="submit" formaction="login_redirect.php" name="create_app">Create Application
		</button>
		<button type="submit" formaction="view_redirect.php" name="view_app">View Application
		</button>
	</p>

	<p>
		<h3>New applicant?</h3>
	</p>
	<p>
		Create an account:
		<button type="submit" formaction="CreateNewUserAccount.php" name="new_user">Create new account
		</button>
	</p>
</form>

</body>

</html>