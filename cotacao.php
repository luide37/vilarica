<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?php
session_start();

if (!$_SESSION['logado']) {
    header("Location: login.php");
    exit;
}

include("php/conexao.php");
include("php/global.php");
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" media="all" type="text/css" href="css/vr.css">
        <link rel="stylesheet" media="all" type="text/css" href="css/bootstrap.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />

        <title>Cotação</title>

        <link rel="stylesheet" type="text/css" href="css/jquery/ui.all.css" />
        <script type="text/javascript" src="js/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="js/jquery/ui.core.js"></script>
        <script type="text/javascript" src="js/jquery/ui.datepicker.js"></script>
        <script type="text/javascript" src="js/jquery/i18n/ui.datepicker-pt-BR.js"></script>
        <script type="text/javascript" src="js/jquery/effects.core.js"></script>
        <script type="text/javascript" src="js/jquery/effects.blind.js"></script>
        <script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />

        <script type="text/javascript">
            function runEffect() {
                $("#tabela_cotacao").show('blind', 500);
            };
        </script>

        <script type="text/javascript" src="js/ajax.js"></script>
        <script type="text/javascript" src="js/vr.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>

        <script type="text/javascript">
            function consultar(id) {
                oXMLhttp = criaXMLHttpRequest();

                var url = "php/cotacao_consultar.php";
                var param = "cotacao=" + id;

                oXMLhttp.open("POST", url, true);
                oXMLhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                oXMLhttp.setRequestHeader("Content-length", param.length);
                oXMLhttp.setRequestHeader("Connection", "close");
                
                document.getElementById("tabela_cotacao").innerHTML = "<div style=\"background: url(img/aguarde.gif) no-repeat; background-position: center;font-size: 14px; font-weight: bold;text-align: center;\"> <br><br><br>Aguarde </div>"

                oXMLhttp.onreadystatechange = function() {
                    if (oXMLhttp.readyState == 1) {
                        document.getElementById("tabela_cotacao").innerHTML = exibirMensagem("Aguarde...", "aguarde.gif");
                        document.getElementById("mensagem_salvar").innerHTML = "";
                    }

                    if (oXMLhttp.readyState == 4 && oXMLhttp.status == 200) {
                        var result = oXMLhttp.responseText;
                        document.getElementById("tabela_cotacao").innerHTML = result;

                        document.getElementById("footer").style.position = "fixed";
                    }
                }

                oXMLhttp.send(param);
            }

            function salvar() {
                oXMLhttp = criaXMLHttpRequest();

                var url = "php/cotacao_salvar.php";
                var param = "";

                i = 0;
                
                document.getElementById("tabela_cotacao").style.display = 'none';
                document.getElementById("aguarde").style.display = 'block';
                
                while (document.getElementById("custo[" + i + "]")) {
                    param += "codigo[" + i + "]=" + document.getElementById("codigo[" + i + "]").value + "&";
                    param += "custo[" + i + "]=" + document.getElementById("custo[" + i + "]").value + "&";
                    param += "tipoembalagem[" + i + "]=" + document.getElementById("tipoembalagem[" + i + "]").value + "&";
                    param += "observacao[" + i + "]=" + document.getElementById("observacao[" + i + "]").value + "&";
                    i++;
                }

                var tabela_cotacao_anterior = document.getElementById("tabela_cotacao").value;

                param += "cotacao=" + document.getElementById("cotacao").value + "&";
                param += "data=" + document.getElementById("datacotacao").value;

                oXMLhttp.open("POST", url, true);
                oXMLhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                oXMLhttp.setRequestHeader("Content-length", param.length);
                oXMLhttp.setRequestHeader("Connection", "close");

                oXMLhttp.onreadystatechange = function() {
                    if (oXMLhttp.readyState == 1) {
                        document.getElementById("mensagem_salvar").innerHTML = exibirMensagem("Aguarde...", "aguarde.gif");
                    }

                    if (oXMLhttp.readyState == 4 && oXMLhttp.status == 200) {
                        document.getElementById("tabela_cotacao").style.display = 'block';
                        document.getElementById("tabela_cotacao").value = tabela_cotacao_anterior;
                        document.getElementById("aguarde").style.display = 'none';
                        
                        var result = oXMLhttp.responseText;

                        if (result.length > 0) {
                            fancyMsgErro(result);
                        } else {
                            fancyMsg("Salvo com sucesso!");
                        }
                        
                    }
                }

                oXMLhttp.send(param);
            }
            
            function fancyMsg(msg) {
                jQuery.fancybox({
                    'modal' : true,
                    'content' : "<div style=\"margin:1px;width:150px;\"><i class='icon-exclamation-sign'></i> "+msg+"<div style=\"text-align:right;margin-top:10px;\">\n\
                     <input class='btn btn-mini' type=\"button\" onclick=\"jQuery.fancybox.close();\" value=\"  Ok  \"></div>\n\
                    </div>"
                             });
                         }
            
                         function fancyMsgErro(msg) {
                             jQuery.fancybox({
                                 'modal' : true,
                                 'content' : "<div style=\"margin:1px;width:90%;\"><i class='icon-warning-sign'></i>  "+msg+"<div style=\"text-align:right;margin-top:10px;\">\n\
                     <input class='btn btn-mini' type=\"button\" onclick=\"jQuery.fancybox.close();\" value=\"  Ok  \"></div>\n\
                    </div>"
                             });
                         }

                         function validarCusto(i) {
                
                             erro = false;

                             if (document.getElementById("custo[" + i + "]").value != "") {
                                 validarCampo(document.getElementById("custo[" + i + "]"), "decimal2");
                             } else {
                                 document.getElementById("mensagem_custo[" + i + "]").innerHTML = "";
                             }

                             if (erro) {
                                 return;
                             }

                             var oXMLhttpCusto = new Array();
                             oXMLhttpCusto[i] = criaXMLHttpRequest();

                             var url = "php/cotacao_validarcusto.php";
                             var param = "";

                             param += "cotacao=" + document.getElementById("cotacao").value + "&";
                             param += "data=" + document.getElementById("datacotacao").value + "&";
                             param += "codigo=" + document.getElementById("codigo[" + i + "]").value + "&";
                             param += "custo=" + document.getElementById("custo[" + i + "]").value + "&";
                             param += "tipoembalagem=" + document.getElementById("tipoembalagem[" + i + "]").value + "&";
                             param += "observacao=" + document.getElementById("observacao[" + i + "]").value + "&";

                             oXMLhttpCusto[i].open("POST", url, true);
                             oXMLhttpCusto[i].setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                             oXMLhttpCusto[i].setRequestHeader("Content-length", param.length);
                             oXMLhttpCusto[i].setRequestHeader("Connection", "close");

                             oXMLhttpCusto[i].onreadystatechange = function() {
                                 if (oXMLhttpCusto[i].readyState == 4 && oXMLhttpCusto[i].status == 200) {
                                     var result = oXMLhttpCusto[i].responseText;
                        
                                     if (result == ">") {
                                         document.getElementById("mensagem_custo[" + i + "]").innerHTML = "<i class=\"icon-arrow-up\" title=\"Custo acima da margem permitida\"></i>";
                                     } else if (result == "<") {
                                         document.getElementById("mensagem_custo[" + i + "]").innerHTML = "<i class=\"icon-arrow-down\" title=\"Custo abaixo da margem permitida\"></i>";
                                     } else {
                                         document.getElementById("mensagem_custo[" + i + "]").innerHTML = "";
                                     }
                                 }
                             }

                             oXMLhttpCusto[i].send(param);
                         }
            
                         function acertarCustoFamilia(fld, index) {
                             var familia = document.getElementById("familia[" + index + "]").value
                
                             if (familia == "" || familia == "0") {
                                 return;
                             }
                
                             i = 0;
                
                             while (document.getElementById("custo[" + i + "]")) {
                                 if (document.getElementById("familia[" + i + "]").value == familia && i != index) {
                                     document.getElementById("custo[" + i + "]").value = fld.value;
                        
                                     validarCusto(i);
                                 }
                    
                                 i++;
                             }
                         }
            
        </script>

    <div style="position: fixed; width: 100%;">

        <style type="text/css">
            .legenda { position: fixed; text-align: left; width: 100%; left: 0px; border-bottom: 1px solid; border-color: #B1B1B1; padding-bottom: 13px; background-color: #FFFFFF; height: 25px; padding-top: 25px;}
        </style>
    </div>
</head>

<body onload="javascript: consultar(0)">
    <div id="container">

        <div style="position: fixed; width: 100%;">
            <?php
            include("header.php");
            include("menu.php");
            ?>
        </div> 

        <div id="content" style="padding-left: 0px; ">
            <div id="aguarde" style= "display: none; background: url(img/aguarde.gif) no-repeat; background-position: center;font-size: 14px; font-weight: bold;text-align: center; margin-top: 138px;"> <br><br><br>Aguarde </div>
            <div id="tabela_cotacao" style="margin-top: 82px; background-color: #FFFFFF;"></div>
            <br>
            <div id="mensagem_salvar"></div>

        </div>
        
        <div id="footer">
            <?php
            include("footer.php");
            ?>              
        </div>


    </div>
</body>
</html>