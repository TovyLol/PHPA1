<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goedkope Apple Music</title>
    <style>
     
    </style>
</head>
<body>
 
    
    <?php
    $host = 'localhost';
    $username = 'Jasper';
    $password = 'H5W/71Orhf!l*]]k';
    $database = 'databaseopdracht1';


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_song'])) {
 
        $artist = $_POST['artist'];
        $song_name = $_POST['song_name'];

    
        $connection = new mysqli($host, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

   
        $sql = "INSERT INTO `verjaardagen` (`Artiest`, `naam Lied`) VALUES ('$artist', '$song_name')";

        if ($connection->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }

        $connection->close();
    }

   
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['clear_songs'])) {
        echo "All songs deleted successfully";
    
        $connection = new mysqli($host, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        
        $sql = "DELETE FROM `verjaardagen`";

        if ($connection->query($sql) === TRUE) {
            
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }

        $connection->close();
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
