<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Een leuke website</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="">
        <form method="post" action="index.php">
            <label for="omrekenen">Reken hier je temperatuur om!</label>
            <input type="text" name="omrekenen" placeholder="Voer hier in" required>
            <input type="submit" name="submit" value="OK">
        </form>
        <p class="info">De som die gebruikt is: F = (C * 9/5) + 32</p>

        <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["omrekenen"])) {
                $celsius = $_POST["omrekenen"];
                $fahrenheit = ($celsius * 9/5) + 32;
                echo "<p class='antwoord'>{$celsius} graden celsius is gelijk aan {$fahrenheit} graden fahrenheit</p>";
            }
        }
        ?>
    </div>
</body>

</html>
