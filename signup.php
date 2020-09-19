<?php

	include('config/db_connect.php');


	$uname = $email = $password = $rpassword = '';
	$errors = array('uname' => '', 'email' => '', 'password' => '', 'rpassword' => '');

	if(isset($_POST['submit'])) {

		// check username
		if(empty($_POST['uname'])) {
			$errors['uname'] = 'Username is required';
		} else {
			$uname = $_POST['uname'];
			if(!preg_match('/[a-zA-Z][a-zA-Z0-9-_]{3,15}/', $uname)) {
				$errors['uname'] = 'Must start with an alphabetic character. Can contain the following characters: a-z A-Z 0-9 - and _';
			}
		}

		// check email
		if(empty($_POST['email'])) {
			$errors['email'] = 'Email is required';
		} else {
			$email = $_POST['email'];
			if(!preg_match('/[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+/', $email)) {
				$errors['email'] = 'Email needs to be valid';
			}
		}

		// check password
		if(empty($_POST['password'])) {
			$errors['password'] = 'Password is required';
		} else {
			$password = $_POST['password'];
			if(!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/', $password)) {
				$errors['password'] = 'Minimum eight characters upto 15 characters, at least one upper case English letter, one lower case English letter, one number and one special character';
			}
		}

		// check retyped password
		if(empty($_POST['rpassword'])) {
			$errors['rpassword'] = 'Retype the password';
		} else {
			$rpassword = $_POST['rpassword'];
			if($rpassword != $password) {
				$errors['rpassword'] = "Password didn't matched";
			}
		}

		if(array_filter($errors)){
			// echo 'errors in the form';
		} else {
			$uname = mysqli_real_escape_string($conn, $_POST['uname']);
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);

			// create sql
			$sql = "INSERT INTO users(username, email, password) VALUES('$uname', '$email', '$password')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
			header('Location: index.php');
			} else {
				// error
				echo 'query error: ' . mysqli_error($conn);
			}

		}

	}// end of POST check

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<section class="container grey-text">
	<h4 class="center">Sign up!</h4>
	<form action="signup.php" method="POST" class="white">
		<label>Username</label>
		<input type="text" name="uname" value="<?php echo htmlspecialchars($uname) ?>">
		<div class="red-text"><?php echo $errors['uname']; ?></div>
		<label>Email</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
		<div class="red-text"><?php echo $errors['email']; ?></div>
		<label>Password</label>
		<input type="text" name="password" value="<?php echo htmlspecialchars($password) ?>">
		<div class="red-text"><?php echo $errors['password']; ?></div>
		<label>Retype Password</label>
		<input type="text" name="rpassword" value="<?php echo htmlspecialchars($rpassword) ?>">
		<div class="red-text"><?php echo $errors['rpassword']; ?></div>
		<div class="center">
			<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
		</div>
	</form>
</section>

<?php include('templates/footer.php') ?>

</html>