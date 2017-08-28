  
  <?php

  // Her får innloggede muligheter for følgende:
  // Legg til sending, Endre passord på en bruker
  // og slette en bruker. Det blir opprettet parametere
  // fra databassen som igjen blir brukt opp mot den brukeren skriver inn i form. 
  // Dette blir så brukt til spørring om mot databassen. 
  session_start();
  include_once("hjelpefunksjoner.php");
  sjekkInnlogging();
    

  if (isset($_GET["Sending"])) {
    $Sending = $_GET["Sending"];
    $dblink = kobleOpp();
    $Sendinger = hentSendinger($dblink, $Sending);
    $Start = $Sendinger["Starter"];
    $Slutt = $Sendinger["Slutter"];
    $Kanal = $Sendinger["Kanal_Kanal"];
    $Gren = $Sendinger["Sport_Gren"];
    $Liga = $Sendinger["Sport_Liga"];


    $Sending = mysqli_real_escape_string($dblink, $_REQUEST["Sending"]);
  }
  else {
    $Sending = "";
    $Starter = "";
    $Slutter = "";
    $Kanal = "";
    $Gren = "";
    $Liga = "";
  }


  if (isset($_GET["brukernavn"])) {
    $brukernavn = $_GET["brukernavn"];
    $dblink = kobleOpp();
    $Bruker = hentBruker($dblink, $brukernavn);
    $nyttPass = $bruker["passord"];
    
    $brukernavn = mysqli_real_escape_string($dblink, $_REQUEST["brukernavn"]);

  }
  else {
    $brukernavn = "";
    $nyttPass = "";
  }
  

toppregsend();

// Første form Legg til sendinger, bruker php skripte utfor, som har en spørring i seg til å legg til sendinger i 
// Databassen. Så da skriver bruker inn hvilke inndata han ønsker også får han svar om det er godkjent inndata eller ikke.
// Det samme gjelder de 2 siste formene bare med en anderledes action. endre_passord og slett_bruker
 echo"
        <div class=\"overdel\">
            <button id = \"toggle\">Legg til sending</button>
                <div class=\"target\" style=\"display: none; \">
                    <form method=\"POST\" action=\"utfor.php\">
                      <table>
                          <tr>
                          <td>Sending:</td>
                          <td><input type=\"text\" name=\"Sending\" size=\"60\" value = \"$Sending\" /></td>
                          </tr>
                          <tr>
                          <td>Start:</td>
                          <td><input type=\"text\" name=\"Starter\" size=\"30\" value = \"$Starter\" /></td>
                          </tr>
                          <tr>
                          <td>Slutt:</td>
                          <td><input type=\"text\" name=\"Slutter\" size=\"30\" value = \"$Slutter\" /></td>
                          </tr>
                          <tr>
                          <td>Kanal:</td>
                          <td><input type=\"text\" name=\"Kanaler_Kanal\" size=\"30\" value = \"$Kanal\" /></td>
                          </tr>
                          <tr>
                          <td>Gren:</td>
                          <td><input type=\"text\" name=\"Sport_Gren\" size=\"30\" value = \"$Gren\" /></td>
                          </tr>
                          <tr>
                          <td>Liga:</td>
                          <td><input type=\"text\" name=\"Sport_Liga\" size=\"30\" value = \"$Liga\" /></td>
                          </tr>
                      </table>
                      <div class=\"radioknapper\">
                      Godkjenn?<input type=\"radio\" name=\"operasjon\" value=\"1\" /> &nbsp;&nbsp;&nbsp;
                          <input type=\"submit\" value=\"Utfør\" name=\"btnSend\" />
                      </div>
                </form>
            </div>
      </div>
  


      <div class=\"overdel\">
        <button id = \"toggle2\">Endre passord</button>
          <div class=\"target2\"style=\"display: none; \">
            <form method=\"POST\" action=\"endre_passord.php\">
              
              <table>
                <tr>
                <td>Brukernavn:</td>
                <td><input type=\"text\" name=\"brukernavn\" size=\"30\" value = \"$brukernavn\" /></td>
                </tr>
                <tr>
                <td>Nytt Passord:</td>
                <td><input type=\"password\" name=\"passord\" size=\"30\" value = \"$nyttPass\" /></td>
                </tr>
              </table>

              <div class=\"radioknapper\">
               Godkjenn?<input type=\"radio\" name=\"opp\" value = \"1\" /> &nbsp;&nbsp;&nbsp;
                <input type=\"submit\" name=\"btnSend\" value = \"Utfør\" />
              </div>

            </form>
          </div>
    </div>




    <div class=\"overdel\">
      <button id = \"toggle3\">Slett Bruker</button>
        <div class=\"target3\"style=\"display: none; \">

          <form method=\"POST\" action=\"slett_bruker.php\">
            <table>
              <tr>
              <td>Brukernavn:</td>
              <td><input type=\"text\" name=\"brukernavn\" size=\"30\" value = \"$brukernavn\" /></td>
              </tr>
            </table>
            <div class=\"radioknapper\">
             Godkjenn? <input type=\"radio\" name=\"opp\" value=\"1\" /> &nbsp;&nbsp;&nbsp;
              <input type=\"submit\" value=\"Utfør\" name=\"btnSend\" />
            </div>

          </form>
        </div>
    </div>
";



  

  
  bunn();
  ?>