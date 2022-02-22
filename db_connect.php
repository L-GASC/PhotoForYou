<?php
try {
	$db = new PDO("mysql:host=localhost:3306;dbname=photoforyou", "php", file("../commons/php.sql")[0]);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $Exception ) {
	echo ( $Exception->getCode( ) . $Exception->getMessage( ) );# . file("../commons/php.sql")[0] );
}
?>