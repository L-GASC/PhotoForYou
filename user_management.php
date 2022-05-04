<?php
/** TODO: SECURITY Check user rights to view this page. */
//TODO: SECURITY: Check user credentials.
if (isset($_SESSION["login_status"])) {
	var_dump($_SESSION["login_status"]);
} else { 
	header("HTTP/1.1 401 Unauthorized");
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	TODO: IMPLEMENT The user management panel
</body>
</html>