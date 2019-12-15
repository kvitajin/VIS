<!DOCTYPE html>
<html>
<head>
    <?php
    require_once __DIR__ . "/../../server/src/repository/ObecRepository.php";
    require_once __DIR__ . "/../../server/src/repository/DruhDokumentuRepository.php";
    require_once __DIR__ . "/../../server/src/repository/KategorieDokumentuRepository.php";

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
                Tvorba dokumentu
            </div>
        </h2>
        <form action="makeDokument" method="post" class="ui form">
            <div class="ui stacked segment">
                <div class="field">
                    <label >Nadpis</label>
                    <div class="ui left icon input">
                        <i class="pencil icon"></i>
                        <input type="text" name="nadpis" placeholder="Nadpis">
                    </div>
                </div>
                <div class="field">
                    <label>Podnadpis</label>
                    <div class="ui left icon input">
                        <i class="pencil icon"></i>
                        <input type="text" name="podnadpis" placeholder="Podnadpis">
                    </div>
                </div>
                <div class="field">
                    <label>Uri</label>
                    <div class="ui left icon input">
                        <i class="code icon"></i>
                        <input type="text" name="uri" placeholder="uri">
                    </div>
                </div>
                <div class="field">
                    <label class="left">Obsah dokumentu</label>

                    <div class="ui left icon input">
                        <textarea name="obsah" > Obah dokumentu</textarea>
                        <i class="pencil icon"></i>
                    </div>
                </div>
                <?php
                $tmp=ObecRepository::readAll();
                echo '<div class="field">'.
                        '<label>Obce pro které je dokument určen</label>'.
                        '<select multiple="" name="obec[]" class="ui search selection dropdown">';
                foreach ($tmp as $item) {
                    echo '<option value="'. $item->id.'">'. $item->nazev.'</option>';
                }
                echo ' </select>'.
                ' </div>';

                $tmpDruh=DruhDokumentuRepository::readAll();
                echo '<div class="field">'.
                        '<label>Druh</label>'.
                        '<select name="druh" class="ui search selection dropdown">';
                foreach ($tmpDruh as $item) {
                    echo '<option value="'. $item->id.'">'. $item->nazev.'</option>';
                }
                echo ' </select>'.
                ' </div>';

                $tmpKategorie=KategorieDokumentuRepository::readAll();
                echo '<div class="field">'.
                        '<label>Kategorie</label>'.
                        '<select  name="kategorie" class="ui search selection dropdown">';
                foreach ($tmpKategorie as $item) {
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
