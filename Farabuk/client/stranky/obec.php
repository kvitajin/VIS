<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
    use flight\Engine;
    require_once __DIR__ . "/../../server/src/repository/ObecRepository.php";
    $uri=Flight::get('obec');
    $_SESSION['obec']=$uri;
    $obec=ObecRepository::readUri($uri);
    ?>
    <meta charset="UTF-8">





    <title><?php echo $obec->nazev;?> | Farabuk</title>
    <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/fomantic-ui@2.8.2/dist/semantic.min.css">
    <script src="https://unpkg.com/fomantic-ui@2.8.2/dist/semantic.min.js"></script>


    <style type="text/css">

    .hidden.menu {
    display: none;
    }

    .masthead.segment {
    min-height: 700px;
    padding: 1em 0em;
    }
    .masthead .logo.item img {
    margin-right: 1em;
    }
    .masthead .ui.menu .ui.button {
    margin-left: 0.5em;
    }
    .masthead h1.ui.header {
    margin-top: 3em;
    margin-bottom: 0em;
    font-size: 4em;
    font-weight: normal;
    }
    .masthead h2 {
    font-size: 1.7em;
    font-weight: normal;
    }

    .ui.vertical.stripe {
    padding: 8em 0em;
    }
    .ui.vertical.stripe h3 {
    font-size: 2em;
    }
    .ui.vertical.stripe .button + h3,
    .ui.vertical.stripe p + h3 {
    margin-top: 3em;
    }
    .ui.vertical.stripe .floated.image {
    clear: both;
    }
    .ui.vertical.stripe p {
    font-size: 1.33em;
    }
    .ui.vertical.stripe .horizontal.divider {
    margin: 3em 0em;
    }

    .quote.stripe.segment {
    padding: 0em;
    }
    .quote.stripe.segment .grid .column {
    padding-top: 5em;
    padding-bottom: 5em;
    }

    .footer.segment {
    padding: 5em 0em;
    }

    .secondary.pointing.menu .toc.item {
    display: none;
    }

    @media only screen and (max-width: 700px) {
    .ui.fixed.menu {
    display: none !important;
    }
    .secondary.pointing.menu .item,
    .secondary.pointing.menu .menu {
    display: none;
    }
    .secondary.pointing.menu .toc.item {
    display: block;
    }
    .masthead.segment {
    min-height: 350px;
    }
    .masthead h1.ui.header {
    font-size: 2em;
    margin-top: 1.5em;
    }
    .masthead h2 {
    margin-top: 0.5em;
    font-size: 1.5em;
    }
    }


    </style>
    <script>
        $(document)
            .ready(function() {

                // fix menu when passed
                $('.masthead')
                    .visibility({
                        once: false,
                        onBottomPassed: function() {
                            $('.fixed.menu').transition('fade in');
                        },
                        onBottomPassedReverse: function() {
                            $('.fixed.menu').transition('fade out');
                        }
                    })
                ;

                // create sidebar and attach to menu open
                $('.ui.sidebar')
                    .sidebar('attach events', '.toc.item')
                ;

            })
        ;
    </script>
</head>



</head>
<body>

<div class="ui large top fixed hidden menu">
    <div class="ui container">
        <a class="active item">Domů</a>
        <a class="item">Dokumenty</a>
        <a class="item">Alba</a>
        <div class="right menu">
            <?php
            if(!isset($_SESSION["mail"])){?>
                <div class="item">
                    <a href="prihlaseni" class="ui primary icon button">Přihlásit se  </a>
                </div>
                <div class="item">
                    <a href="registrace" class="ui button">Registrovat</a>
                </div>
                <?php
            }
            else{?>
                <div class="item">
                    <a class="ui primary icon button"><?php echo $_SESSION['nick'];?>  </a>

                </div>

            <?php
            }
            ?>
        </div>
    </div>x
</div>

<!-- Sidebar Menu -->
<div class="ui blue vertical inverted sidebar menu">
    <a class="active item">Domů</a>
    <a class="item">Dokumenty</a>
    <a class="item">Alba</a>
    <?php
    if(!isset($_SESSION["mail"])){?>
        <a href="prihlaseni" class="item">Přihlásit se</a>
        <a href="registrace" class="item">Registrovat</a>
        <?php
    }else{?>
        <div class="item">
            <a class="ui primary icon button"><?php echo $_SESSION['nick'];?>  <i class="dropdown icon"></i>  </a>
        </div>
        <?php
    }
    ?>
</div>


<!-- Page Contents -->
<div class="pusher">
    <div class="ui blue inverted vertical masthead center aligned segment">

        <div class="ui container">
            <div class="ui large secondary inverted pointing menu">
                <a class="toc item">
                    <i class="sidebar icon"></i>
                </a>
                <a class="active item">Domů</a>
                <a class="item">Dokumenty</a>
                <a class="item">Alba</a>
                <div class="right item">
                    <?php
                    if(!isset($_SESSION["mail"])){?>
                        <a href="prihlaseni" class="ui inverted button">Přihlásit se</a>
                        <a href="registrace" class="ui inverted button">Registrovat</a>
                    <?php
                    }
                    else{?>

                        <a class="ui primary icon button"><?php echo $_SESSION['nick'];?> <i class="dropdown icon"></i></a>
                        <?php
                    }
                    ?>

                </div>

            </div>
        </div>
        <?php

        ?>
        <img src="erb" class="ui image left spaced floated ">

        <div class="ui text container">
            <h1 class="ui inverted header">
                Farabuk
            </h1>
            <h2>Farní stránky římskokatolické církve obce <?php echo $obec->nazev;?></h2>
        </div>

    </div>

    <div class="ui vertical stripe segment">
        <div class="ui text container">
            <div class="row">
                <div class="eight wide column">
                    <h3 class="ui header">Drazí čtenáři</h3>
                    <p>Pokud se nezblázním z tohoto, tak už snad z ničeho. S pozdravem<br> Edie</p>
                </div>
<!--                <div class="six wide right floated column">-->
<!--                    <img src="erb" class="ui large rounded image">-->
<!--                </div>-->
            </div>
<!--            <div class="row">-->
<!--                <div class="center aligned column">-->
<!--                    <a class="ui huge button">Check Them Out</a>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>


    <div class="ui vertical stripe quote segment">
        <div class="ui equal width stackable internally celled grid">
            <div class="center aligned row">

                <div class="column">
                    <h3>"Poctivého nepálí."</h3>
                    <p>
                        <b>Jan Hus</b> první astronaut
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="ui vertical stripe segment">
        <div class="ui text container">
            <h3 class="ui header">Breaking The Grid, Grabs Your Attention</h3>
            <p>Instead of focusing on content creation and hard work, we have learned how to master the art of doing nothing by providing massive amounts of whitespace and generic content that can seem massive, monolithic and worth your attention.</p>
            <a class="ui large button">Read More</a>
            <h4 class="ui horizontal header divider">
                <a href="#">Case Studies</a>
            </h4>
            <h3 class="ui header">Did We Tell You About Our Bananas?</h3>
            <p>Yes I know you probably disregarded the earlier boasts as non-sequitur filler content, but its really true. It took years of gene splicing and combinatory DNA research, but our bananas can really dance.</p>
            <a class="ui large button">I'm Still Quite Interested</a>
        </div>
    </div>



</div>

</body>
</html>
