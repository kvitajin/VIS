<!DOCTYPE html>
<html>
<head>
    <?php
    use flight\Engine;
    ?>
    <meta charset="UTF-8">
    <title>Přihlášení | Farabuk</title>
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
    <div class="column">
        <h2 class="ui blue image header">
            <div class="content">
                Přihlášte se
            </div>
        </h2>
        <form action="makeLogin" method="post" class="ui large form">
            <div class="ui stacked segment">
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
                <div class="ui fluid large blue submit button">Přihlásit</div>
            </div>

            <div class="ui error message"></div>

        </form>

        <div class="ui message">
            Nemáte účet? <a href="registrace">Registrujte se</a>
        </div>
    </div>
</div>

</body>

</html>
