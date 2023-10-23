<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Restrito</title>

    <link rel="stylesheet" href="css-novo/style_app.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    
</head>

<body>
<script src="js/vilarica.js"></script>
<script src="js/vilarica2.js"></script>
<script src="jsLogin/funcaologin.js"></script>

<div>
     
    <div class="content">

          
        <header>
        
        </header>
        

        <aside>
            <img class="iconelogo" src="assets/vila.png" alt="logo" srcset="">

            <h1>Desenvolvimentos <span>Supermercados Vila Rica</span></h1>
        </aside>

        <main>
            <header>
            <a href="vilarica.html">
                    <i class="fa-solid fa-angle-left"></i>
            </a>
            <h2>Entre na sua <span>conta de usuario</span></h2>
            </header>
            

            <form method="post">
                <label for="input-name">usuario:</label>
                <input type="text" name="usuario1" id="input-name">

                <label for="input-senha">senha:</label>
                <input type="password" name="senha1" id="input-senha">
            
                <label  for="input-entrar"></label>
                <input class="btn-entrar" type="submit" id="input-entrar" value="Entrar" onclick="entrar(event)">
            </form>


            <footer>
               
            </footer>
        </main>

        
    </div>
</div>
</body>
</html>