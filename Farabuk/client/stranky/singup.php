<!DOCTYPE html>
<html>
<head>
    <?php
    require_once __DIR__ . "/../../server/src/repository/ObecRepository.php";
    use flight\Engine;
    ?>
    <meta charset="UTF-8">
    <title>Registrace | Farabuk</title>
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
                $('.ui.form')
                    .form({
                        fields: {
                            // text: {
                            //     identifier  : 'nick',
                            //     rules: [
                            //         {
                            //             type   : 'empty',
                            //             prompt : 'Prosím, vložte své uživatelské jméno'
                            //         },
                            //     ]
                            // }
                            email: {
                                identifier  : 'email',
                                rules: [
                                    {
                                        type   : 'empty',
                                        prompt : 'Prosím, vložte svůj e-mail'
                                    },
                                    {
                                        type   : 'email',
                                        prompt : 'Prosím, vložte validní e-mail'
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
                                    {
                                        type   : 'length[10]',
                                        prompt : 'Vaše heslo musí mít aspoň 10 znaků'
                                    }

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
    <div class="column">
        <h2 class="ui blue image header">
            <div class="content">
                Registrace
            </div>
        </h2>
        <form action="makeRegister" method="post" class="ui large form">
            <div class="ui stacked segment">
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="nick" placeholder="Uživatelské jméno">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input type="text" name="email" placeholder="E-mail">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="heslo" placeholder="Heslo" required>
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input type="password" name="hesloZnova" placeholder="Heslo znova" required>
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="calendar icon"></i>
                        <input type="date" name="datumNarozeni" placeholder="Datum Narození" required>
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon input">
                        <i class="map icon"></i>
                        <select class="ui dropdown" name="obec">
                            <?php
                            $tmp=ObecRepository::readAll();
                            echo "<option value=''> Vyberte obec...</option>";
                            foreach ( $tmp as $item) {
                                echo "<option value='" . $item->id . "'> ". $item->nazev . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>


                <div class="ui fluid large blue submit button">Registrovat</div>
            </div>

            <div class="ui error message"></div>

        </form>

    </div>
</div>

</body>

</html>
