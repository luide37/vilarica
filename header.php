<?php
session_start();

if (!$_SESSION['logado']) {
    header("Location: login.php");
    exit;
}
?>

<div id="header" style="font-size: x-large;">
    <div style="float: right; color: #AAA; margin: 10px; padding-left: 10px; padding-right: 5px; border-left: 1px solid #AAA">
        <a href="php/login_sair.php" class="link1" style="font-size: 14px;line-height: 20px;">Sair</a>
    </div>

    <div style="float: right; margin-top: 10px; font-size: 14px; line-height: 20px;">
        <?=$_SESSION[razaosocial]?>
    </div>
    
    <img src="img/logotipo.png" style="width: 55px;  margin-top: 3px;margin-left: 10px;">
    VR COTAÇÃO
</div>