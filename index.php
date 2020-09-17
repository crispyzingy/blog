<?php

	include('config/db_connect.php');

	// write query for all posts
	$sql = 'SELECT title, content, id FROM posts ORDER BY created_at';

	// get the result set (set of rows)
	$result = mysqli_query($conn, $sql);

	// fetch the reulting rows as an array
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);

	// close connection
	mysqli_close($conn);

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<h4 class="center grey-text">Posts!</h4>

<div class="container">
	<div class="row">
		<?php foreach($posts as $post): ?>

		<div class="col s6 md3">
			<div class="card z-depth-0">
				<img src="img/code.svg" class="post">
				<div class="card-content center">
					<h6><?php echo htmlspecialchars($post['title']); ?></h6>
					<div><?php echo htmlspecialchars($post['content']); ?></div>
				</div>
				<div class="card-action right-align">
					<a href="details.php?id=<?php echo $post['id'] ?>" class="brand-text">more info</a>
				</div>
			</div>
		</div>

		<?php endforeach; ?>

	</div>
</div>

<?php include('templates/footer.php'); ?>

</html>