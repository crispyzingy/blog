<?php

// connect to database
$conn = mysqli_connect('remotemysql.com', 'sBn4EmvzvQ', 'U0jDwcxFCZ', 'sBn4EmvzvQ');

// check connection
if(!$conn){
	echo 'Connection error: '.mysqli_connect_error();
}

?>