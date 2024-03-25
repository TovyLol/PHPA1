<?php
$host = 'localhost';
$username = 'Jasper';
$password = 'H5W/71Orhf!l*]]k';
$database = 'databaseopdracht1';

try {
    $connection = new mysqli($host, $username, $password, $database);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['add_person'])) {
     
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $birthday = $_POST['birthday'];

        
            $query = "INSERT INTO `eindopdracht` (`Voor_naam`, `Achter_naam`, `Verjaardag`) VALUES ('$firstname', '$lastname', '$birthday')";
            if ($connection->query($query) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $query . "<br>" . $connection->error;
            }
        } elseif (isset($_POST['delete_all'])) {
            $sql = "DELETE FROM `eindopdracht`";
        }
    } 

    $query = "SELECT DISTINCT `Voor_naam`, `Achter_naam`, `Verjaardag` FROM `eindopdracht`";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        echo "<h2></h2>";
        echo "<table>";
        echo "<tr><th>Voornaam</th><th>Achternaam</th><th>Verjaardag</th><th>Hoe oud nu?</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $geboortedatum = new DateTime($row['Verjaardag']);
            $vandaag = new DateTime();
            $age = $geboortedatum->diff($vandaag);

            $agestring = $age->y . ' jaar, ' . $age->m . ' maanden en ' . $age->d . ' dagen oud';
            
            echo "<tr><td>" . $row['Voor_naam'] . "</td><td>" . $row['Achter_naam'] . "</td><td>" . $row['Verjaardag'] . "</td><td>" . $agestring . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Voeg iemand toe!</p>";
    }

    $connection->close();
} catch (Exception $e) {
    echo "<p>Error connecting to MySQL database: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eindopdracht !1!!!</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .dontstandout {
            text-align: right;
        }
    </style>
</head>
<body>
<h1>Eindopdracht</h1>

<form method="POST">
    <label for="firstname">Voornaam:</label><br>
    <input type="text" id="firstname" name="firstname"><br>
    <label for="lastname">Achternaam:</label><br>
    <input type="text" id="lastname" name="lastname"><br>
    <label for="birthday">Verjaardag:</label><br>
    <input type="date" id="birthday" name="birthday"><br><br>
    <input type="submit" name="add_person" value="Voeg Persoon Toe">
</form>

<form method="POST">
    <input type="submit" name="delete_all" value="Verwijder Alles">
</form>

</body>
</html>
