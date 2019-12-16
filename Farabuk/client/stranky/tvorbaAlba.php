<!DOCTYPE html>
<html>
<head>
    <?php
    require_once __DIR__ . "/../../server/src/repository/ObecRepository.php";
    require_once __DIR__ . "/../../server/src/repository/AlbumRepository.php";

    use flight\Engine;

    ?>
    <meta charset="UTF-8">
    <title>Tvorba dokumentu | Farabuk</title>
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
                            email: {
                                identifier  : 'email',
                                rules: [
                                    {
                                        type   : 'empty',
                                        prompt : 'Prosím, vložte e-mail'
                                    },
                                    {
                                        type   : 'email',
                                        prompt : 'Prosím, vložte platný e-mail'
                                    }
                                ]
                            },
                            password: {
                                identifier  : 'heslo',
                                rules: [
                                    {
                                        type   : 'empty',
                                        prompt : 'Prosím, vložte heslo'
                                    },

                                ]
                            }
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
        <form action="makeAlbum" method="post" class="ui form">
            <div class="ui stacked segment">
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
                    '<label>Obce pro které je album určeno</label>'.
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
