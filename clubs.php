<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht van Clubs</title>
    <style>
        /* Stijl voor de hele pagina */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        /* Container voor de tabel */
        .container {
            width: 80%;
            max-width: 1200px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333333;
            text-align: center;
        }
        /* Tabelstijl */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #dddddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        tr:nth-child(even) td {
            background-color: #f1f1f1;
        }
        tr:hover td {
            background-color: #ddd;
        }
        .error-msg {
            color: #e74c3c;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Overzicht van Alle Clubs</h2>

    <?php
    // Databasegegevens
    $servername = "localhost";
    $username = "sport"; // Jouw gebruikersnaam
    $password = "sportpw"; // Jouw wachtwoord
    $dbname = "SportclubsDB"; // Jouw database naam

    // Verbinding maken met de database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Controleer de verbinding
    if ($conn->connect_error) {
        die("<p class='error-msg'>Verbinding mislukt: " . $conn->connect_error . "</p>");
    }

    // SQL-query om alle clubs op te halen
    $sql = "SELECT * FROM clubs";
    $result = $conn->query($sql);

    // Controleer of er clubs zijn
    if ($result->num_rows > 0) {
        // Tabel om de clubs weer te geven
        echo "<table>";
        echo "<tr><th>Club ID</th><th>Naam</th><th>Locatie</th><th>Sportsoort</th><th>Oprichtingsjaar</th><th>Aantal Leden</th></tr>";

        // Loop door alle clubs en toon de gegevens in de tabel
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['club_id'] . "</td>";
            echo "<td>" . $row['naam'] . "</td>";
            echo "<td>" . $row['locatie'] . "</td>";
            echo "<td>" . $row['sportsoort'] . "</td>";
            echo "<td>" . $row['oprichtingsjaar'] . "</td>";
            echo "<td>" . $row['aantal_leden'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p class='error-msg'>Geen clubs gevonden.</p>";
    }

    // Sluit de verbinding
    $conn->close();
    ?>
</div>

</body>
</html>
