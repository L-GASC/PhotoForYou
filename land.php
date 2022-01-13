<?php
	require_once "db_connect.php";
	$request = $db->query("SELECT * FROM users;");
	$requestRowCount = $db->query("SELECT count(*) FROM users;")->fetchColumn();
	#echo $request;
?>
<!DOCTYPE html>
<html>
<head>
	<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
		crossorigin="anonymous"
		'onerror="
			this.onerror=null;
			this.integrity=\"\";
			this.href=\"../commons/style.css\";
			console.error(\"Unable to Bootstrap\");
		"'
	>
	<link href="../commons/style.css" rel="stylesheet"/>
	<!--<style>* {background-color: var(--bs-dark);}</style>-->
</head>
<body>
	<?php require_once "header.php"; ?>
	<img src="Under_construction_animated.gif"/>
	<?php
		'for ($i = 0; $i < $requestRowCount; $i++) {
			#echo $line;
			foreach (/*array_filter(*/$line/*, function($i) {is_string($i);})*/ as $k => $v) {
				#if (typ)
				echo ( $k . $v . "<br/>");
			}
		}';
		
		var_dump($request->fetchAll());
	?>
	<?php require_once "footer.php"; ?>
	</body>
</html>