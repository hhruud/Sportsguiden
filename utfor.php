<?php

//Her blir uføringen av det som skjer i regsend til. Sjekker først innloggingen til brukeren
// For Så og kjøre spørringen. Om spørringen er vellykket. Kommer vellykket innsetting og en kvittering,
// På det man har skrevet inn i formen.
// hvis spørringen feil, bruker er ikke slettet.
include_once("hjelpefunksjoner.php");
session_start();
sjekkInnlogging();
$dblink = kobleOpp();

$Sending=$_REQUEST["Sending"]; 
$Starter=$_REQUEST["Starter"]; 
$Slutter=$_REQUEST["Slutter"]; 
$Kanal=$_REQUEST["Kanaler_Kanal"]; 
$Gren = $_REQUEST["Sport_Gren"];
$Liga = $_REQUEST["Sport_Liga"];
$operasjon = $_REQUEST["operasjon"];

$Sending = mysqli_real_escape_string($dblink, $_REQUEST['Sending']);


if ($operasjon == 1) {
	$utførTekst = "satt inn";
	$sql = "INSERT INTO Sendinger(Sending, Starter, Slutter, Kanaler_Kanal, Sport_Gren, Sport_Liga)".
	"VALUES('$Sending','$Starter','$Slutter','$Kanal','$Gren','$Liga');";
}

else {
	$utførTekst = "IKKE SATT INN!";
	$sql = "";
}

$dblink = kobleOpp();
$resultat = mysqli_query($dblink, $sql);

if ($resultat)
	$antallRader = mysqli_affected_rows($dblink);
else
	$antallRader = 0;

lukk($dblink);
toppreg();

echo"
<br><br><br><br>
<div class=\"login\">
<a href=\"regsend.php\" class=\"loginknapp\"> Legg til </a>
</div>
";

print("<h2>Kvittering</h2>\n");
print("<br><br><br><br>");
print("<p>Sending: $Sending</p>");
print("<p>Starter: $Starter</p>");
print("<p>Slutter: $Slutter</p>");
print("<p>Kanal: $Kanal</p>");
print("<p>Gren: $Gren</p>");
print("<p>Liga: $Liga</p>");
print("<p></p>\n");
print("<p><b>$antallRader rad(er) er $utførTekst !</b></p>");

bunn();
?>
