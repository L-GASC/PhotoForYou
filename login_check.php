<?php
require_once "db_connect.php";
require_once 'session.php';

/**
 * BCRYPT hashes into 60 characters.
 * 
 * DEFAULT may update as better hashing becomes possible.
 * Stored into varchar(255) in case the algorithm changes.
 */
const PASSWORD_HASH_ALGORITHM = PASSWORD_DEFAULT;
const PASSWORD_HASH_OPTIONS = array(/*'cost' => 10*/);
#var_dump(PASSWORD_HASH_OPTIONS);

/**
 * Pirate should not know which field it guessed right.
 * This constant is used to ensure that the failure messages stay identical.
 */
const AUTHENTIFICATION_FAILURE_MESSAGE = 'Authentication failed. Check that you entered your identifier and password correctly.';

if (isset($_POST["mail"]) and isset($_POST["pw"])) {
	$mail = htmlentities($_POST["mail"]);
	$password = $_POST["pw"];
	$regis = isset($_POST['register']) ? $_POST['register'] : false;
	#var_dump($regis);
	#echo "get_include_path()"; var_dump(get_include_path());
	#echo "get_included_files()"; var_dump(get_included_files());
	#echo "count(get_included_files())"; var_dump(count(get_included_files()));
	#echo "$ _SERVER"; var_dump($_SERVER);
	#echo "$ _SERVER[\"SCRIPT_FILENAME\"]"; var_dump($_SERVER["SCRIPT_FILENAME"]);
	
	# Check if user already exists
	$select = "SELECT passHash FROM users WHERE email = :email;";
	$sStmt = $db->prepare($select, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sStmt->bindParam(":email", $mail);
	#var_dump($sStmt);
	$sStmt->execute();
	/** sResult
	 * Hash string if found, false otherwise.
	 */
	$sResult = $sStmt->fetchColumn();
	#var_dump($sResult);
	$passHash = password_hash($password, PASSWORD_HASH_ALGORITHM, PASSWORD_HASH_OPTIONS);
	if (!is_bool($sResult)) { // User exists
		#var_dump($password);
		#var_dump(password_hash($password, PASSWORD_HASH_ALGORITHM, PASSWORD_HASH_OPTIONS));
		// Login
		#TODO: Better Errors
		if (password_verify($password, $sResult)) {
			#echo "Logging-in as \"$mail\"...";
			#TODO: SECURITY - use password_needs_rehash()
			if (password_needs_rehash($sResult, PASSWORD_HASH_ALGORITHM, PASSWORD_HASH_OPTIONS)) {
				$uStmt = $db->prepare("UPDATE `users` SET `passHash` = :passHash WHERE (`email` = :email)");
				$uStmt->bindParam(":email", $mail);
				$uStmt->bindParam(":passHash", $passHash);
				$uStmt->execute();
				#echo "Password rehashed.";
			}
			// TODO: Actual login
			$_SESSION["login_status"] = "success";
			#echo $_SERVER["PHP_SELF"];
			header("Location: land.php");
		} else {
			if ($regis == "on") {
				// TODO: IMPLEMENT: Tell the user
				#echo "User \"$mail\" already exist!";
			}
			else {
				// TODO: IMPLEMENT: Tell the user
				#echo AUTHENTIFICATION_FAILURE_MESSAGE;
				$_SESSION["login_status"] = "failure";
				header("Location: land.php");
			}
		}
	} else { // User not found
		if ($regis == "on") { // Registration
			if (isset($_POST["repw"])) { // Has repw
				if ($_POST["repw"] == $password) { // Successfull repw
					$insert = "INSERT INTO users(`email`, `passHash`, `rank`) VALUES (:email, :passHash, 'user');";
					$iStmt = $db->prepare($insert, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					$iStmt->bindParam(":email", $mail);
					$iStmt->bindParam(":passHash", $passHash);
					$iStmt->execute();
					// TODO: IMPLEMENT: Tell the user
					#echo "Registration attempt";
				} else { // Bad repw
					// TODO: IMPLEMENT: Tell the user
					#echo "Error: Password does not match its confirmation!";
					#echo "<script>console.error( \"Error: Password does not match its confirmation!\" )</script>";
				}
			} else { // No repw
				//TODO: IMPLEMENT: Tell the user
				#echo "Error: password confirmation must be given!";
				#echo "<script>console.error(\"Error: password confirmation must be given!\")</script>";
			}
		} else { // Login
			// TODO: IMPLEMENT: Tell the user
			#echo AUTHENTIFICATION_FAILURE_MESSAGE;
			$_SESSION["login_status"] = "unfound";
			header("Location: land.php");
		}
	}
}
?>
This page is for checking the login credentials.<br/>
You should not be there, as once checks are done this page is supposed to redirect you back to where you were headed.