<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataBases 🤓</title>
    <style>
        /* Your CSS styles here */
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

        
        
       

        
        $query = "SELECT DISTINCT `Artiest`, `Naam lied` FROM `verjaardagen`";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            echo "<h2>Favorite Songs</h2>";
            echo "<table>";
            echo "<tr><th>Artiest</th><th>Naam lied</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['Artiest'] . "</td><td>" . $row['Naam lied'] . "</td></tr>";
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

</body>
</html>
