<?php
$host = 'localhost';
$username = 'Jasper';
$password = 'H5W/71Orhf!l*]]k';
$database = 'databaseopdracht1';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_song'])) {
    $delete_id = $_POST['delete_id'] ?? '';
    $delete_artist = $_POST['artist'] ?? '';
    $delete_song_name = $_POST['song_name'] ?? '';

    try {
        $connection = new mysqli($host, $username, $password, $database);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $sql = "DELETE FROM `verjaardagen` WHERE `id` = '$delete_id'";

        if ($connection->query($sql) === TRUE) {
            
        } else {
            echo "Error deleting song: " . $connection->error;
        }

        $connection->close();
    } catch (Exception $e) {
        echo "<p>Error connecting to MySQL database: " . $e->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    
    
    <p><strong>Artist:</strong> <?php echo htmlspecialchars($delete_artist); ?></p>
    <p><strong>Song Name:</strong> <?php echo htmlspecialchars($delete_song_name); ?></p>
    <form method="post" action="index.php">
        <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($delete_id); ?>">
        <input type="hidden" name="artist" value="<?php echo htmlspecialchars($delete_artist); ?>">
        <input type="hidden" name="song_name" value="<?php echo htmlspecialchars($delete_song_name); ?>">
        <input type="submit" name="confirm_delete" value="Confirm Delete">
    </form>
</body>
</html>
