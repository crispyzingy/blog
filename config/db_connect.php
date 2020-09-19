<?php

// connect to database
$conn = mysqli_connect('remotemysql.com', 'sBn4EmvzvQ', 'U0jDwcxFCZ', 'sBn4EmvzvQ');
// $conn = mysqli_connect('localhost', 'arbaaz', 'test1234', 'blog');

// check connection
if(!$conn){
	echo 'Connection error: '.mysqli_connect_error();
}

?>