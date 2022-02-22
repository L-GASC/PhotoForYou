<?php
const MAX_FILE_SIZE = 2 * 1024 * 1024;
?>
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
</head>
<body>
	<form enctype="multipart/form-data" method="post" action="post_photograph.php">
		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
		<input type="file" name="photoUploads" multiple />
		<input type="submit" /></>
	</form>
</body>
</html>