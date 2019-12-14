<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Farabuk biatch</title>
    <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/fomantic-ui@2.8.2/dist/semantic.min.css">
    <script src="https://unpkg.com/fomantic-ui@2.8.2/dist/semantic.min.js"></script>
    <?php
    include __DIR__ . "/../server/src/repository/ObecRepository.php";
    ?>
</head>
<body>
<?php
    $tmp=ObecRepository::readAll();
?>
<br>
<h1 class="ui center aligned header">Obce zapojené do projektu</h1>
<div class="ui text container">
    <div class="center aligned ui vertical menu ">

        <?php
        foreach ($tmp as $item) {
            echo '<a href="localhost:8000/'.$item->uri . '" class="item">
            '. $item->nazev.' 
            </a>';
        }
        ?>
    </div>
</div>
</body>
</html>