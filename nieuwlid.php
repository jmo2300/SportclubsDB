<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lid Toevoegen - Sportclubs</title>
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
        /* Flex container voor formulier en cluboverzicht */
        .container {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }
        /* Container voor het formulier */
        .form-container, .clubs-container {
            background-color: #ffffff;
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            color: #333333;
            text-align: center;
        }
        /* Stijl voor de inputvelden */
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            color: #555555;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #dddddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        /* Stijl voor de knop */
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .success-msg {
            color: #4CAF50;
            font-weight: bold;
            text-align: center;
        }
        .error-msg {
            color: #e74c3c;
            font-weight: bold;
            text-align: center;
        }
        /* Stijl voor het clubs-overzicht */
        .clubs-container h2 {
            margin-bottom: 10px;
            text-align: center;
            color: #333333;
        }
        .club {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        .club p {
            margin: 5px 0;
            color: #555555;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="form-container">
        <h2>Nieuw Lid Toevoegen</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Databasegegevens
            $servername = "localhost";
            $username = "sport";
            $password = "sportpw";
            $dbname = "SportclubsDB";

            // Verbinding maken met de database
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Controleer de verbinding
            if ($conn->connect_error) {
                die("<p class='error-msg'>Verbinding mislukt: " . $conn->connect_error . "</p>");
            }

            // Gegevens uit het formulier ophalen
            $naam = $_POST['naam'];
            $geboortedatum = $_POST['geboortedatum'];
            $geslacht = $_POST['geslacht'];
            $straat = $_POST['straat'];
            $huisnummer = $_POST['huisnummer'];
            $postnummer = $_POST['postnummer'];
            $plaats = $_POST['plaats'];
            $inschrijving = $_POST['inschrijving'];
            $uitschrijving = !empty($_POST['uitschrijving']) ? $_POST['uitschrijving'] : NULL;
            $club_id = $_POST['club_id'];

            // SQL-query om het lid toe te voegen
            $stmt = $conn->prepare("INSERT INTO leden (naam, geboortedatum, geslacht, straat, huisnummer, postnummer, plaats, inschrijving, uitschrijving, club_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssi", $naam, $geboortedatum, $geslacht, $straat, $huisnummer, $postnummer, $plaats, $inschrijving, $uitschrijving, $club_id);

            // Uitvoeren van de query
            if ($stmt->execute()) {
                echo "<p class='success-msg'>Lid succesvol toegevoegd!</p>";
            } else {
                echo "<p class='error-msg'>Fout bij het toevoegen van het lid: " . $stmt->error . "</p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
        <!-- Formulier voor het toevoegen van een lid -->
        <form method="post" action="">
            <div class="form-group">
                <label for="naam">Naam</label>
                <input type="text" id="naam" name="naam" required>
            </div>
            <div class="form-group">
                <label for="geboortedatum">Geboortedatum</label>
                <input type="date" id="geboortedatum" name="geboortedatum" required>
            </div>
            <div class="form-group">
                <label for="geslacht">Geslacht</label>
                <select id="geslacht" name="geslacht">
                    <option value="M">Man</option>
                    <option value="V">Vrouw</option>
                    <option value="Overig">Overig</option>
                </select>
            </div>
            <div class="form-group">
                <label for="straat">Straat</label>
                <input type="text" id="straat" name="straat" required>
            </div>
            <div class="form-group">
                <label for="huisnummer">Huisnummer</label>
                <input type="text" id="huisnummer" name="huisnummer" required>
            </div>
            <div class="form-group">
                <label for="postnummer">Postnummer</label>
                <input type="text" id="postnummer" name="postnummer" required>
            </div>
            <div class="form-group">
                <label for="plaats">Plaats</label>
                <input type="text" id="plaats" name="plaats" required>
            </div>
            <div class="form-group">
                <label for="inschrijving">Inschrijving</label>
                <input type="date" id="inschrijving" name="inschrijving" required>
            </div>
            <div class="form-group">
                <label for="uitschrijving">Uitschrijving</label>
                <input type="date" id="uitschrijving" name="uitschrijving">
            </div>
            <div class="form-group">
                <label for="club_id">Club ID</label>
                <input type="text" id="club_id" name="club_id" required>
            </div>
            <button type="submit" class="submit-btn">Lid Toevoegen</button>
        </form>
    </div>

    <!-- Div voor het overzicht van bestaande clubs -->
    <div class="clubs-container">
        <h2>Overzicht Clubs</h2>
        <?php
        // Haal alle clubs op uit de database
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("<p class='error-msg'>Verbinding mislukt: " . $conn->connect_error . "</p>");
        }

        $clubQuery = "SELECT club_id, naam, locatie, sportsoort FROM clubs";
        $clubResult = $conn->query($clubQuery);

        if ($clubResult->num_rows > 0) {
            while ($club = $clubResult->fetch_assoc()) {
                echo "<div class='club'>";
                echo "<p><strong>ID:</strong> " . $club["club_id"] . "</p>";
                echo "<p><strong>Naam:</strong> " . $club["naam"] . "</p>";
                echo "<p><strong>Locatie:</strong> " . $club["locatie"] . "</p>";
                echo "<p><strong>Sportsoort:</strong> " . $club["sportsoort"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p class='error-msg'>Geen clubs gevonden.</p>";
        }

        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
