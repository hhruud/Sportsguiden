<?php
		//Starter session funksjonen fra hjelpefunskjoner.php, samt sjekkinnlogging funksjon
		session_start();
		include_once("hjelpefunksjoner.php");
		sjekkInnlogging();
		$dblink = kobleOpp();



		// Lager variabler som blir hentet fra formen, brukeren skriver inn brukernavn og det nye passordet
		// Hvis opp = 1 blir spørringen om og oppdatere passordet gjort. Hvis ikke vil utførTekst melding komme
					$brukernavn = $_REQUEST['brukernavn'];
					$nyttPass   = $_REQUEST['passord'];
					$opp        = $_REQUEST["opp"];

					$nyttPass = mysqli_real_escape_string($dblink, $_REQUEST["passord"]);

		
		if ($opp == 1) {
    					$utførTekst = "Passordet er endret";
    					$sql         = "UPDATE Bruker SET passord='$nyttPass' WHERE brukernavn='$brukernavn'";
					} 		
		else {
    					$utførTekst = "IKKE ENDRET";
    					$sql         = "";
				}



		// Oppkobling til databassen, hvor spørringen blir spurt mot. Samt lukker oppkoblingen
					$dblink   = kobleOpp();
					$resultat = mysqli_query($dblink, $sql);
		
		if ($resultat)
    				$antallRader = mysqli_affected_rows($dblink);
		else
    				$antallRader = 0;



lukk($dblink);


// En html funskjon blir kalt, samt en kvittering om hvordan spørringen gikk(Passordet er endret/IKKE ENDRET)
toppreg();

	echo "
		<br><br><br><br>
		<div class=\"login\">
			<a href=\"regsend.php\" class=\"loginknapp\"> Legg til </a>
		</div>
		";

	print("<h2>Kvittering</h2>\n");
	print("<p><br><br>$utførTekst !</p>");

bunn();
?>