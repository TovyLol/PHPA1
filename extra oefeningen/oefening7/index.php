<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Gokken is goed voor je</title>
    <link rel="stylesheet" href="index.css">

    <style>
        .pics {
            width: 100px;
            height: auto;
            margin: 10px;
        }
        .aantal-container {
            margin-top: 20px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            margin-left: 340px;
            margin-right: 340px;
            border-radius: 5px;
            border-color: white;;
            
            
        }

        .aantal {
            font-size: 18px;
            margin: 5px;
            display: inline-block;
            
        }
    </style>
</head>

<body>
    <div>
        <?php
        session_start();

        
        if (!isset($_SESSION['diceaantallen'])) {
            $_SESSION['diceaantallen'] = array(0, 0, 0, 0, 0, 0);
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["submit"])) {
            for ($i = 0; $i < 5; $i++) {
                $randompic = mt_rand(1, 6);
                $_SESSION['diceaantallen'][$randompic - 1]++; 
                echo("<img class=\"pics\" src=\"dice$randompic.png\">");
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["reset"])) {
           
            $_SESSION['diceaantallen'] = array(0, 0, 0, 0, 0, 0);

            for ($i = 0; $i < 5; $i++) {
                echo("<img class=\"pics\" src=\"Resetpic.png\">");
            }
        }

        
        
        ?>
        <form method="post">
            <input class="button" type="submit" name="submit" value="OK">
            <input class="button" type="submit" name="reset" value="Reset">
        </form>
        <div class="aantal-container">
            <?php
           
            for ($i = 0; $i < 6; $i++) {
                echo "<span class=\"aantal\">Dice " . ($i + 1) . " count: " . $_SESSION['diceaantallen'][$i] . "</span>";
            }
            ?>
        </div>
    </div>
</body>

</html>
