<?php
session_start();

if (isset($_GET["lang"])) {
    $_SESSION["lang"] = $_GET["lang"];
}

require('../vendor/autoload.php');

use Gruppe\Petlocator\Owner;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Gruppe\Petlocator\Translate;




use Monolog\Logger;
use Monolog\Handler\StreamHandler;



?>


<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"]; ?>" xmlns="http://www.w3.org/1999/html">
<head>
    <title><?php echo Translate::translate(10); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.svg"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
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
        html {
            width: 100%;
            height: 100%;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            background: #9053c7;
            background: -webkit-linear-gradient(-135deg, #481717, #102152);
            background: -o-linear-gradient(-135deg, #481717, #102152);
            background: -moz-linear-gradient(-135deg, #481717, #102152);
            background: linear-gradient(-135deg, #481717, #102152);
        }

        .grid-container {
            display: grid;
            grid-template-columns: auto auto;
            border-radius: 20px;
        }

        .grid-item {
            align-items: center;
            justify-content: center;
            align-self: center;
            text-align: center;
            align-content: center;
        }

        .main {
            height: 100%;
            width: 100%;
            display: table;
        }

        .wrapper {
            display: table-cell;
            height: 100%;
            vertical-align: middle;
        }

        @media (max-width: 1000px) {
            .grid-container {
                display: block;
            }
        }

        @media (max-width: 510px) {
            .login100-form-title {
                font-size: 18px;
                padding-bottom: 0px;
            }

            .image {
                width: 194px;
                height: 200px;
            }
        }

    </style>
</head>
<body style="background-color: transparent">


<div class="main">
    <div class="wrapper">
        <div class="grid-container" style="width: 70vw; background-color: #ffffff">


            <?php


            // create a log channel
            $log = new Logger('QRCode');
            $log->pushHandler(new StreamHandler('logs/qr.log', Logger::INFO));
            $log->info('QR Code Generatet ->  Name: '.$_GET['name'].'  Number: '.$_GET['number'].' Pet: '.$_GET['petname']);


            $myOwner = new Owner($_GET['name'], $_GET['number']);

            echo '<div class="grid-item login100-form-title"><br><br>' . Translate::translate(13) . $myOwner->getName();
            echo '<br><br>' . Translate::translate(5) . $myOwner->getPhonenumber();
            echo '<br><br>' . Translate::translate(6) . $_GET['petname'];


            $result = Builder::create()
                ->writer(new PngWriter())
                ->writerOptions([])
                ->data($myOwner . "
Pet Name: " . $_GET['petname'])
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
                ->size(250)
                ->margin(20)
                ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
                // ->logoPath(__DIR__.'/assets/symfony.png')
                ->labelText("")
                ->labelFont(new NotoSans(22))
                ->labelAlignment(new LabelAlignmentCenter())
                ->build();

            // Directly output the QR code
            //header('Content-Type: '.$result->getMimeType());
            //echo $result->getString();

            $dataUri = $result->getDataUri();
            ?>

            <script type="text/javascript">
                var php_var = "<?php echo $dataUri; ?>";
            </script>

            <br><br>
            <div style="display: flex; justify-content: center; align-items: center; margin-left: 3px; margin-right: 3px">
                <div class="container-login100-form-btn">
                    <button style="width: auto; margin: 5px;" class="login100-form-btn"
                            onclick='downloadURI(php_var, "QR-Code.png");'><?php echo Translate::translate(7); ?></button>
                    <button style="width: auto; margin: 5px;" class="login100-form-btn"
                            onclick='location.href = "../index.php";'><?php echo Translate::translate(8); ?></button>
                </div>
            </div>
        </div>

        <div id="printableArea">
            <h1 id="header"
                style="font-family: Poppins-Bold; display: none; text-align: center"><?php echo Translate::translate(10); ?></h1>
            <div id="codeContainer" style="display: flex; justify-content: center; align-items: center;">
                <a id="code" class="grid-item" onclick="printDiv('printableArea')">

                    <?php
                    echo '<img class="image" style="margin-top: 8%;" alt="QR Code" src="' . $dataUri . '">';
                    ?>
                </a>
            </div>

        </div>

        <div class="a">
            <div class="language">
                <span style="margin-right: 1vw"><?php echo Translate::translate(9); ?></span>
                <button onclick="setParam('lang', 'en')"><i class="flag flag-gb fa-2x"></i></button>
                <button onclick="setParam('lang', 'de')"><i class="flag flag-de fa-2x"></i></button>
                <button onclick="setParam('lang', 'es')"><i class="flag flag-es fa-2x"></i></button>
                <button onclick="setParam('lang', 'fr')"><i class="flag flag-fr fa-2x"></i></button>
                <button onclick="setParam('lang', 'pl')"><i class="flag flag-pl fa-2x"></i></button>
            </div>
        </div>
    </div>
</div>
</div>


<script>

    function printDiv(divName) {
        document.getElementById("header").style.display = "block";
        document.getElementById("header").style.marginTop = "10%";
        document.getElementById("codeContainer").style.marginTop = "50%";

        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
        document.getElementById("header").style.display = "none";
        document.getElementById("header").style.marginTop = "0";
        document.getElementById("codeContainer").style.marginTop = "0";
    }

    function downloadURI(uri, name) {
        var link = document.createElement("a");
        link.download = name;
        link.href = uri;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        delete link;
    }

    const downloadPdf = document
        .querySelector("#download-pdf");

    const submitForm = document
        .querySelector("#submit-form");

    downloadPdf.addEventListener("click", () => {

        // Creating the element anchor that
        // will download pdf
        let element = document.createElement("a");
        element.href = "images/dog.png";
        element.download = "images/dog.png";

        // Adding the element to body
        document.documentElement.appendChild(element);

        // Above code is equivalent to
        // <a href="path of file" download="file name">

        // onClick property, to trigger download
        element.click();

        // Removing the element from body
        document.documentElement.removeChild(element);

        // onClick property, to trigger submit form
        submitForm.click();
    });
</script>
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>