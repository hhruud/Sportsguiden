

<?php

// Fill krever brukernavn og passord fra bruker
// og bruker sjekk.php for å se om det bruker skriver
// stemmer opp mot databassen.

session_start();
include_once "hjelpefunksjoner.php";
$dblink =  kobleOpp();

topploggin();
?>
<h2>Innlogging</h2>
<br><br><br>
<div id="innlogging">
	<form method="POST" action="sjekk.php">
		<table border="0" width="50%">
			<tr>
				<td>Brukernavn:</td>
				<td><input type="text" name="brukernavn" size="40"></td>
			</tr>
			<tr>
				<td>Passord:</td>
				<td><input type="password" name="passord" size="10"></td>
			</tr>
		</table>
		<p>
			<input type="submit" value="Logg inn" name="sendKnapp">
			<input type="reset" value="Rensk skjema" name="renskKnapp">
		</p>
	</form>
</div>

</body>
</html>