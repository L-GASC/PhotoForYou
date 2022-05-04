<?php
if (!defined("COMMONS_FOLDER")) require_once "modules/site_rootfinder.php";
'//TODO: SECURITY: Check user credentials.
if (isset($_SESSION["login_status"])) {
	var_dump($_SESSION["login_status"]);
} else { 
	header("HTTP/1.1 401 Unauthorized");
	exit;
}';
try {
	$db = new PDO(
		"mysql:host=localhost:3306;dbname=photoforyou",
		"php", 
		file("../commons/php.sql")[0]
	);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $Exception ) {
	var_dump($Exception->getCode());
	var_dump($Exception->getMessage());
	?><strong class="error">
		Une erreur est survenue lors de la connection à la base d'authentication.
	</strong><?php
}
?>