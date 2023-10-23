<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?php
session_start();

if (!$_SESSION['logado']) {
    header("Location: login.php");
    exit;
}

include("php/conexao.php");
include("php/global.php");

$sql = "SELECT mensagem FROM precotacaofornecedormensagem";
$rst = pg_query($con, $sql);

$row = pg_fetch_array($rst);

$mensagem = $row[mensagem];
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" media="all" type="text/css" href="css/vr.css">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
        <link rel="stylesheet" media="all" type="text/css" href="css/bootstrap.min.css">

        <title>Principal</title>

        <script type="text/javascript" src="js/menu.js"></script>
    </head>

    <body>
        <div id="container">

            <?php
            include("header.php");
            include("menu.php");
            ?>

            <div id="content">
                <div class="alert alert-block">
                    <h4>ATENÇÃO FORNECEDOR</h4><br>
                    <?= $mensagem ?>                    
                </div>
            </div>

            <?php
            include("footer.php");
            ?>

        </div>
    </body>
</html>