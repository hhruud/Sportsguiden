
<?php
// Dette er en annen forside for de som er innlogget.
// Har en sjekkonnlogging funskjon som sjekker om man er innlogget
// Og en toppinnlogg funksjon som viser alternativene loggut, og legg til


session_start();
include_once "hjelpefunksjoner.php";
sjekkInnlogging();
$kobleOpp = visTabell($query);
toppinnlogg();
?>


    <table>
         <tr>
            <th>Sendinger</th>
            <th>Gren</th>
            <th>Liga</th>
            <th>Starter</th>
            <th>Slutter</th>
            <th>Kanaler</th>
        </tr>


    <!-- Henter kollonnenavn og putter det i tabellform-->
    <?php while($row = mysqli_fetch_array($search_result)):?>
    <tr>
        <td><?php echo $row['Sending'];?></td>
        <td><?php echo $row['Sport_Gren'];?></td>
        <td><?php echo $row['Sport_Liga'];?></td>
        <td><?php echo $row['Starter'];?></td>
        <td><?php echo $row['Slutter'];?></td>
        <td><?php echo $row['Kanaler_Kanal'];?></td>

    </tr>
<?php endwhile;?>
</table>
</section>

</body>
</html>


