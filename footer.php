<?php
session_start();

if (!$_SESSION['logado']) {
    header("Location: login.php");
    exit;
}
?>

<div id="footer">
    <div style="color: #666; width: 100%; margin-top: 5px; text-align: center;">
        Versão 3.17.0 , Copyright © 2016, VR SOFTWARE, Todos os direitos reservados
    </div>
</div>
</div>