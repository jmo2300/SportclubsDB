<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht van Leden</title>
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
    <h2>Overzicht van Alle Leden</h2>

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

    // SQL-query om alle leden op te halen
    $sql = "SELECT * FROM leden";
    $result = $conn->query($sql);

    // Controleer of er leden zijn
    if ($result->num_rows > 0) {
        // Tabel om de leden weer te geven
        echo "<table>";
        echo "<tr><th>Lid ID</th><th>Naam</th><th>Geboortedatum</th><th>Geslacht</th><th>Straat</th><th>Huisnummer</th><th>Postnummer</th><th>Plaats</th><th>Inschrijving</th><th>Uitschrijving</th><th>Club ID</th></tr>";

        // Loop door alle leden en toon de gegevens in de tabel
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['lid_id'] . "</td>";
            echo "<td>" . $row['naam'] . "</td>";
            echo "<td>" . $row['geboortedatum'] . "</td>";
            echo "<td>" . $row['geslacht'] . "</td>";
            echo "<td>" . $row['straat'] . "</td>";
            echo "<td>" . $row['huisnummer'] . "</td>";
            echo "<td>" . $row['postnummer'] . "</td>";
            echo "<td>" . $row['plaats'] . "</td>";
            echo "<td>" . $row['inschrijving'] . "</td>";
            echo "<td>" . $row['uitschrijving'] . "</td>";
            echo "<td>" . $row['club_id'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p class='error-msg'>Geen leden gevonden.</p>";
    }

    // Sluit de verbinding
    $conn->close();
    ?>
</div>

</body>
</html>
