<?php
define("SITE_FOLDER", pathinfo(__DIR__)["dirname"]);
define("MODULES_FOLDER", SITE_FOLDER."/modules");
var_dump(SITE_FOLDER);
#unset (SITE_ROOT);
?>