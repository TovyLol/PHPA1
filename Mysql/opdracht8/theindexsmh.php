<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opdracht 8</title>
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
    </style>
</head>
<body>

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
    echo "<p>Connected successfully</p>";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['add_to_list'])) {
            $product = $_POST['product'];
            $web_name = $_POST['web_name'];
            $winkel = $_POST['winkel_name'];

            // website
            if (!preg_match("~^(?:f|ht)tps?://~i", $web_name)) {
                $web_name = "http://" . $web_name;
            } else {
                $web_name = "Couldnt ping the website you were looking for";
            }

            $sql = "INSERT INTO `verlanglijstje` (`product`, `Waar`, `Winkel`) VALUES ('$product', '$web_name', '$winkel')";

            if ($connection->query($sql) === TRUE) {
                echo "Successvol toegevoegd";
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
        } elseif (isset($_POST['verwijder_alles'])) {
            echo "Je hebt alles verwijdert";
            $sql = "DELETE FROM `verlanglijstje`";

            if ($connection->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
        }
    } 
    $query = "SELECT DISTINCT `product`, `Waar`, `Winkel` FROM `verlanglijstje`";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        echo "<h2></h2>";
        echo "<table>";
        echo "<tr><th>product</th><th>Waar</th><th>Winkel</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['product'] . "</td><td><a href='" . $row['Waar'] . "'>" . $row['Waar'] . "</a></td><td>" . $row['Winkel'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Je lijstje is leeg Voeg iets toe!</p>";
    }
    $connection->close();
} catch (Exception $e) {
    echo "<p>Error connecting to MySQL database: " . $e->getMessage() . "</p>";
}
?>

<form method="POST">
    <label for="product">Product:</label><br>
    <input type="text" id="product" name="product"><br>
    <label for="Webadres">Webadres :</label><br>
    <input type="text" id="Webadres" name="web_name"><br>
    <label for="winkel_name">Winkel Naam:</label><br>
    <input type="text" id="winkel" name="winkel_name"><br><br>
    <input type="submit" name="add_to_list" value="Voeg toe">
</form>

<form method="POST">
    <input type="submit" name="verwijder_alles" value="Verwijder Alles">
</form>

</body>
</html>
