<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <div class="row">
        <div
            class="container login col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-4 col-lg-4">
            <br />
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="title-login">Login</h1>
                </div>
                <div class="panel-body">
                    <form method="post">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="glyphicon glyphicon-user"
                                        style="width: auto"></i>

                                </span> <input id="txtUsuario" runat="server" type="text" class="form-control"
                                    name="username" placeholder="Usuário" required="" />

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> <i class="glyphicon glyphicon-lock"
                                        style="width: auto"></i>
                                </span> <input id="txtSenha" runat="server" type="password" class="form-control"
                                    name="password" placeholder="Senha" required="" />
                            </div>
                        </div>
                        <!--div class="alert lert-danger">
                                <strong>Atenção!</strong> Usuário e/ou senha incorretos.
                            </div>-->
                        <div>
                            <input class="btn btn-xm btn-block btn-entrar" type="submit" value="Entrar"
                                onclick="Login(event)" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function Login(event) {
            event.preventDefault();
            var usuario = document.getElementsByName('username')[0].value;
            usuario = usuario.toLowerCase();
            var senha = document.getElementsByName('password')[0].value;
            senha = senha.toLowerCase();

            if (usuario == "bcf" && senha == "bcf") {
                alert("dados corretos");
                window.location = "index.html";
            } else {
                alert("Dados incorretos, tente novamente");
            }
        }
    </script>

</body>

</html>