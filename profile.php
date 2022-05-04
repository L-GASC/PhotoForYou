<?php
const MAX_FILE_SIZE = 2 * 1024 * 1024;

//TODO: SECURITY: Check user credentials.
if (isset($_SESSION["login_status"])) {
	var_dump($_SESSION["login_status"]);
} else { 
	header("HTTP/1.1 401 Unauthorized");
	exit;
}
?>
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
</head>
<body>
	<h1>User profile</h1>
	<form enctype="multipart/form-data" method="post" action="post_photograph.php">
		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
		<label>
			Upload photographs: 
			<input type="file" name="photoUploads[]" multiple required/>
		</label>
		<input type="submit" /></>
	</form>
</body>
</html>