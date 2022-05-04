<header> <!--TODO: Better header-->
En t^te
<?php
/*// Back button
	var_dump ($_SERVER["REQUEST_URI"]);
	if ( !isset($_SESSION["last_pages"]) )
		$_SESSION["last_pages"] = [ $_SERVER["REQUEST_URI"] ];
	else if ( array_key_last($_SESSION["last_pages"]) !== $_SERVER["REQUEST_URI"] )
		array_push($_SESSION["last_pages"], $_SERVER["REQUEST_URI"]);
	else
		?><a href="<?php echo array_pop($_SESSION["last_pages"]); ?>">Retour</a>"<?
	var_dump ($_SESSION["last_pages"]);
//*/
#echo "get_included_files()"; var_dump(get_included_files());
if ( !isset($_SESSION["login_status"]) || $_SESSION["login_status"] !== "success" )
	require "login_form.php";
else {
	if (!isset($db)) require_once "db_connect.php";
	$stmt = $db->prepare("SELECT userRank FROM users WHERE email = :mail;");
	$stmt->bindParam(":mail", $_SESSION["id"]);
	$stmt->execute();
	$rank = $stmt->fetchColumn();
	var_dump ($rank);
	switch ($rank) {
		case "admin":
			?><a href="user_management.php">Gestion</a><?php
			break;

		case "photograph":
			?><a href="profile.php">Profile</a><?php
			break;
		
		default:
			?><em>Unrecognized rank!</em><?php
			break;
	}
}
#echo "get_included_files()"; var_dump(get_included_files());
?>
En f^te
</header>