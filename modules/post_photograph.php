<?php
const PHOTO_INPUT_NAME = "photoUploads";
/// Octal TODO: SECURITY: Change permissions to an appropriate value.
const DIRECTORY_PERMISSIONS = 0777;

//TODO: SECURITY: Check user credentials.
if (isset($_SESSION["login_status"])) {
	var_dump($_SESSION["login_status"]);
} else { 
	header("HTTP/1.1 401 Unauthorized");
	exit;
}

/** TODOC
 * Undocumented function
 *
 * @param array $array the array to transpose
 * @param mixed $selectKey ???
 * @return array transpose of $array or $array if one of its values is not a subarray
 * @throws InvalidArgumentException if $array is not an array
 */
function array_transpose(array $array, $selectKey = false) {
	if ( !is_array($array) )
		throw new InvalidArgumentException("Can only transpose an array!");
	
	$return = array();
	foreach( $array as $key => $value ) {
		if ( !is_array($value) ) 
			return $array;
		if ( $selectKey ) {
			if ( isset($value[$selectKey]) )
				$return[] = $value[$selectKey];
		} else
			foreach ( $value as $key2 => $value2 )
				$return[$key2][$key] = $value2;
	}
	return $return;
} 

foreach ( $_FILES as $field => $file ) 
	$_FILES[$field] = array_transpose($file);
var_dump($_FILES);



//is_uploaded_file(fir§);
//move_uploaded_file();
var_dump(__DIR__);
var_dump($_SESSION);

$directory =
	__DIR__.DIRECTORY_SEPARATOR.
	"uploads".DIRECTORY_SEPARATOR.
	$_SESSION["id"].DIRECTORY_SEPARATOR.
	date("Y").DIRECTORY_SEPARATOR.
	date("m").DIRECTORY_SEPARATOR.
	date("d").DIRECTORY_SEPARATOR;
if (!is_dir($directory))
	mkdir($directory, DIRECTORY_PERMISSIONS, true);
foreach ( $_FILES["photoUploads"] as $index => $file ) {
	//TODO: SECURITY: Sanitize file name.
	$path =
		$directory.
		pathinfo($file["name"], PATHINFO_FILENAME).".".
		md5_file($file["tmp_name"]).".".
		pathinfo($file["name"], PATHINFO_EXTENSION)
	;
	var_dump($path);
	move_uploaded_file($file["tmp_name"], $path);
}
//move_uploaded_file(__DIR__ . "/uploads/" . date(DATE_W3C));*/
?>