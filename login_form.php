<form method="post" action="login_check.php" >
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