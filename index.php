<?php
session_start();

if (isset($_GET["lang"])) {
    $_SESSION["lang"] = $_GET["lang"];
} else {
    $_SESSION["lang"] = 'en';
}

require ('vendor/autoload.php');

use Matecat\XliffParser\XliffParser;
use \Gruppe\Petlocator\Translate;


$xmlContent = file_get_contents('src/translate/de.xliff');
$xmlContentEs = file_get_contents('src/translate/es.xliff');
$xmlContentFr = file_get_contents('src/translate/fr.xliff');
$xmlContentPl = file_get_contents('src/translate/pl.xliff');
$parser = new XliffParser();

$_SESSION['parsed'] = $parser->xliffToArray($xmlContent);
$_SESSION['parsedEs'] = $parser->xliffToArray($xmlContentEs);
$_SESSION['parsedFr'] = $parser->xliffToArray($xmlContentFr);
$_SESSION['parsedPl'] = $parser->xliffToArray($xmlContentPl);

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

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="src/images/dog.png" alt="IMG">
				</div>

                <div class="login100-form">
                    <form action="src/output.php" class="validate-form">
					<span class="login100-form-title">
						<?php echo Translate::translate(1); ?>
					</span>

                        <div class="wrap-input100 validate-input" data-validate = "Name is required">
                            <input class="input100" type="text" autocomplete=“off” name="name" maxlength="17" placeholder="<?php echo Translate::translate(2); ?>">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
							<i class="fa fa-user-circle" aria-hidden="true"></i>
						</span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Phonenumber is required">
                            <input class="input100" type="tel" autocomplete="off" name="number" pattern="^\+[0-9]{6,16}" oninvalid="setCustomValidity('Correct Format: +' + <?php echo Translate::translate(3); ?>)" onchange="setCustomValidity('')" placeholder="<?php echo Translate::translate(3); ?>">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Pet Name is required">
                            <input class="input100" type="text" autocomplete=“off” name="petname" maxlength="17" placeholder="Lucky">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
							<i class="fa fa-paw" aria-hidden="true"></i>
						</span>
                        </div>

                        <div class="container-login100-form-btn">
                            <input type="submit" class="login100-form-btn" value="<?php echo Translate::translate(4); ?>">
                        </div>

                        <div class="text-center p-t-50"></div>
                    </form>
                    <div class="lang">
                        <span id="content1" style="margin-right: 1vw;"><?php echo Translate::translate(9); ?></span>
                        <form style="display: inline" action="" method="get">
                            <input style="all: unset" type="hidden" name="lang" value="en">
                            <button><i class="flag flag-gb fa-2x"></i></button>
                        </form>
                        <form style="display: inline" action="" method="get">
                            <input style="all: unset" type="hidden" name="lang" value="de">
                            <button><i class="flag flag-de fa-2x"></i></button>
                        </form>
                        <form style="display: inline" action="" method="get">
                            <input style="all: unset" type="hidden" name="lang" value="es">
                            <button><i class="flag flag-es fa-2x"></i></button>
                        </form>
                        <form style="display: inline" action="" method="get">
                            <input style="all: unset" type="hidden" name="lang" value="fr">
                            <button><i class="flag flag-fr fa-2x"></i></button>
                        </form>
                        <form style="display: inline" action="" method="get">
                            <input style="all: unset" type="hidden" name="lang" value="pl">
                            <button><i class="flag flag-pl fa-2x"></i></button>
                        </form>
                    </div>
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
    <script src="js/custom.js"></script>

</body>
</html>