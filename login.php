<?php
/**
 * This hashes into 60 characters.
 * Stored into varchar(255) in case the algorithm changes.
 */
const PASSWORD_ALGORITHM = PASSWORD_BCRYPT;

require_once "db_connect.php";
#session_start();
#echo $_POST['mail'];
echo "$ _POST"; var_dump($_POST);
if (isset($_POST["mail"]) and isset($_POST["pw"])) {
	$mail = htmlentities($_POST["mail"]);
	$password = $_POST["pw"];
	$regis = isset($_POST['register']) ? $_POST['register'] : false;
	var_dump($regis);
	#echo "get_include_path()"; var_dump(get_include_path());
	#echo "get_included_files()"; var_dump(get_included_files());
	#echo "count(get_included_files())"; var_dump(count(get_included_files()));
	#echo "$ _SERVER"; var_dump($_SERVER);
	#echo "$ _SERVER[\"SCRIPT_FILENAME\"]"; var_dump($_SERVER["SCRIPT_FILENAME"]);
	
	# Check if user already exists
	$select = "SELECT passHash FROM users WHERE email = :email;";
	$sStmt = $db->prepare($select, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	echo $sStmt->bindParam(":email", $mail);
	var_dump($sStmt);
	$sStmt->execute();
	$sResult = $sStmt->fetchColumn();
	var_dump($sResult); //passHash?
	if ($sResult) { // passHash \! User exists
		var_dump($password);
		var_dump(password_hash($password, PASSWORD_ALGORITHM));
		// Login
		#TODO: Better Errors
		if (password_verify($password, $sResult)) {
			echo "Logging-in as \"$mail\"...";
			#TODO: SECURITY - use password_needs_rehash()
		} else {
			if ($regis == "on") echo "User \"$mail\" already exist!";
			else echo "Authentification failed.";
		}
	} else { // User not found
		if ($regis == "on") { // Registration
			if (isset($_POST["repw"])) { // Has repw
				if ($_POST["repw"] == $password) { // Successfull repw
					$passHash = password_hash($password, PASSWORD_ALGORITHM);
					$insert = "INSERT INTO users(`email`, `passHash`, `rank`) VALUES (:email, :passHash, 'user');";
					$iStmt = $db->prepare($insert, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					$iStmt->bindParam(":email", $mail);
					$iStmt->bindParam(":passHash", $passHash);
					$iStmt->execute();
					echo "Registration attempt";
				} else {
					echo "Error: Password does not match its confirmation!";
					/*echo "<script>console.error(
						\"Error: Password does not match its confirmation!
					\")</script>";*/
				}
			} else {
				echo "Error: password confirmation must be given!";
				//echo "<script>console.error(\"Error: password confirmation must be given!\")</script>";
			}
		} else echo "Authentification failed.";
	}
}
?>
<form method="post" action="" >
	<fieldset>
		<legend>Identify</legend>
		<label>email<input id="mail" type="email" name="mail" required /></label> <br/>
		<label>password<input id=password type="password" name="pw" required /></label> <br/>
	</fieldset>
	<label><input type="checkbox" name="register" /> Register?</label> <br/>
	<fieldset name="registration">
		<?php #if (!isset($sResult) or !$sResult) { //Why? ?>
			<label>password confirm
				<input
					id="repw"
					type="password"
					name="repw"
					autocomplete="new-password"
					title="Re-enter password to confirm"
					onbeforeinput="this.pattern = document.getElementById('password').value;"
					required
				/>
			</label> <br/>
		<?php #} ?>
	</fieldset>
	<input type="submit"/>
		<script type="text/javascript">
			(function() { //Boundary to avoid interfering with other scripts
				let form = document.currentScript.parentNode;
				console.log(form.elements);
				form.elements.register.onchange = togRegFie;
				function togRegFie() {
					form.elements.registration.disabled = !form.elements.register.checked;
					form.elements.registration.hidden = !form.elements.register.checked;
				};
				togRegFie();
			})();
		</script>
		<!--<script type="text/javascript">console.log(form);//Interference example</script>-->
</form>