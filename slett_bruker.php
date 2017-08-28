<?php

//Her blir uføringen av det som skjer i regsend til. Sjekker først innloggingen til brukeren
// For Så og kjøre spørringen. Om spørringen er vellykket Bruker er slettet,
// hvis spørringen er feil, bruker er ikke slettet.
session_start();
include_once("hjelpefunksjoner.php");
sjekkInnlogging();
$dblink = kobleOpp();

$brukernavn = $_REQUEST['brukernavn'];
$opp = $_REQUEST["opp"];

$brukernavn = mysqli_real_escape_string($dblink, $_REQUEST['brukernavn']);
  

if ($opp == 1) {
  $utførTekst = "Bruker er slettet ";
  $sql = "DELETE FROM `Bruker` WHERE brukernavn = '$brukernavn'";
}

else {
  $utførTekst = "Brukere er ikke slettet";
  $sql = "";
}

// Utfør spørring mot databasen
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
print("<p><br><br>$antallRader $utførTekst !</p>");

bunn();
?>