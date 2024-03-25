<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opdracht 6</title>
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
        if (isset($_POST['add_song'])) {
            $id = $_POST['id'];
            $artist = $_POST['artist'];
            $song_name = $_POST['song_name'];

            $sql = "INSERT INTO `verjaardagen` (`id`, `Artiest`, `naam Lied`) VALUES ('$id', '$artist', '$song_name')";

            if ($connection->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
        } elseif (isset($_POST['clear_songs'])) {
            echo "All songs deleted successfully";
            $sql = "DELETE FROM `verjaardagen`";

            if ($connection->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
        } elseif (isset($_POST['delete_song'])) {
            echo "!";
        } elseif (isset($_POST['confirm_delete'])) {
            echo "Deleted";
        }
    } 
    $query = "SELECT DISTINCT `id`, `Artiest`, `Naam lied` FROM `verjaardagen`";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        echo "<h2></h2>";
        echo "<table>";
        echo "<tr><th>id</th><th>Artiest</th><th>Naam lied</th><th>Edit</th><th>Delete</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['Artiest'] . "</td><td>" . $row['Naam lied'] . "</td><td>
            <form method='GET' action='editstuff.php'>
            <input type='hidden' name='id' value='" . $row['id'] . "'>
            <input type='hidden' name='artist' value='" . $row['Artiest'] . "'>
            <input type='hidden' name='song_name' value='" . $row['Naam lied'] . "'>
            <input type='submit' value='Edit'>
            </form>
            </td>
            <td>
            <form method ='POST' action='confirm.php'>
            <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
            <input type='hidden' name='artist' value='" . $row['Artiest'] . "'>
            <input type='hidden' name='song_name' value='" . $row['Naam lied'] . "'>
            <input type='submit' name='delete_song' value='Delete'>
            </form>
            </td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No songs found</p>";
    }
    $connection->close();
} catch (Exception $e) {
    echo "<p>Error connecting to MySQL database: " . $e->getMessage() . "</p>";
}



?>
<form method="POST">
    <label for="artist">Artist:</label><br>
    <input type="text" id="artist" name="artist"><br>
    <label for="song_name">Song Name:</label><br>
    <input type="text" id="song_name" name="song_name"><br><br>
    <input type="submit" name="add_song" value="Add Song">
</form>
<form method="POST">
    <input type="submit" name="clear_songs" value="Clear All Songs">
</form>
</body>
</html>
