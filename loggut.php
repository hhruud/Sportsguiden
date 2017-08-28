

<?php
//Ødlegger session, og sender deg tilbake på forsiden om du 
//trykker logg ut.

session_start();

session_destroy();
header("Location: forside.php");
?>
