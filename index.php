<!DOCTYPE html>
<html>
<head>
	<!--<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
		crossorigin="anonymous"
	>-->
	<link href="../commons/style.css" rel="stylesheet"/>
	<!--<style>* {background-color: var(--bs-dark);}</style>-->
</head>
<?php
	if (!defined("COMMONS_FOLDER")) require_once "modules/site_rootfinder.php";
	if (!defined("MODULES_FOLDER")) require_once "site_rootfinder.php";
	if (!isset($db)) require_once MODULES_FOLDER."/db_connect.php";
	
	/**
	 * Pirate should not know which field it guessed right.\
	 * This constant is used to ensure that the failure messages stay identical.
	 */
	const AUTHENTIFICATION_FAILURE_MESSAGE = 
		"Authentication failed. Check that you entered your identifier and password correctly.";
	const AUTHENTIFICATION_UNFOUND_MESSAGE = 
		"Identifier not found in user table. Check that it is typed correctly or use it to register a new account";
	
	#$request = $db->query("SELECT * FROM users;");
	#$requestRowCount = $db->query("SELECT count(*) FROM users;")->fetchColumn();
	
	#var_dump($request);
	#var_dump($_SESSION["login_status"]);
	if (isset($_SESSION["login_status"])) {
		// TODO: Better method to tell the user.
		switch ($_SESSION["login_status"]) {
			case "failure":
				?><strong><?php echo AUTHENTIFICATION_FAILURE_MESSAGE;?></strong>"<?php
				break;

			case "unfound":
				?><strong><?php echo AUTHENTIFICATION_UNFOUND_MESSAGE?></strong><?php
				break;

			default:
				var_dump ($_SESSION["login_status"]);
				//FIXME: Do not name variables in the output!
				?><em><strong>Error: </strong>Unknown <code>login_status</code>!</em>";<?php
				break;
		}
	}
?>
<body>
	<?php require_once MODULES_FOLDER."/header.php"; ?>
	<img src="Under_construction_animated.gif"/>
	<?php
		'for ($i = 0; $i < $requestRowCount; $i++) {
			#echo $line;
			foreach (/*array_filter(*/$line/*, function($i) {is_string($i);})*/ as $k => $v) {
				#if (typ)
				echo ( $k . $v . "<br/>");
			}
		}';
		
		#var_dump($request->fetchAll(PDO::FETCH_ASSOC));
	?>
	<?php require_once "modules/footer.php"; ?>
	</body>
</html>