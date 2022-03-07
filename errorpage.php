<?php
session_start();

if (isset($_GET["lang"])) {
    $_SESSION["lang"] = $_GET["lang"];
}

require ('vendor/autoload.php');

use Matecat\XliffParser\XliffParser;

use \Gruppe\Petlocator\Translate;


$xmlContent = file_get_contents('src/translate/de.xliff');
$parser = new XliffParser();
// Wrong information in the documentation, you have to pass
// the XML document, not the path to the XML document
$_SESSION['parsed'] = $parser->xliffToArray($xmlContent);

?>



<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"]; ?>" xmlns="http://www.w3.org/1999/html">
<head>
    <title><?php echo Translate::translate(10); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="src/images/icons/favicon.svg"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="src/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="src/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="src/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="src/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="src/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="src/css/util.css">
    <link rel="stylesheet" type="text/css" href="src/css/main.css">
    <!--===============================================================================================-->
    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
    />
    <!-- MDB -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css"
        rel="stylesheet"
    />

    <style>
        .wrap-login100 {
            padding: 50px 150px 50px 150px;
        }

        .login100-form{
            padding-top: 10%;
            padding-bottom: 10%;
        }
    </style>

</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="src/images/sad_cat.png" width="70%" alt="IMG">
            </div>
            <div class="login100-form">
                <span class="login100-form-title">
						<?php echo Translate::translate(11); ?>
                </span>
                <form action="./">
                    <div class="container-login100-form-btn">
                        <input type="submit" class="login100-form-btn" value="<?php echo Translate::translate(12); ?>">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>




<!--===============================================================================================-->
<script src="src/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="src/vendor/bootstrap/js/popper.js"></script>
<script src="src/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="src/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="src/vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="src/js/main.js"></script>

</body>
</html>