<?php
session_start();
?>
<header>
En t^te
<?php

#echo "get_included_files()"; var_dump(get_included_files());
require "login.php";
#echo "get_included_files()"; var_dump(get_included_files());
?>
En f^te
</header>