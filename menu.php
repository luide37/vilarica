<?php
session_start();

if (!$_SESSION['logado']) {
    header("Location: login.php");
    exit;
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<div id="menu">
    <a href="index.php" id="menuitem">
        <b>Principal</b>    
    </a>

    <a href="cotacao.php" id="menuitem">
        <b>Cotação</b>
    </a>
</div>