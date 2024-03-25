<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>buggy ahh website🐛</title>
</head>
<body>
    <?php
    $original_artist = $_GET['artist'] ?? '';
    $song_name = $_GET['song_name'] ?? '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_edit'])) {
        $host = 'localhost';
        $username = 'Jasper';
        $password = 'H5W/71Orhf!l*]]k';
        $database = 'databaseopdracht1';

        $connection = new mysqli($host, $username, $password, $database);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $edited_artist = $_POST['edited_artist'];
        $new_song_name = $_POST['song_name'];

       //debuggggg🐛
        echo "Original Artist: " . htmlspecialchars($original_artist) . "<br>";
        echo "Original Song: " . htmlspecialchars($song_name) . "<br>";
        echo "Edited Artist: " . htmlspecialchars($edited_artist) . "<br>";
        echo "New Song Name: " . htmlspecialchars($new_song_name) . "<br>";

        
        $sql = "UPDATE `verjaardagen` SET `Artiest` = '$edited_artist', `naam Lied` = '$new_song_name' WHERE `Artiest` = '$original_artist' AND `naam Lied` = '$song_name'";
        echo "SQL Query: " . htmlspecialchars($sql) . "<br>";

        
        if ($connection->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $connection->error;
        }

        $connection->close();

        
        header("Location: index.php");
        exit();
    }
    ?>

    <form method="post" action="">
        <label for="edited_artist">Edited Artist:</label><br>
        <input type="text" id="edited_artist" name="edited_artist" value="<?php echo htmlspecialchars($original_artist); ?>"><br>
        <label for="song_name">Song Name:</label><br>
        <input type="text" id="song_name" name="song_name" value="<?php echo htmlspecialchars($song_name); ?>"><br>
        <input type="submit" name="confirm_edit" value="Confirm Edit">
    </form>
</body>
</html>
