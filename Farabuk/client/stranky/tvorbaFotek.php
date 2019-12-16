<!DOCTYPE html>
<html>
<head>
    <?php
    require_once __DIR__ . "/../../server/src/repository/ObecRepository.php";
    require_once __DIR__ . "/../../server/src/repository/AlbumRepository.php";
    require_once __DIR__ . "/../../server/src/repository/FotoRepository.php";


    use flight\Engine;

    ?>
    <meta charset="UTF-8">
    <title>Tvorba fotek | Farabuk</title>
    <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/fomantic-ui@2.8.2/dist/semantic.min.css">
    <script src="https://unpkg.com/fomantic-ui@2.8.2/dist/semantic.min.js"></script>


    <style type="text/css">
        body {
            background-color: #DADADA;
        }
        body > .grid {
            height: 100%;
        }
        .image {
            margin-top: -100px;
        }
        .column {
            max-width: 450px;
        }
    </style>
    <script>
        $(document)
            .ready(function() {
                $('.ui.dropdown')
                    .dropdown()
                ;

                $('.ui.form')
                    .form({
                        fields: {

                        }
                    })
                ;
            })
        ;
    </script>
</head>
<body>

<div class="ui middle aligned center aligned grid">
    <div class="column wide">
        <h2 class="ui blue header">
            <div class="content">
                Tvorba alba
            </div>
        </h2>
        <form action="makeFoto" method="post" class="ui form" enctype="multipart/form-data">
            <div class="ui stacked segment">
                <div class="field">
                    <label>Fotografie k zařazení do alba</label>
                        <input name="fotky[]" type="file" multiple="multiple" class="ui image input"/>
                </div>
                <?php
                $tmp=AlbumRepository::readAll();
                echo '<div class="field">'.
                    '<label>Album, pro které jsou fotografie určeno</label>'.
                    '<select  name="album" class="ui search selection dropdown">';
                        echo    '<option value=""></option>';
                        foreach ($tmp as $item) {
                        echo '<option value="'. $item->id.'">'. $item->nazev.'</option>';
                        }
                        echo ' </select>'.
                    ' </div>';

                ?>
                <div class="field">
                    <label> Dál vyplňujte jen pokud chcete vytvořit nové album</label>

                </div>
                <br>
                <div class="field">
                    <label >Název alba</label>
                    <div class="ui left icon input">
                        <i class="pencil icon"></i>
                        <input type="text" name="nazev" placeholder="Název alba">
                    </div>
                </div>
                <?php
                $tmp=ObecRepository::readAll();
                echo '<div class="field">'.
                    '<label>Obce, pro které je album určeno</label>'.
                    '<select  name="obec" class="ui search selection dropdown">';
                echo    '<option value=""></option>';
                foreach ($tmp as $item) {
                    echo '<option value="'. $item->id.'">'. $item->nazev.'</option>';
                }
                echo ' </select>'.
                    ' </div>';

                ?>


                <div class="ui fluid large blue submit button">Vytvořit</div>
            </div>

            <div class="ui error message"></div>

        </form>

    </div>
</div>

</body>

</html>
