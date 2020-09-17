<?php

	include('config/db_connect.php');


	$title = $content = '';
	$errors = array('title' => '', 'content' => '');

	if(isset($_POST['submit'])) {

		// check title
		if(empty($_POST['title'])) {
			$errors['title'] = 'Title is required';
		} else {
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)) {
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}

		// check content
		if(empty($_POST['content'])) {
			$errors['content'] = 'Content is required';
		} else {
			$content = $_POST['content'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $content)) {
				$errors['content'] = 'Content must be letters and spaces only';
			}
		}

		if(array_filter($errors)){
			// echo 'errors in the form';
		} else {
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$content = mysqli_real_escape_string($conn, $_POST['content']);

			// create sql
			$sql = "INSERT INTO posts(title, content) VALUES('$title', '$content')";

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
	<h4 class="center">New Post</h4>
	<form action="add.php" method="POST" class="white">
		<label>Title</label>
		<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
		<div class="red-text"><?php echo $errors['title']; ?></div>
		<label>Content</label>
		<input type="text" name="content" value="<?php echo htmlspecialchars($content) ?>">
		<div class="red-text"><?php echo $errors['content']; ?></div>
		<div class="center">
			<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
		</div>
	</form>
</section>

<?php include('templates/footer.php') ?>

</html>