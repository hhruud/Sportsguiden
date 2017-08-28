<?php
// Laget vår egen parameter for oppkobling utenfor web-treet.
include_once "c:\\xampp\\htdocs\\sportsguiden\\includes\\globals.php";


///////////////////////////////////////////////////////////////////////////////////////////

// Etablerer forbindelse til databasen

function kobleOpp() {
  $dblink = mysqli_connect(TJENER, BRUKER, PASSORD, DB);
  if (!$dblink) {
    die('Klarte ikke å koble til databasen: ' . mysql_error($dblink));
  }
  mysqli_set_charset($dblink, 'utf8');
  return $dblink;
}


///////////////////////////////////////////////////////////////////////////////////////////

// Html function for toppen av siden til forsiden.

function toppforside() {
 echo" 
 <!DOCTYPE html>
 <html>
      <head>
          <meta charset=\"utf-8\">
          <title>Sportsguiden</title>
          <link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\">
      </head>
 
 <body>

      <div class=\"login\">
          <a href=\"login.php\" class=\"loginknapp\"> Logg Inn </a>
      </div>

  <header>
      <h1> Sportsguiden </h1>
  </header>
  
  <section>
        <div>
            <form action=\"forside.php\" method=\"post\">
              <input type=\"text\" size=\"45\" name=\"valueToSearch\" class=\"search\" placeholder=\"Her kan du søke etter Sportsgrener, lag, kanaler etc\"><br><br>
              <input type=\"submit\" name=\"search\" value=\"Søk\">
              <input type=\"submit\" name=\"reset\" value=\"Nullstill\">
            </form>    
        </div>
 ";
}

///////////////////////////////////////////////////////////////////////////////////////////

// Html funksjon som er på toppen av forsiden dersom man er innlogget 

function toppinnlogg() {
 echo" 
      <!DOCTYPE html>
      <html>
          <head>
              <meta charset=\"utf-8\">
              <title>Sportsguiden</title>
              <link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\">
          </head>
            
          <body>

              <div class=\"login\">
                <a href=\"regsend.php\" class=\"loginknapp\"> Legg til </a>
                <br><br>
                <a href=\"loggut.php\" class=\"loginknapp\"> Loggut </a>
              </div>

        <header>
            <h1> Sportsguiden </h1>
        </header>
  
        <section>
          <div>
              <form action=\"forside.php\" method=\"post\">
                <input type=\"text\" size=\"45\" name=\"valueToSearch\" class=\"search\" placeholder=\"Her kan du søke etter Sportsgrener, lag, kanaler etc\"><br><br>
                <input type=\"submit\" name=\"search\" value=\"Søk\">
                <input type=\"submit\" name=\"reset\" value=\"Nullstill\">
              </form>    
          </div>
      ";
  }


/////////////////////////////////////////////////////////////////////////////////////////////

// Html funksjon for toppen av loggin siden.

function topploggin() {
  echo "
        <!DOCTYPE html>
        <html>
          <head>
              <title>Sportsguiden</title>
  
              <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
              <meta charset=\"UTF-8\" />
          </head>
  
        <body>

            <div class=\"login\">
              <a href=\"forside.php\" class=\"tilForsiden\"> Til Forsiden </a>
            </div>
  ";
}


///////////////////////////////////////////////////////////////////////////////////////////

// En html funskjon som har et javascript, grunnen scriptet er her og ikke i egen fil,
// er fordi det blei feil når vi skulle gjenta funnksjonen på siden. Gikk å gjøre det 2 ganger.
// Scriptet blir brukt til å få html objektene i den passordbeskytende delen en fin inngang.

function toppregsend() {
  echo "<!DOCTYPE html>
  <html>
    <head>
      <title>Sportsguiden</title>
      <script type = \"text/javascript\" 
      src = \"http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js\"></script>
    
      <script type = \"text/javascript\" language = \"javascript\">
   
         $(document).ready(function() {
            $(\"#toggle\").click(function(){
               $(\".target\").toggle('slow', function(){
                 $(\".log\").text('');
               });
            });
         
            $(\"#toggle2\").click(function(){
               $(\".target2\").toggle('slow', function(){
                 $(\".log\").text('');
               });
            });

            $(\"#toggle3\").click(function(){
               $(\".target3\").toggle('slow', function(){
                 $(\".log\").text('');
               });
            });
         });
      </script>


      <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
      <meta charset=\"UTF-8\" />
    
    </head>
  
  <body>

    <div class=\"login\">
      <a href=\"loggut.php\" class=\"utlogging\"> Logg Ut </a>
      <br><br>
      <a href=\"forsidelogg.php\" class=\"tilForsiden\"> Til Forsiden </a>
    </div>
  ";
}

///////////////////////////////////////////////////////////////////////////////////////////

// Html funksjon for topppen av sidene etter du har uttført redigering, 
// oppdatering eller sletting av inndata i databassen.

function toppreg() {
  echo "
  <!DOCTYPE html>
  <html>
    <head>
      <title>Sportsguiden</title>
      <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
      <meta charset=\"UTF-8\" />
    </head>
  
  <body>

    <div class=\"login\">
      <a href=\"loggut.php\" class=\"utlogging\"> Logg Ut </a>
      <br><br>
      <a href=\"forsidelogg.php\" class=\"tilForsiden\"> Til Forsiden </a>
    </div>
  ";
}

/////////////////////////////////////////////////////////////////////////////////////////////

//Funksjon som kobler seg opp til databassen og spørr om å hente ut alt av inndata i
//Tabellen sendinger, Som blir vist i tabellen på forsiden.

function visTabell($query)  {
  $kobleOpp = mysqli_connect("db-kurs.hit.no", "v16gr5", "pw5", "v16grdb5");
  $kobleOpp->set_charset('utf8');
  $filter_Result = mysqli_query($kobleOpp, $query);

  return $filter_Result;
}

if(isset($_POST['search']))
{
  $valueToSearch = $_POST['valueToSearch'];
            
  $query = "SELECT * FROM `Sendinger` 
  WHERE CONCAT(`Sending`, `Starter`, `Slutter`, `Sport_Gren`, Sport_Liga, Kanaler_Kanal)
  LIKE '%".$valueToSearch."%'";
  $search_result = visTabell($query);

}
else {

  $query = "SELECT * FROM `Sendinger`";
  $search_result = visTabell($query);

}


///////////////////////////////////////////////////////////////////////////////////////////

//Sjekker om bruker er gyldig, ved og sjekke brukernavn og passord opp 
// mot tabellen bruker fra databassen

function gyldigBruker($dblink, $brukernavn, $passord) {
  $sql = "SELECT * FROM Bruker " .
  "WHERE brukernavn = '$brukernavn' AND " .
  "passord = '$passord';";
  $resultat = mysqli_query($dblink, $sql);
  $antall = mysqli_num_rows($resultat);
  if ($antall == 1) {
    $rad = mysqli_fetch_array($resultat, MYSQL_ASSOC);
    $_SESSION['bnr'] = $rad['Bnr'];
    $_SESSION['brukernavn'] = $rad['brukernavn'];
    $_SESSION['passord'] = $rad['passord'];

    return true;
  }
  else {
    return false;
  }
}


///////////////////////////////////////////////////////////////////////////////////

// Sjekker om bruker er logget inn,
// og redirigerer til innloggingsside hvis ikke.

function sjekkInnlogging() {
  if ($_SESSION != null){
    $navn = $_SESSION['brukernavn'];
    print("<h3>Velkommen, du er logget inn som $navn!</h3>");
  }else
  header("Location: forside.php");
}




///////////////////////////////////////////////////////////////////////////////////////////

// En enkel html funksjon med to slutt tager.

function bunn() {
  echo "

  </body>
  </html>";
}





///////////////////////////////////////////////////////////////////////////////////////////

// Lukker databassen etter oppkobling

function lukk($dblink) {
  mysqli_close($dblink);
}
