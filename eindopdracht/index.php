<?php
function getRandomKleur() {
    $colors = array('#1aff1a', '#00bfff', '#ff8000', '#8000ff', '#00ffbf', '#ff4d94', '#4dd2ff', '#66d9ff', '#a64dff', '#ff4d4d', '#b3b300', '#ff3385');
    return $colors[array_rand($colors)];
}

function getRandomPl() {
    $plaatjes = array('1.png', '2.png', '3.png', '4.png', '5.png', '6.png', '7.png');
    return $plaatjes[array_rand($plaatjes)];
}

function getDices($index) {
    $dices = array('dice1.png', 'dice2.png', 'dice3.png', 'dice4.png', 'dice5.png', 'dice6.png');
    return $dices[$index];
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Gokken op een higher level</title>
    <link rel="stylesheet" href="index.css"> 
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: linear-gradient(#66b3ff, white);
            
        }

        .container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            max-width: 600px;
            width: 100%;
            padding: 10px;
        }

        .block-container {
            position: relative;
            width: 100%;
            padding-bottom: 100%; 
        }

        .block, .pic {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .pic {
            width: 70%;
            height: 70%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .block {
            z-index: 1;
        }

        .pic {
            z-index: 2;
            background-size: cover;
            background-position: center;
        }
        .dices {
            width: 70px;
            height: 70px;
            
        }
        .button {
            width: 1000px;
            height: 1000px;
        }
    
        .text {
            text-align: center;
            color: black;
        }
        .highlight {
            background-color: yellow; 
        }
        .tltitle {
            text-align: center;
            size: 30px;
            margin-right: 50px;
        }
        .tltekst {
            text-align: center;
            margin-right: 50px;
        }


                
    </style>
</head>
<body>
    
    
    <form method="post" action="">
        <button type="submit" name="submit">Dobbelen</button>
        <button type="submit" name="reset">Renew</button>
    </form>
    <div class="container">
        <?php
        
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["submit"])) {
            $diceX = rand(0, 5);
            $diceY = rand(0, 5);
        
            for ($i = 0; $i < 6; $i++) {
                for ($j = 0; $j < 6; $j++) {
                    $plaatje = getRandomPl();
                    $samenKomen = ($i == $diceX && $j == $diceY); 
            
                    echo "<div class='block-container'>";
            
                    if ($samenKomen) {
                        echo "<div class='block' style='background-color: red;'></div>";
                    } elseif ($i == $diceX || $j == $diceY) {
                       
                        echo "<div class='block' style='background-color: purple;'></div>";
                    } else {
                        
                        $color = getRandomKleur();
                        echo "<div class='block' style='background-color: $color;'></div>";
                    }
                    
                    echo "<div class='pic' style='background-image: url($plaatje);'></div>";
                    echo "</div>";
                    


                
                    
                }
            }
            
            
            
            $truedicex = $diceX + 1;
        $truedicey = $diceY + 1;
        if ($truedicex > 6) {
            $truedicex = 6;
        }
        if ($truedicey > 6) {
            $truedicey = 6;
        }
        echo "<p class='text'>Dit heb je gerold: $truedicex/$truedicey</p>";

            //dit breekt als er 7 wordt gerold
            // update t is gefixed


            for ($a = 0; $a < 2; $a++) {
                $diceIndex = ($a == 0) ? $diceX : $diceY;
                $dice = getDices($diceIndex);
                echo "<img class='dices' src='$dice' alt=''>";
            }
        }
        

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['reset'])) {
            for ($i = 0; $i < 6; $i++) {
                for ($j = 0; $j < 6; $j++) {
                    $color = getRandomKleur();

                    echo "<div class='block-container";
                    
                    echo "'>";
                    echo "<div class='block' style='background-color: $color;'></div>";
                    echo "<div class='pic' style='background-image: url(resetpic.png);'></div>";
                    echo "</div>";
                }
            }
        }
        ?>
    </div>
</body>
</html>