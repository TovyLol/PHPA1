<?php
    if (!isset($_POST["submit"])) {
        header("location: form.php");
    } else {
        echo "<h1> U heeft de volgende gegevens ingevuld:</h1>";
        echo "Naam: " . $_POST['firstname'] . " " . $_POST['surname']  . "<br>";
        echo "<br>";
        echo "<a href= \"form1.php\">Terug naar het formulier</a>";    
    }
?>
