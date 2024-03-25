<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>  
    <meta charset="utf-8">
    <title></title>  
    <style media="screen">
        div {
            display: inline-block;
            height: 100px;
            width: 100px;
            border: 1px solid black;
            margin: 5px;
        }
    </style> 
</head>
<body>
    <?php
        for ($corner=0; $corner < 60; $corner += 10) {
            echo "<div style= \"border-radius:". $corner . "px\"></div>";
        }
    ?>
</body>
</html>