<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>  
    <meta charset="utf-8">
    <title></title>  
    <style media="screen">
        * {font-size: 5px;}
    </style> 
</head>
<body>
    <?php
        define("STEP", 5);
        define("ANGLE", 60);

        $rgb = array(ANGLE, 0, 0);
        $delta_rgb = array(
            array(0, 1, 0),
            array(-1, 0, 0),
            array(0, 0, 1),
            array(0, -1, 0),
            array(1, 0, 0 ),
            array(0, 0, -1),
        );

        for ($angle=0; $angle < 720; $angle += STEP) {
            $lenght = (int)($angle / 10 * (10 + sin(deg2rad($angle))));
            for ($c=0; $c < count($rgb); $c++) {
                $rgb[$c] += STEP * $delta_rgb[intdiv($angle,ANGLE)%6][$c];
            }
            $color = "rgb(" . (int)(255 * $rgb[0] / ANGLE) . ", " . (int)(255 * $rgb[1] / ANGLE). ", " . (int)(255 * $rgb[2] / ANGLE) . ")";
            echo "<hr width=\"$lenght\" size=\"4\" style=\"color:$color;border-color:$color;background-color:$color\">"; 
        }
    ?>
</body>
</html>