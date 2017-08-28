

<?php

// Sjekekr om brukernavnet som blir skrevet er riktig.
// Hvis bruker navn er feil. Feilmelding. Hvis riktig. inn på en ny side.

session_start();
include_once "hjelpefunksjoner.php";
$dblink = kobleOpp();
header('Content-Type: text/html; charset=utf-8');
 
 
$brukernavn = $_REQUEST['brukernavn'];
$passord = $_REQUEST['passord'];

$brukernavn = mysqli_real_escape_string($dblink, $_REQUEST['brukernavn']);
$passord = mysqli_real_escape_string($dblink, $_REQUEST['passord']);
 
 
if (!gyldigBruker($dblink, $brukernavn, $passord)) {
echo     ("<SCRIPT LANGUAGE='JavaScript'>
         window.alert('Feil brukernavn eller passord! prøv igjen.')
         window.location.href = 'login.php';
         </SCRIPT>");
 
}
    else {
         header("Location: regsend.php");
}
 $_SESSION['brukernavn'] = $brukernavn;
 
echo $_SESSION['brukernavn'];
?>